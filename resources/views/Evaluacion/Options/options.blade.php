<td>
    <a href="{{ url('/evaluacion/'.$id.'/edit') }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i class="far fa-edit"></i></a>
    <button class="btn btn-datatable btn-icon btn-transparent-dark" onclick="Delete_Eval({{ $id }})"><i class="far fa-trash-alt"></i></button>
    <a href="{{ url('/evaluacion/'.$id.'/questions') }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i class="fas fa-question"></i></a>
    <a href="{{ url('/evaluacion/'.$id.'/alumnos') }}" class="btn btn-datatable btn-icon btn-transparent-dark"><i class="fas fa-user-edit"></i></a>
</td>