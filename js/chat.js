$(function(){
    setInterval(function () {
        var data = {roomid : $('#roomid').val()};
        $.ajax({
            url: "loading.php",
            type: "POST",
            data: data,
            success: function(data, dataType)
            {
                $('#chatlog').html(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                alert('Error : ' + errorThrown);
            }
        });
    }, 1000);
});
$(document).ready(function()
{
    $('#send').click(function()
    {
        var data = {userid : $('#userid').val(),
                    request : $('#request').val(),
                    roomid : $('#roomid').val()};
        $.ajax({
            type: "POST",
            url: "send.php",
            data: data,
            success: function(data, dataType)
            {
                $("#chatlog").append(data);
                $('body').delay(100).animate({
                    scrollTop: $(document).height()
                },1500);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                alert('Error : ' + errorThrown);
            }
        });
        return false;
    });
});