$(document).ready(function(){

    $('#form_perfil').on('submit',function(e){
        e.preventDefault();
        $.ajax({
          type:'post',
          url:'../../perfil_update',
          data:new FormData(this),
          contentType: false,
          cache: false,
          processData:false,			
          success:function(response)
          {
              if(response.message == 'ok')
              {
                    message_succesfully_Perfil_edit();
                    window.location.href = '../../perfil/'+response.id;

              }
              else{
                message_errorU(response.message);
              }
          }
        });
    });

});