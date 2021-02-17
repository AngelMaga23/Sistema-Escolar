<td>
    <a href="{{ url('/publicacion/'.$id.'/edit') }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i class="far fa-edit"></i></a>
    <button class="btn btn-datatable btn-icon btn-transparent-dark" onclick="Delete_Publicacion({{ $id }})"><i class="far fa-trash-alt"></i></button>
    <button class="btn btn-datatable btn-icon btn-transparent-dark" data-toggle="modal" data-target="#exampleModal" data-backdrop="static" data-keyboard="false" onclick="Archivos({{ $id }})"><i class="fas fa-file-upload"></i></button>
</td>