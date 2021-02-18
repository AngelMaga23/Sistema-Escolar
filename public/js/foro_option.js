$(document).ready(function(){

    $('#form_foro').on('submit',function(e){
        e.preventDefault();
        $.ajax({
          type:'post',
          url:'../../../guardar_foro',
          data:new FormData(this),
          contentType: false,
          cache: false,
          processData:false,			
          success:function(response)
          {
              if(response.message == 'ok')
              {
                    message_succesfully_Foro();
                    window.location.href = '../../foro/'+response.data_id;

              }
              else{
                message_errorU(response.message);
              }
          }
        });
    });

    $('#form_foro_edit').on('submit',function(e){
      e.preventDefault();
      $.ajax({
        type:'post',
        url:'../../../update_foro',
        data:new FormData(this),
        contentType: false,
        cache: false,
        processData:false,			
        success:function(response)
        {
            if(response.message == 'ok')
            {
                    message_succesfully_UpdateForo();
                  window.location.href = '../../foro/'+response.data_id;

            }
            else{
              message_errorU(response.message);
            }
        }
      });
  });



});