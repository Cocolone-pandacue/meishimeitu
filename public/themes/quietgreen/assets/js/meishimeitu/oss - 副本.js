$(function () {
  if (typeof OSS !== 'function') {
    var oss = document.createElement("script");
    oss.src = "https://gosspublic.alicdn.com/aliyun-oss-sdk-6.0.0.min.js";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(oss, s)
  }

  if (typeof SparkMD5 !== 'function') {
    var spark = document.createElement("script");
    spark.src = "https://cdn.bootcss.com/spark-md5/3.0.0/spark-md5.min.js";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(spark, s)
  }

  function BFM() {
    this.aborted = false
    this.progress = 0
  }


  BFM.prototype.md5 = function md5(file) {
    let d = $.Deferred();
    this.aborted = false
    this.progress = 0
    let currentChunk = 0
    const blobSlice =
      File.prototype.slice ||
      File.prototype.mozSlice ||
      File.prototype.webkitSlice
    const chunkSize = 2097152
    const chunks = Math.ceil(file.size / chunkSize)
    const spark = new SparkMD5.ArrayBuffer()
    const reader = new FileReader()

    loadNext()

    reader.onloadend = e => {
      spark.append(e.target.result) // Append array buffer
      currentChunk++
      this.progress = currentChunk / chunks

      if (this.aborted) {
        d.reject('aborted')
        return
      }

      if (currentChunk < chunks) {
        loadNext()
      } else {
        d.resolve(spark.end())
      }
    }

    /////////////////////////
    function loadNext() {
      const start = currentChunk * chunkSize
      const end = start + chunkSize >= file.size ? file.size : start + chunkSize
      reader.readAsArrayBuffer(blobSlice.call(file, start, end))
    }

    return d;
  }

  BFM.prototype.abort = function abort() {
    this.aborted = true
  }

  let ossClient;
  function getOssClient() {
    const d = $.Deferred();
    if (ossClient) {
      return d.resolve(ossClient);
    }
    $.ajax({
      url: 'https://www.meishimeitu.com/api/sts',
      type: 'get',
      dataType: 'json',
      success: function (data) {
        const client = new OSS({
          accessKeyId: data.AccessKeyId,
          accessKeySecret: data.AccessKeySecret,
          stsToken: data.SecurityToken,
          endpoint: 'oss-cn-shanghai.aliyuncs.com',
          bucket: 'meishimeitu'
        });
        ossClient = client;
        d.resolve(client);
      }
    })
    return d;
  }

  Date.prototype.format = function (fmt) { //author: meizz 
    var o = {
      "M+": this.getMonth() + 1, //月份 
      "d+": this.getDate(), //日 
      "h+": this.getHours(), //小时 
      "m+": this.getMinutes(), //分 
      "s+": this.getSeconds(), //秒 
      "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
      "S": this.getMilliseconds() //毫秒 
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
      if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
  }


  window.uploadFileToOSS = function uploadFileToOSS(folder, files, callback) {
    getOssClient().then((client) => {
      const bfm = new BFM();
      const ymd = new Date().format('yyyy/MM/dd/');
      
      const deferreds = files.map(file => {
        const d = $.Deferred();
        bfm.md5(file).then((md5) => {
          const ext = file.name.substring(file.name.lastIndexOf("."))
          const key = folder + ymd + md5 + ext;
          client.multipartUpload(key, file).then(d.resolve)
        });
        return d;
      });

      $.when.apply(null, deferreds).then(function success() {
        callback(null, Array.prototype.splice.call(arguments, 0, files.length));
      }, callback);
    })
  }
})

