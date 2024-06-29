<form method="POST" action="{{ route('guardar.problema') }}">
    @csrf
    <div class="form-group">
        <label for="ruta">Ruta o ubicación del problema:</label>
        <input type="text" class="form-control" id="ruta" name="ruta">
    </div>
    <div class="form-group">
        <label for="problema">Problema:</label>
        <input type="text" class="form-control" id="problema" name="problema">
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Guardar Problema</button>
</form>
<a href="{{ url('/home') }}" class="btn btn-secondary">Volver a Inicio</a>
