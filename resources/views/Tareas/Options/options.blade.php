<td>
    <a href="{{ url('/tarea/'.$id.'/edit') }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i class="far fa-edit"></i></a>
    <button class="btn btn-datatable btn-icon btn-transparent-dark" onclick="Delete_Tarea({{ $id }})"><i class="far fa-trash-alt"></i></button>
    <button class="btn btn-datatable btn-icon btn-transparent-dark" data-toggle="modal" data-target="#exampleModal" data-backdrop="static" data-keyboard="false" onclick="Tareas_recibidas({{ $id }})"><i class="fas fa-mail-bulk"></i></button>
</td>