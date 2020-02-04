/*
* @Author: Marte
* @Date:   2019-01-29 14:03:15
* @Last Modified by:   Marte
* @Last Modified time: 2019-01-30 14:40:20
*/

'use strict';
/*$(function(){*/
    // setTimeout(function(){
    //     $(".artificial_intelligence_wrap").addClass('hide');
    // },10);
    // setTimeout(function(){
    //     $(".make_logo_wrap").removeClass('hide');
    // },10);
/*    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/task/brainpower/processingajaxshow',
        type: 'post',
        dataType: 'json',
        data: {
            name: name,
            title: title,
            industry: industry,
            logo: logo,
            color: color
        },
        success: function (data) {
            console.log(data.svg);
            console.log(data.svg[0].data);

            $(".artificial_intelligence_wrap").addClass('hide');
            $(".make_logo_wrap").removeClass('hide');
        },
        error: function (data) {
            console.log('错误');
        }
    });
});
var name = $('#name').val();
var title = $('#title').val();
var industry = $('#industry').val();
var logo = $('#logo').val();
var color = $('#color').val();*/
/*var name = $('#name').val();
var title = $('#title').val();
var industry = $('#industry').val();
var logo = $('#logo').val();
var color = $('#color').val();
// console.log(name);
// console.log(title);
// console.log(industry);
// console.log(logo);
// console.log(color);
$.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: '/task/brainpower/processingajaxtwo',
    type: 'post',
    dataType: 'json',
    data: {
        name: name,
        title: title,
        industry: industry,
        logo: logo,
        color: color
    },
    success: function (data) {
        console.log(data.svg);
    },
    error: function (data) {
        console.log('错误');
    }
});*/

function add(name,title,industry,logo,color) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/task/brainpower/processingajaxdown',
        type: 'post',
        dataType: 'json',
        data: {
            name: name,
            title: title,
            industry: industry,
            logo: logo,
            color: color
        },
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log('错误');
        }
    })
}

$(function () {
    $("#add").on('click',function () {
        var add = $("svg");
        alert(add);
    })
})