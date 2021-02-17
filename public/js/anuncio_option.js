$(document).ready(function(){

    $('#form_publicacion').on('submit',function(e){
        e.preventDefault();
        $.ajax({
          type:'post',
          url:'../../../guardar_publicacion',
          data:new FormData(this),
          contentType: false,
          cache: false,
          processData:false,			
          success:function(response)
          {
              if(response.message == 'ok')
              {
                    message_succesfully_Publicacion();
                    window.location.href = '../../publicacion/'+response.data_id;

              }
              else{
                message_errorU(response.message);
              }
          }
        });
    });

    $('#form_publicacion_edit').on('submit',function(e){
      e.preventDefault();
      $.ajax({
        type:'post',
        url:'../../../update_publicacion',
        data:new FormData(this),
        contentType: false,
        cache: false,
        processData:false,			
        success:function(response)
        {
            if(response.message == 'ok')
            {
                message_succesfully_UpdatePublicacion();
                  window.location.href = '../../publicacion/'+response.data_id;

            }
            else{
              message_errorU(response.message);
            }
        }
      });
  });



});