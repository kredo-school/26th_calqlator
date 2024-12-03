<div class="modal fade" id="change-password">
    <div class="modal-dialog">
        <div class="modal-content border-primary">
            <div class="modal-header border-primary">
                <h4 class="text-primary"></i> Change Password</h4>
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
                    <label for="currentPasswordInput" class="form-label">Current Password</label>
                    <input name="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" id="currnetPasswordInput"
                        placeholder="Current Password">
                      @error('current_password')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                </div>

                <div class="mb-3">
                    <label for="newPasswordInput" class="form-label">New Password</label>
                    <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                        placeholder="New Password">
                      @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                </div>

                <div class="mb-3">
                    <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
                    <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
                        placeholder="Confirm New Password">
                      @error('confirm_password')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('change-password', $user->id)}}" method="post">
                    @csrf 
                    @method('PATCH')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-primary">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary">SAVE</button>
                </form>
            </div>
        </div>
    </div>
</div>
