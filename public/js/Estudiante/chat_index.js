function Content_Chats()
{
  var token = $("#token").val();
  $.ajax({
    url: '../content_chats',
    type: 'post',
    headers: {
        'X-CSRF-TOKEN': token
    },
    // data: {
    //     "id":id
    // },
    success:function(response)
    {
        $('#content_chat').html(response);
    },
});
}

function Chat()
{
  var token = $("#token").val();
  $.ajax({
    url: '../student_information',
    type: 'post',
    headers: {
        'X-CSRF-TOKEN': token
    },
    // data: {
    //     "id":id
    // },
    success:function(response)
    {
        $('#content_chat').html(response);
    },
  });
}

$(document).ready(function () {
    Content_Chats();



});