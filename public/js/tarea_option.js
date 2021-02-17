$(document).ready(function(){

    $('#form_tarea').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: '../../../guardar_tarea',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.message == 'ok') {
                    message_succesfully_Tarea();
                    window.location.href = '../../tarea/'+response.data_id;

                }
                else {
                    message_errorU(response.message);
                }
            }
        });
    });

    $('#form_tarea_edit').on('submit',function(e){
      e.preventDefault();
      $.ajax({
        type:'post',
        url:'../../../update_tarea',
        data:new FormData(this),
        contentType: false,
        cache: false,
        processData:false,			
        success:function(response)
        {
            if(response.message == 'ok')
            {
                  message_succesfully_UpdateTarea();
                  window.location.href = '../../tarea/'+response.data_id;

            }
            else{
              message_errorU(response.message);
            }
        }
      });
  });



});