$(document).ready(function(){

    $('#form_evaluacion').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: '../../../guardar_evaluacion',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.message == 'ok') {
                    message_succesfully_Eval();
                    window.location.href = '../../evaluacion/'+response.data_id;

                }
                else {
                    message_errorU(response.message);
                }
            }
        });
    });

    $('#form_evaluacion_edit').on('submit',function(e){
      e.preventDefault();
      $.ajax({
        type:'post',
        url:'../../../update_evaluacion',
        data:new FormData(this),
        contentType: false,
        cache: false,
        processData:false,			
        success:function(response)
        {
            if(response.message == 'ok')
            {
                  message_succesfully_UpdateEval();
                  window.location.href = '../../evaluacion/'+response.data_id;

            }
            else{
              message_errorU(response.message);
            }
        }
      });
  });



});