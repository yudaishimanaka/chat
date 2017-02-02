$(document).ready(function()
{
    $('#search').click(function()
    {
        var data = {userid : $('#userid').val()};
        $.ajax({
            type: "POST",
            url: "search.php",
            data: data,
            success: function(data, dataType)
            {
                $("#userdata").html(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                alert('Error : ' + errorThrown);
            }
        });
        return false;
    });
});
$(document).ready(function()
{
    $('#createroom').click(function()
    {
        var data = {roomname : $('#roomname').val(),
        roomid : $('#roomid').val(),
        pass : $('#pass').val()};
        $.ajax({
            type: "POST",
            url: "createroom.php",
            data: data,
            success: function(data, dataType)
            {
                alert(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                alert('Error : ' + errorThrown);
            }
        });
        return false;
    });
});
function file_upload()
{
    // フォームデータを取得
    var formdata = new FormData($('#my_form').get(0));

    // POSTでアップロード
    $.ajax({
        url  : "imgfile.php",
        type : "POST",
        data : formdata,
        cache       : false,
        contentType : false,
        processData : false,
        dataType    : "html"
    })
    .done(function(data, textStatus, jqXHR){
        alert("uploaded!");
        $("#chat-face").html("<img src=img/"+data+">");
    })
    .fail(function(jqXHR, textStatus, errorThrown){
        alert("fail");
    });
}