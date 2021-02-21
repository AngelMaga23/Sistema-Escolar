<td>
    <button 
        class="btn btn-datatable btn-icon btn-transparent-dark mr-2" 
        data-toggle="modal" 
        data-target="#exampleModal" 
        data-backdrop="static" 
        data-keyboard="false"
        onclick="Entrega({{ $id }})"
    >
        <i 
            class="far fa-eye"
        >
        </i>
    </button>
    <button 
    class="btn btn-datatable btn-icon btn-transparent-dark mr-2" 
    data-toggle="modal" 
    data-target="#mdCalificacion" 
    data-backdrop="static" 
    data-keyboard="false"
    onclick="Entrega({{ $id }})"
    >
        <i class="fas fa-sort-numeric-up-alt"></i>
    </button>

</td>