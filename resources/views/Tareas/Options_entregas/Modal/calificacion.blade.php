<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <input type="hidden" id="identrega_cal" value="{{ $entrega[0]->id }}">
            <label for="">Calificación</label>
            <input type="number" name="calificacion" id="calificacion" class="form-control" min="0"  value="{{ $entrega[0]->calificacion }}">
        </div>
        <button class="btn btn-success" onclick="Calificar()">Calificar</button>
    </div>
</div>