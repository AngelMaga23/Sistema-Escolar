function Content_Chats()
{
  var token = $("#token").val();
  $.ajax({
    url: '../content_chats_profesor',
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

function Chat(idalumno)
{
  var token = $("#token").val();
  $.ajax({
    url: '../student_information_profesor',
    type: 'post',
    headers: {
        'X-CSRF-TOKEN': token
    },
    data: {
        "idalumno":idalumno
    },
    success:function(response)
    {
        $('#content_chat').html(response);
    },
  });
}

$(document).ready(function () {
    Content_Chats();



});