function Description_test()
{
    var idexamen = document.getElementById('idexamen').value;
    $.ajax({
        url: '../../description_test',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "id":idexamen
        },

        success:function(response)
        {
            $('#id_content_evaluacion').html(response);
        },
    });
}

function start_test()
{
    var idexamen = document.getElementById('idexamen').value;
    $.ajax({
        url: '../../start_test',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "id":idexamen
        },

        success:function(response)
        {
            $('#id_content_evaluacion').html(response);
        },
    });
}

$(document).ready(function () {
    Description_test();



});