<td>
    @if (!$estatu)
        
    @else
        <a href="{{ url('ver-evaluacion/'.$id) }}" class="btn btn-success">Presentar</a>
    @endif
</td>