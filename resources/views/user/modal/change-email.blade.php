<div class="modal fade" id="change-email">
    <div class="modal-dialog">
        <div class="modal-content border-primary">
            <div class="modal-header border-primary">
                <h4 class="text-primary"></i> Change Email Address</h4>
            </div>
            <div class="modal-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="mb-3">
                    <label for="currentEmailInput" class="form-label">Current Email</label>
                    <input name="currnet_email" type="email" class="form-control @error('current_email') is-invalid @enderror" id="currentEmailInput"
                        placeholder="Current Email">
                      @error('currnent_email')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                </div>

                <div class="mb-3">
                    <label for="newEmailInput" class="form-label">New Email</label>
                    <input name="new_email" type="email" class="form-control @error('new_email') is-invalid @enderror" id="newEmailInput"
                        placeholder="New Email">
                      @error('new_email')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                </div>

                <div class="mb-3">
                    <label for="confirmNewEmailInput" class="form-label">Confirm New Email</label>
                    <input name="new_email_confirmation" type="email" class="form-control" id="confirmNewEmailInput"
                        placeholder="Confirm New Email">
                      @error('confirm_email')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('change-email', $user->id)}}" method="post">
                    @csrf 
                    @method('PATCH')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-primary">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary">SAVE</button>
                </form>
            </div>
        </div>
    </div>
</div>
