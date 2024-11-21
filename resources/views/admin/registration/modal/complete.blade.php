{{-- Exercise Modal --}}
<div class="modal fade" id="exercise-save">
    <div class="modal-dialog">
        <div class="modal-content border-success">
            <div class="modal-header border-0 text-center">
                <h3 class="display-1 fw-bold">Complete!</h3>
            </div>
            <div class="modal-body">
                <p class="fs-3">The following exercise have been added</p>
                <div id="modalDataList" class="text-center"></div>
            </div>
            <div class="modal-footer border-0">
                <a href="{{ route('admin.exercise.registration.index') }}" class="btn btn-outline-success text-decoration-none">Back</a>
            </div>
        </div>
    </div>
</div>
