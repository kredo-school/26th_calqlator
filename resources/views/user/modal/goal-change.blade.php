<div class="modal fade" id="goal-change">
    <div class="modal-dialog">
        <div class="modal-content border-dark">
            <div class="modal-header border-dark">
                <h4 class="text-dark"></i> Confirm</h4>
            </div>
            <div class="modal-body">
                <h5 class="text-dark"><i class="fa-sharp fa-solid fa-circle-question icon-lg text-primary"></i>  Are you sure you want to save your changes?</h5>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('user.update', Auth::user()->id)}}" method="post">
                    @csrf 
                    @method('PATCH')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-secondary">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary">OK</button>
                </form>
            </div>
        </div>
    </div>
</div>