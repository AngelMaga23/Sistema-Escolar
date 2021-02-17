<td>
    <a href="{{ url('/clase/'.$id.'/edit') }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i class="far fa-edit"></i></a>
    <button class="btn btn-datatable btn-icon btn-transparent-dark" onclick="Delete_clase({{ $id }})"><i class="far fa-trash-alt"></i></button>
    <a href="{{ url('/clase-alumnos/'.$id) }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i class="fas fa-users"></i></a>
    <a href="{{ url('/clase-asignaturas/'.$id) }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i class="fas fa-atlas"></i></a>
</td>