// 获取路由中的不同数值
    function UrlSearch(){
       var name,value;       // "ShouYe_feicui.html?userId="+a.userId+"&msg="+a.msg+"&orgid="+a.orgid;
       var str=location.href; //取得整个地址栏     
       var num=str.indexOf("?")  // 获取？在str字符串中首次出现的位置     19                                   
       str=str.substr(num+1); //获取网址中？之后的字符   userId="+a.userId+"&msg="+a.msg+"&orgid="+a.orgid
       var arr=str.split("&"); // 以 & 为断点将？之后的字符分段放入数组arr中，  [userId="+a.userId+"，msg="+a.msg+"，orgid="+a.orgid]
       for(var i=0;i < arr.length;i++){                  //   从 0 到 2 遍历arr数组
        num=arr[i].indexOf("=");               // 假设 I 取0     在序号为0的字符串中，获取首次出现=的位置  比如  userId="+a.userId+"  中 = 位置为 6
        if(num>0){                              //  如果位置序号>0 则进行下面的函数     
         name=arr[i].substring(0,num);           //  userId="+a.userId+"   获取到字符串  userId
         value=arr[i].substr(num+1);            //   userId="+a.userId+"   获取到字符串  "+a.userId+"
         this[name]=value;
         } 
        } 
    }

    getLuYou();

    function getLuYou(){
        var Request =new UrlSearch(); //实例化
        var status =Request.status;
        var cate = Request.cate;
        var type = Request.type;


        var url=window.location.pathname;
        var mypro="/user/myTasksList";                            //  个人中心 我的项目 我发布的
        var myaccept = "/user/acceptTasksList";                 // 个人中心 我的项目 我承接的
        var myworks="/user/goodsShop";      //   个人中心 我的作品 
        var myload="/user/download";                // 个人中心 我的下载     
        var mymoney="/finance/assetDetail";       // 财务管理   收支明细
        if(url==mypro){                                                   
            if(status==0||status=="null"){
                $(".myproject_xifen_zhuangtai a").eq(0).addClass("daohang_dianji");
                $(".myproject_xifen_zhuangtai a").eq(0).siblings().removeClass("daohang_dianji");
            }else if(status==1){
                $(".myproject_xifen_zhuangtai a").eq(1).addClass("daohang_dianji");
                $(".myproject_xifen_zhuangtai a").eq(1).siblings().removeClass("daohang_dianji");
            }else if(status==2){
                $(".myproject_xifen_zhuangtai a").eq(2).addClass("daohang_dianji");
                $(".myproject_xifen_zhuangtai a").eq(2).siblings().removeClass("daohang_dianji");
            }else if(status==3){
                $(".myproject_xifen_zhuangtai a").eq(3).addClass("daohang_dianji");
                $(".myproject_xifen_zhuangtai a").eq(3).siblings().removeClass("daohang_dianji");
            }else if(status==4){
                $(".myproject_xifen_zhuangtai a").eq(4).addClass("daohang_dianji");
                $(".myproject_xifen_zhuangtai a").eq(4).siblings().removeClass("daohang_dianji");
            }
        }else if(url==myaccept){
            if(status==0||status=="null"){
                $(".myproject_xifen_zhuangtai a").eq(0).addClass("daohang_dianji");
                $(".myproject_xifen_zhuangtai a").eq(0).siblings().removeClass("daohang_dianji");
            }else if(status==1){
                $(".myproject_xifen_zhuangtai a").eq(1).addClass("daohang_dianji");
                $(".myproject_xifen_zhuangtai a").eq(1).siblings().removeClass("daohang_dianji");
            }else if(status==2){
                $(".myproject_xifen_zhuangtai a").eq(2).addClass("daohang_dianji");
                $(".myproject_xifen_zhuangtai a").eq(2).siblings().removeClass("daohang_dianji");
            }else if(status==3){
                $(".myproject_xifen_zhuangtai a").eq(3).addClass("daohang_dianji");
                $(".myproject_xifen_zhuangtai a").eq(3).siblings().removeClass("daohang_dianji");
            }else if(status==4){
                $(".myproject_xifen_zhuangtai a").eq(4).addClass("daohang_dianji");
                $(".myproject_xifen_zhuangtai a").eq(4).siblings().removeClass("daohang_dianji");
            }
        }else if(url==myworks){
            if(cate==undefined){                               //  判断cate数值
                $(".mywork_xifen_leixing a").eq(0).addClass("daohang_dianji");
                $(".mywork_xifen_leixing a").eq(0).siblings().removeClass("daohang_dianji");
            }else if(cate==166){
                $(".mywork_xifen_leixing a").eq(1).addClass("daohang_dianji");
                $(".mywork_xifen_leixing a").eq(1).siblings().removeClass("daohang_dianji");
            }else if(cate==167){
                $(".mywork_xifen_leixing a").eq(2).addClass("daohang_dianji");
                $(".mywork_xifen_leixing a").eq(2).siblings().removeClass("daohang_dianji");
            }else if(cate==168){
                $(".mywork_xifen_leixing a").eq(3).addClass("daohang_dianji");
                $(".mywork_xifen_leixing a").eq(3).siblings().removeClass("daohang_dianji");
            }else if(cate==169){
                $(".mywork_xifen_leixing a").eq(4).addClass("daohang_dianji");
                $(".mywork_xifen_leixing a").eq(4).siblings().removeClass("daohang_dianji");
            }else if(cate==170){
                $(".mywork_xifen_leixing a").eq(5).addClass("daohang_dianji");
                $(".mywork_xifen_leixing a").eq(5).siblings().removeClass("daohang_dianji");
            }else if(cate==264){
                $(".mywork_xifen_leixing a").eq(6).addClass("daohang_dianji");
                $(".mywork_xifen_leixing a").eq(6).siblings().removeClass("daohang_dianji");
            }else if(cate==265){
                $(".mywork_xifen_leixing a").eq(7).addClass("daohang_dianji");
                $(".mywork_xifen_leixing a").eq(7).siblings().removeClass("daohang_dianji");
            }else if(cate==280){
                $(".mywork_xifen_leixing a").eq(8).addClass("daohang_dianji");
                $(".mywork_xifen_leixing a").eq(8).siblings().removeClass("daohang_dianji");
            } 
            if(status==undefined){                                                                    //  判断status数值，另起一个if判断
                $(".mywork_xifen_zhuangtai a").eq(0).addClass("daohang_dianji");
                $(".mywork_xifen_zhuangtai a").eq(0).siblings().removeClass("daohang_dianji");
            }else if(status==0){
                $(".mywork_xifen_zhuangtai a").eq(1).addClass("daohang_dianji");
                $(".mywork_xifen_zhuangtai a").eq(1).siblings().removeClass("daohang_dianji");
            }else if(status==1){
                $(".mywork_xifen_zhuangtai a").eq(2).addClass("daohang_dianji");
                $(".mywork_xifen_zhuangtai a").eq(2).siblings().removeClass("daohang_dianji");
            }else if(status==3){
                $(".mywork_xifen_zhuangtai a").eq(3).addClass("daohang_dianji");
                $(".mywork_xifen_zhuangtai a").eq(3).siblings().removeClass("daohang_dianji");
            }
        }else if(url==myload){
            if(status==0){
                $(".myproject_xifen_zhuangtai a").eq(0).addClass("daohang_dianji");
                $(".myproject_xifen_zhuangtai a").eq(0).siblings().removeClass("daohang_dianji");
            }else if(status==1){
                $(".myproject_xifen_zhuangtai a").eq(1).addClass("daohang_dianji");
                $(".myproject_xifen_zhuangtai a").eq(1).siblings().removeClass("daohang_dianji");
            }else if(status==2){
                $(".myproject_xifen_zhuangtai a").eq(2).addClass("daohang_dianji");
                $(".myproject_xifen_zhuangtai a").eq(2).siblings().removeClass("daohang_dianji");
            }else if(status==3){
                $(".myproject_xifen_zhuangtai a").eq(3).addClass("daohang_dianji");
                $(".myproject_xifen_zhuangtai a").eq(3).siblings().removeClass("daohang_dianji");
            }else if(status==4){
                $(".myproject_xifen_zhuangtai a").eq(4).addClass("daohang_dianji");
                $(".myproject_xifen_zhuangtai a").eq(4).siblings().removeClass("daohang_dianji");
            }
        }else if(url==mymoney){
            if(type==undefined){
                $(".bqhz a").eq(0).addClass("daohang_dianji");
                $(".bqhz a").eq(0).siblings().removeClass("daohang_dianji");
            }else if(type==1){
                $(".bqhz a").eq(1).addClass("daohang_dianji");
                $(".bqhz a").eq(1).siblings().removeClass("daohang_dianji");
            }else if(type==2){
                $(".bqhz a").eq(2).addClass("daohang_dianji");
                $(".bqhz a").eq(2).siblings().removeClass("daohang_dianji");
            }else if(type==3){
                $(".bqhz a").eq(3).addClass("daohang_dianji");
                $(".bqhz a").eq(3).siblings().removeClass("daohang_dianji");
            }else if(type==4){
                $(".bqhz a").eq(4).addClass("daohang_dianji");
                $(".bqhz a").eq(4).siblings().removeClass("daohang_dianji");
            }else if(type==5){
                $(".bqhz a").eq(5).addClass("daohang_dianji");
                $(".bqhz a").eq(5).siblings().removeClass("daohang_dianji");
            }else if(type==6){
                $(".bqhz a").eq(6).addClass("daohang_dianji");
                $(".bqhz a").eq(6).siblings().removeClass("daohang_dianji");
            }else if(type==7){
                $(".bqhz a").eq(7).addClass("daohang_dianji");
                $(".bqhz a").eq(7).siblings().removeClass("daohang_dianji");
            }else if(type==8){
                $(".bqhz a").eq(8).addClass("daohang_dianji");
                $(".bqhz a").eq(8).siblings().removeClass("daohang_dianji");
            }else if(type==9){
                $(".bqhz a").eq(9).addClass("daohang_dianji");
                $(".bqhz a").eq(9).siblings().removeClass("daohang_dianji");
            }else if(type==10){
                $(".bqhz a").eq(10).addClass("daohang_dianji");
                $(".bqhz a").eq(10).siblings().removeClass("daohang_dianji");
            }else if(type==11){
                $(".bqhz a").eq(11).addClass("daohang_dianji");
                $(".bqhz a").eq(11).siblings().removeClass("daohang_dianji");
            }else if(type==14){
                $(".bqhz a").eq(12).addClass("daohang_dianji");
                $(".bqhz a").eq(12).siblings().removeClass("daohang_dianji");
            }else if(type==16){
                $(".bqhz a").eq(13).addClass("daohang_dianji");
                $(".bqhz a").eq(13).siblings().removeClass("daohang_dianji");
            }
        }
    }


    // 个人中心模态框居中

    function letModalCenter(divName){   
        var top = ($(window).height() - $(divName).height())/2-100;   
        var left = ($(window).width() - $(divName).width())/2-100;   
        var scrollTop = $(document).scrollTop();   
        var scrollLeft = $(document).scrollLeft(); 
        var addtop =  top + scrollTop;
        var addleft = left + scrollLeft;
        $(divName).css({ 'position' : "absolute", 'top' : ""+addtop+"px", 'left': ""+addleft+"px"}); 
    };


    



