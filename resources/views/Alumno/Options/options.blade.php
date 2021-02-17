<td>
    <a href="{{ url('/alumno/'.$id.'/edit') }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i class="far fa-edit"></i></a>

    @if ($estatu == 'A')
        <button class="btn btn-datatable btn-icon btn-transparent-dark" onclick="Estatu_usuario({{ $id }})"><i class="fas fa-ban"></i></button>
    @else
        <button class="btn btn-datatable btn-icon btn-transparent-dark" onclick="Estatu_usuario({{ $id }})"><i class="far fa-check-circle"></i></button>
    @endif
</td>
