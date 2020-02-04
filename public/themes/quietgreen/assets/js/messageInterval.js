$(document).ready(function () {
    var userid = $("#uid").attr('uid');
    var t = setInterval(function () { 
        $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/user/inquire',
            data: {uid:userid},
            dataType:'json',
            success: function(data){
                if (data.code == 1) {
                    layer.msg(data.desc,{time:2000});
                }
            },
            error: function(data){
              console.log(data);
            }
            });
        },10000);
    });


