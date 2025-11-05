<div class="modal fade" id="modalEliminarTarea">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar tarea</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_eliminar_tarea" action="{{ route('tareas.destroy',$tarea->id) }}" method="post">
                    @method('delete')
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <p>
                                ¿Deseas eliminar la tarea <strong>{{$tarea->titulo}}</strong>?
                            </p>
                            <p>Si es así, de clic en eliminar.</p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-cancelar"></i> Cancelar
                </button>
                <button class="btn btn-danger" type="submit" form="form_eliminar_tarea">
                    Eliminar
                </button>
            </div>
        </div>
    </div>
</div>

