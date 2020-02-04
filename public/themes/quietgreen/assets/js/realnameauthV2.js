/**
 * Created by kuke on 2016/4/29.
 */
$(function () {

  var demo = $(".registerform").Validform({
    btnSubmit: "#btn_sub",
    tiptype: 3,
    label: ".label",
    showAllError: true,
    datatype: {

      "zh2-4": /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,4}$/,
      "idcard": function (gets, obj, curform, datatype) {
        //该方法由佚名网友提供;

        var Wi = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1];// 加权因子;
        var ValideCode = [1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2];// 身份证验证位值，10代表X;

        if (gets.length == 15) {
          return isValidityBrithBy15IdCard(gets);
        } else if (gets.length == 18) {
          var a_idCard = gets.split("");// 得到身份证数组
          if (isValidityBrithBy18IdCard(gets) && isTrueValidateCodeBy18IdCard(a_idCard)) {
            return true;
          }
          return false;
        }
        return false;

        function isTrueValidateCodeBy18IdCard(a_idCard) {
          var sum = 0; // 声明加权求和变量
          if (a_idCard[17].toLowerCase() == 'x') {
            a_idCard[17] = 10;// 将最后位为x的验证码替换为10方便后续操作
          }
          for (var i = 0; i < 17; i++) {
            sum += Wi[i] * a_idCard[i];// 加权求和
          }
          valCodePosition = sum % 11;// 得到验证码所位置
          if (a_idCard[17] == ValideCode[valCodePosition]) {
            return true;
          }
          return false;
        }

        function isValidityBrithBy18IdCard(idCard18) {
          var year = idCard18.substring(6, 10);
          var month = idCard18.substring(10, 12);
          var day = idCard18.substring(12, 14);
          var temp_date = new Date(year, parseFloat(month) - 1, parseFloat(day));
          // 这里用getFullYear()获取年份，避免千年虫问题
          if (temp_date.getFullYear() != parseFloat(year) || temp_date.getMonth() != parseFloat(month) - 1 || temp_date.getDate() != parseFloat(day)) {
            return false;
          }
          return true;
        }

        function isValidityBrithBy15IdCard(idCard15) {
          var year = idCard15.substring(6, 8);
          var month = idCard15.substring(8, 10);
          var day = idCard15.substring(10, 12);
          var temp_date = new Date(year, parseFloat(month) - 1, parseFloat(day));
          // 对于老身份证中的你年龄则不需考虑千年虫问题而使用getYear()方法
          if (temp_date.getYear() != parseFloat(year) || temp_date.getMonth() != parseFloat(month) - 1 || temp_date.getDate() != parseFloat(day)) {
            return false;
          }
          return true;
        }
      }
    },
  });

  function cardUploader(selector, btn_choose, no_icon) {
    var in_process = false;
    var file_input = $(selector);

    file_input.ace_file_input({
      style: 'well',
      btn_choose: btn_choose,
      btn_change: null,
      no_icon: no_icon,
      droppable: true,
      thumbnail: 'small',//large | fit
      maxSize: 3145728,//bytes
      allowExt: ["jpeg", "jpg", "png", "gif", "bmp"],
      before_change: function () {
        return !in_process;
      },
      before_remove: function () {
        return !in_process;
      },
    }).on('change', function () {
      var files = $(this).data('ace_input_files');
      if (!files || !files.length) {
        return;
      }
      var file = files[0];

      in_process = true;
      $(this).ace_file_input('loading', true);
      
      uploadFileToOSS('attachment/user/', [file], (err, result) => {
        in_process = false;
        $(this).ace_file_input('loading', false);
        if (err || !result.length) {
          alert('上传失败，请重试');
          $(this).ace_file_input('reset_input_ui');
        } else {
          $(this).parent().siblings('.img-url').val(result[0].name);
        }
      })
    });
  }

  cardUploader('#id-input-file-3', '正面图片', 'g-userimgupzm');
  cardUploader('#id-input-file-4', '反面图片', 'g-userimgupfm');
  cardUploader('#id-input-file-5', '手持身份证照', 'g-userimgupdf');
  cardUploader('#id-input-file-6', '上传封面', 'g-userimgshop');
})