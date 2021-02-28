<td>
    <a href="{{ url('/foro/'.$id.'/edit') }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2" data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
    <button class="btn btn-datatable btn-icon btn-transparent-dark" onclick="Delete_Foro({{ $id }})" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="far fa-trash-alt"></i></button>
    {{-- <button class="btn btn-datatable btn-icon btn-transparent-dark" data-toggle="tooltip" data-placement="top" title="Ver foro"><i class="far fa-eye"></i></button> --}}
</td>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>