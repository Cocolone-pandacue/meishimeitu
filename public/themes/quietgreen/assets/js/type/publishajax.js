function showResult(str){
    $.ajax({
        type: "GET",
        url : "publishajax",
        datatype : 'json',
        data: {q:str} ,
        success :function (data) {
            console.log(data);
            // alert(data);
            // $("#livesearch").val(data);
            // document.getElementById("livesearch").innerHTML=data;
            // document.getElementById("livesearch").style.border="1px solid #A5ACB2";
        }
    })
}