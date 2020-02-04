window.onload = function() {
    // 文字滚动效果
    setInterval('autoScroll(".the_winners")',2000);
    // 抽奖动画
    lottery.init('lottery');
    $('.draw-btn').click(function() {
         // ajax请求中奖序号
         if(click) { //click控制一次抽奖过程中不能重复点击抽奖按钮，后面的点击不响应
            return false;
        }else{ $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/user/rewardajax',
            dataType:'json',
            success: function(data){
                console.log(data);
                var count_num = data.code;
                
                if(count_num==1){
                    layer.msg('您的抽奖机会已用完！');
                }else{
                    if(click) { //click控制一次抽奖过程中不能重复点击抽奖按钮，后面的点击不响应
                        return false;
                    } else {
                         //可抽奖次数减一
                         var lottery_mount=$('.count').text();
                        if (lottery_mount>0) {
                            $('.count').text(parseInt(lottery_mount) - parseInt(1));
                        }

                        lottery.reward_id = data.reward_id;
                        lottery.speed = 100;
                        roll(); //转圈过程不响应click事件，会将click置为false 此处调用的是下面单独申明的roll()函数，
                        // click = true; 	
                        return false;
                    }
                }
            }
        });}
    });
};

var lottery = {
    reward_id:-1,
    index: 0, //当前转动到哪个位置，起点位置
    count: 0, //总共有多少个位置
    timer: 0, //setTimeout的ID，用clearTimeout清除
    speed: 20, //初始转动速度    设置为100
    times: 0, //转动次数
    cycle: 50, //转动基本次数：即至少需要转动多少次再进入抽奖环节
    prize: -1, //中奖位置
    init: function(id) {
        if($('#' + id).find('.lottery-unit').length > 0) {
            $lottery = $('#' + id);
            $units = $lottery.find('.lottery-unit');
            this.obj = $lottery;
            this.count = $units.length;
            $lottery.find('.lottery-unit.lottery-unit-' + this.index).addClass('active');
        };
    },
    roll: function() {
        var index = this.index;         // 当前转动到哪个位置，起点位置  初始为-1
        var count = this.count;         //总共有多少个位置   目前为8个位置
        var lottery = this.obj;
        $(lottery).find('.lottery-unit.lottery-unit-' + index).removeClass('active');    // 此时index为-1
        index += 1;
        if(index > count) {
            index = 1;
        };                          //   这个循环保证是1-8循环滚动
        $(lottery).find('.lottery-unit.lottery-unit-' + index).addClass('active'); //  从初始位置加1开始转动
        this.index = index;
        click = true;      //   确保正在抽奖时点击抽奖无效
        return false;
    },
    stop: function(index) {
        this.prize = index;
        return false;
    }
};

function roll() {
    lottery.times += 1;   // 转动次数  初始值为0
    lottery.roll(); //转动过程调用的是lottery的roll方法，这里是第一次调用初始化,转动第一次

    if(lottery.times > lottery.cycle + 10 && lottery.prize == lottery.index) {     // lottery.cycle 转动基本次数：即至少需要转动多少次再进入抽奖环节
        clearTimeout(lottery.timer);      //  清空周期事件，停止转动
        
        switch (lottery.reward_id) {
            case 1:
                $(".warning_text").hide();
                $(".lottery_title").text("恭喜你！");
                $(".lottery_content").text("抽中了10积分！");
                integral("#integral");
                break;
            case 2:
                $(".warning_text").hide();
                $(".lottery_title").text("恭喜你！");
                $(".lottery_content").text("抽中了50积分！");
                integral("#integral");
                break;
            case 3:
                $(".warning_text").hide();
                $(".lottery_title").text("恭喜你！");
                $(".lottery_content").text("抽中了100积分！");
                integral("#integral");
                break;
            case 4:
                $(".warning_text").hide();
                $(".lottery_title").text("恭喜你！");
                $(".lottery_content").text("抽中了500积分！");
                integral("#integral");
                break;
            case 5:
                $(".warning_text").show();
                $(".lottery_title").text("恭喜你！");
                $(".lottery_content").text("抽中了手机");
                integral("#integral");
                break;
            case 6:
                $(".warning_text").show();
                $(".lottery_title").text("恭喜你！");
                $(".lottery_content").text("抽中了公仔");
                integral("#integral");
                break;
            case 7:
                $(".warning_text").show();
                $(".lottery_title").text("恭喜你！");
                $(".lottery_content").text("抽中了免费项目");
                integral("#integral");
                break;
            case 8:
                $(".warning_text").hide();
                $(".lottery_title").text("很遗憾！");
                $(".lottery_content").text("您没有抽中！");
                integral("#integral");
                break;
            default:
                break;
        }
        
        lottery.prize = -1;
        lottery.times = 0;                                                  //    中奖后初始化
        click = false;
    } else {
        if(lottery.times < lottery.cycle) {        //   当转动次数小于转动基本次数    times转动次数初始值为0    cycle转动基本次数为50
            lottery.speed -= 10;                    //   初始值为100，数值越小，转动速度越快
        } else if(lottery.times == lottery.cycle) {     //   当转动次数等于转动基本次数   times转动次数初始值为0    cycle转动基本次数为50
            var index = lottery.reward_id; //  静态演示，随机产生一个奖品序号，实际需请求接口产生  
            lottery.prize = index;       //   设置中奖位置为index数值
        } else {
            if(lottery.times > lottery.cycle + 10 && ((lottery.prize == 0 && lottery.index == 8) || lottery.prize == lottery.index + 1)) {
                lottery.speed += 110;
            } else {
                lottery.speed += 20;
            }
        }
        if(lottery.speed < 40) {
            lottery.speed = 40;
        };
        lottery.timer = setTimeout(roll, lottery.speed); //    循环调用    此处定义timer为周期事件，通过speed控制转动速度   roll（）为单独申明的函数
    }
    return false;
}

