
(function($) {
    $.fn.extend({
        shows: function(divs) {
            var w = this.width(),
                h = this.height(),
                xpos = w / 2,
                ypos = h / 2,
                eventType = "",
                direct = "";
            this.css({
                "overflow": "hidden",
                "position": "relative"
            });
            divs.css({
                "position": "absolute",
                "top": this.width()
            });
            this.on("mouseenter mouseleave", function(e) {
                var oe = e || event;
                var x = oe.offsetX;
                var y = oe.offsetY;
                var angle = Math.atan((x - xpos) / (y - ypos)) * 180 / Math.PI;
                if (angle > -45 && angle < 45 && y > ypos) {
                    direct = "down";
                }
                if (angle > -45 && angle < 45 && y < ypos) {
                    direct = "up";
                }
                if (((angle > -90 && angle < -45) || (angle > 45 && angle < 90)) && x > xpos) {
                    direct = "right";
                }
                if (((angle > -90 && angle < -45) || (angle > 45 && angle < 90)) && x < xpos) {
                    direct = "left";
                }
                move(e.type, direct)
            });

            function move(eventType, direct) {
                if (eventType == "mouseenter") {
                    switch (direct) {
                        case "down":
                            divs.css({
                                "left": "0px",
                                "top": h
                            }).stop(true, true).animate({
                                "top": "0px"
                            }, "fast");
                            break;
                        case "up":
                            divs.css({
                                "left": "0px",
                                "top": -h
                            }).stop(true, true).animate({
                                "top": "0px"
                            }, "fast");
                            break;
                        case "right":
                            divs.css({
                                "left": w,
                                "top": "0px"
                            }).stop(true, true).animate({
                                "left": "0px"
                            }, "fast");
                            break;
                        case "left":
                            divs.css({
                                "left": -w,
                                "top": "0px"
                            }).stop(true, true).animate({
                                "left": "0px"
                            }, "fast");
                            break;
                    }
                } else {
                    switch (direct) {
                        case "down":
                            divs.stop(true, true).animate({
                                "top": h
                            }, "fast");
                            break;
                        case "up":
                            divs.stop(true, true).animate({
                                "top": -h
                            }, "fast");
                            break;
                        case "right":
                            divs.stop(true, true).animate({
                                "left": w
                            }, "fast");
                            break;
                        case "left":
                            divs.stop(true, true).animate({
                                "left": -w
                            }, "fast");
                            break;
                    }
                }
            }
        }
    });
})(jQuery)

var wrap = $('.case .list-wrap .wrap');
$(".case li .list").each(function(i){
    $(this).shows(wrap.eq(i));
});

$(".hide_list").click(function(){
  $(".ul_wrap").removeClass("show");
  $(".ul_wrap").addClass('hide');
  $(".hide_list").removeClass("show");
  $(".hide_list").addClass('hide');
  $(".open_list").removeClass("hide");
  $(".open_list").addClass('show');
});

$(".open_list").click(function(){
  $(".ul_wrap").removeClass("hide");
  $(".ul_wrap").addClass('show');
  $(".hide_list").removeClass("hide");
  $(".hide_list").addClass("show");
  $(".open_list").removeClass("show");
  $(".open_list").addClass('hide');
});

$(" .material li").hover(function(){
    /*.children("a")*/
    $(this).children('.li_pop ').stop(false,false).animate({ opacity: "0.7" }, 900);
    $(this).children('.lipop_content ').stop(false,false).animate({ opacity: "1" }, 900);
    $(this).children('.lipop_content ').children('.collect').children('.collect_a').stop(false,false).animate({left: "20px",opacity:"1" }, 900);
    $(this).children('.lipop_content ').children('.see').children('.see_a').stop(false,false).animate({top: "120px",opacity:"1" }, 900);
    },function(){
    $(this).children('.li_pop ').stop(false,false).animate({ opacity: "0" }, 1500);
    $(this).children('.lipop_content ').stop(false,false).animate({ opacity: "0" }, 900);
    $(this).children('.lipop_content ').children('.collect').children('.collect_a').stop(false,false).animate({left: "-60px",opacity:"0" }, 900);
    $(this).children("a").children('.lipop_content ').children('.see').children('.see_a').stop(false,false).animate({top: "-40px",opacity:"0" }, 900);
});

$(".agent_wrap li .li_div").hover(function(){
    $(this).children('.img_pop').stop(false,false).animate({ opacity: "0.7" }, 900);
    $(this).children('.img_pop_content').stop(false,false).animate({ opacity: "1" }, 900);
    },function(){
    $(this).children('.img_pop').stop(false,false).animate({ opacity: "0" }, 1000);
    $(this).children('.img_pop_content').stop(false,false).animate({ opacity: "0" }, 900);
});

/*入驻弹出*/
$(".designer_no").on('click',function(event) {
    $(".prompt").removeClass("hide");
    $(".prompt").addClass('show');
});