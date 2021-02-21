<td>
    <a href="{{ url('/tarea/'.$id.'/edit') }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i class="far fa-edit"></i></a>
    <button class="btn btn-datatable btn-icon btn-transparent-dark" onclick="Delete_Tarea({{ $id }})"><i class="far fa-trash-alt"></i></button>
    <a href="{{ url('/tarea/'.$id.'/entregas') }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i class="fas fa-mail-bulk"></i></a>
</td>