var click = false;


// 当抽中积分弹框
function integral($integral){
    layer.open({
        type: 1,
        closeBtn: 1,
        btnAlign: 'c',
        skin: 'integral_class',
        title:'',
        shadeClose:true,
        fix: false,
        scrollbar: false,
        area: ['646px', '616px'],
        // btn: ['确认领奖'],
        content: $($integral),
        success: function (layero, index) {
            $(".btn_sure").click(function(){
                layer.close(layer.index);
            })
        },
        btn2: function(index, layero){
        },
        cancel: function (index) {
        },
    });
}

// 当抽中实物弹框   暂时废弃，不需要记录联系方式
// function entity($integral){
//     layer.open({
//         type: 1,
//         closeBtn: 1,
//         btnAlign: 'c',
//         skin: 'entity_class',
//         title:'',
//         shadeClose:true,
//         fix: false,
//         scrollbar: false,
//         area: ['646px', '472px'],
//         // btn: ['确认领奖'],
//         content: $($integral),
//         yes: function (layero, index) {
//             layer.close(layer.index);
//             // $.ajax({
//             //     type: 'post',
//             //     headers: {
//             //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             //     },
//             //     url: '/user/refuseProject',
//             //     data: {id:xmid},
//             //     dataType:'json',
//             //     success: function(data){
                    
//             //     }
//             // });
//         },
//         btn2: function(index, layero){
//         },
//         cancel: function (index) {
//         },
//     });
// }



//    逻辑：当lottery.times（每转动一次+1，计算周期）  =  lottery.cycle时，获取到 lottery.prize（中奖位置），然后根据lottery.prize = lottery.index（每转动一次增加1，上限为奖品数量最大值）
//    进行最终奖品弹窗


// 抽奖前，转动50/8圈（以40ms的速度），直到lottery.times == lottery.cycle，才开始减速lottery.speed += 20，直到lottery.times > lottery.cycle + 10，
// 进行第二阶段的超减速lottery.speed += 110，直到  lottery.times > lottery.cycle + 10 && lottery.prize == lottery.index（index是在lottery.roll（）循环的时候，从0-1循环的）
// 的时候，停止滚动，弹出中奖画面



// speed控制每个块转动的速度，而lottery.times是给每次块转动统计次数

// lottery.roll（）只负责动画效果以及index从0-7循环，单独申明的roll（）负责滚动次数的统计和判断是否中间，控制动画的开关


// 文字滚动
function autoScroll(obj){
    $(obj).find('ul').animate({
       marginTop: '-26px'
    },1000,function(){
        $(this).css({marginTop : "0px"});   //  因为在ul向上移25px的时候，其第一个li会添加到ul的末尾，如果ul的marginTop不设为0的话，整个ul就会慢慢移出它的父盒子，最后使得父级盒子中空出一行，实现不了原本想要实现的效果。
        var li  =$(".the_winners ul").children().first().clone();
        $(".the_winners ul li:last").after(li);
        $(".the_winners ul li:first").remove();
    })
 }