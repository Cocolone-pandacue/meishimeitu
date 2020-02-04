$(function(){
	$('.accordion-toggle').on('click',function(){
		if($(this).find('.fa').hasClass('fa-angle-down')){
			$('.accordion-toggle .pull-right').removeClass('fa-angle-down');
			$('.accordion-toggle .pull-right').addClass('fa-angle-right');
			return;
		}
		if($(this).find('.fa').hasClass('fa-angle-right')){
			$('.accordion-toggle .pull-right').removeClass('fa-angle-down');
			$('.accordion-toggle .pull-right').addClass('fa-angle-right');
			$(this).find('.pull-right').removeClass('fa-angle-right');
			$(this).find('.pull-right').addClass('fa-angle-down');
			return;
		}
	});
	$('.foc').on('mouseover',function(){
		$(this).timer;
		clearInterval($(this).timer);
		var This = $(this);
		var num= 0;
		var martop;
		This.timer = setInterval(function(){
			num-=2;
			martop = num +"px";
			This.find('a').css('marginTop',martop);
			if(num == -42) clearInterval(This.timer);
		},10);
	});
	$('.foc').on('mouseout',function(){
		clearInterval($(this).timer);
		var This = $(this);
		var num= -42;
		var martop;
		This.timer = setInterval(function(){
			num+=2;
			martop = num +"px";
			This.find('a').css('marginTop',martop);
			if(num == 0) clearInterval(This.timer);
		},10);
	});
 
	$('.all_pick').on('click',function(){                                                     //  点击全选按钮，全选确认        
		if($(this).hasClass('all_in')){
			$(".g-message input").prop('checked','true');
			$(this).removeClass("all_in")
			return;
		}else{
			$(".g-message input").prop('checked','');
			$(this).addClass("all_in")
			return;
		}
	});


	$(".g-messagelist").on('click',function(){
		if($(this).find('.g-messageclick').css('display') == 'block'){

			$(this).find('.g-messageclick').hide();
			$(this).find('.g-messageinfo').show();
			//return;
		}else{
			$(this).find('.g-messageclick').show();
			$(this).find('.g-messageinfo').hide();
			//return;
		}
		var message = $(this);
		var id = $(this).attr('data-id');
		var value = $(this).attr('data-values');
		var no_read = parseInt($('.no_read').children('span').text());
		if(value == 2){
			$.ajax({
				type: 'post',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: '/user/changeStatus',
				data: {id:id},
				dataType:'json',
				success: function(data){
					if(data.code == 1){
						$('.no_read').children('span').html(no_read-1);
						message.attr('data-values',1).removeClass('g-mesactive');
					}else{
						$.gritter.add({
							text: '<div><span class="text-center"><h5>' + data.msg + '</h5></span></div>',
							class_name: 'gritter-info gritter-center'
						});
					}
				}
			});
		}
	});

	$('.is_read').on('click',function(){
		var ids = {};
		$('.check_id').each(function(i){
			if($(this).is(':checked'))
			{
				var id = $(this).val();
				ids[i] = id;
			}
		});
		var status = 1;
		$.ajax({
			type: 'post',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: '/user/allChange',
			data: {ids:ids,status:status},
			dataType:'json',
			success: function(data){
				if(data.code == 1){
					location.reload();
				}
			}
		});
	});

	$('.is_delete').on('click',function(){
		var ids = {};
		$('.check_id').each(function(i){
			if($(this).is(':checked'))
			{
				var id = $(this).val();
				ids[i] = id;
			}
		});
		var status = 2;
		$.ajax({
			type: 'post',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: '/user/allChange',
			data: {ids:ids,status:status},
			dataType:'json',
			success: function(data){
				if(data.code == 1){
					location.reload();
				}
			}
		});
	});

	$('.reply').on('click',function(){
		var js_id = $(this).attr('data-id');
		$('.js_id').val(js_id);
	});
	//回复
	$('#btn_primary').on('click',function(){
		var title = $('.title').val();
		var content = $('.content').val();
		var js_id = $('.js_id').val();
		$.ajax({
			type: 'post',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: '/user/contactMe',
			data: {title:title,content:content,js_id:js_id},
			dataType:'json',
			success: function(data){
				if(data.code == 1){
					location.reload();
				}
			}
		});
	});

	//未读
	$('.no_read').on('click',function(){
		var type = $('.u-title').attr('data-values');
		console.log(type);
		window.location.href = '/user/messageList/'+type+'?is_read=1';
	});

	//全部
	$('.all_message').on('click',function(){
		var type = $('.u-title').attr('data-values');
		console.log(type);
		window.location.href = '/user/messageList/'+type+'?is_read=0';
	});
	//已读
	$('#is_read').on('click',function(){
		var type = $('.u-title').attr('data-values');
		console.log(type);
		window.location.href = '/user/messageList/'+type+'?is_read=2';
	});

	// 根据路由显示不同的菜单显示状态

	getBar();
	function getBar(){
		var url=window.location.href;
		var index=url.indexOf("?");
		var str;
		if(index!=-1){
		str=url.substring(url.lastIndexOf("=")+1, url.length);
		}
		switch(str){
		case "0":
			$(".mydownload_xifen_leixing a").eq(0).addClass("clickyed");
			$(".mydownload_xifen_leixing a").eq(0).siblings().removeClass("clickyed");
		break;
		case "1":
			$(".mydownload_xifen_leixing a").eq(1).addClass("clickyed");
			$(".mydownload_xifen_leixing a").eq(1).siblings().removeClass("clickyed");
		break;
		case "2":
			$(".mydownload_xifen_leixing a").eq(2).addClass("clickyed");
			$(".mydownload_xifen_leixing a").eq(2).siblings().removeClass("clickyed");
		break;
		};
	}
});