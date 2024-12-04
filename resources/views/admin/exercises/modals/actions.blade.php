
{{-- Edit --}}
<div class="modal fade" id="edit-exercise{{ $exercise->id }}">
    <div class="modal-dialog">
        <div class="modal-content text-dark text-start">
            <div class="modal-header border-0 pb-0 pt-3 px-5">
                <h3 class="h4">Edit the Exercise</h3>
            </div>
            <div class="modal-body px-5 py-0">
                <p class="mb-0">Are you sure you want to edit?</p>

                {{-- Confirmation table --}}
                <div class="confirmation-table mb-4">
                    <table class="table table-borderless text-center text-dark mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Calory</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $exercise->name }}</td>
                                <td>{{ $exercise->calories }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Edit Form --}}
                <form action="{{ route('admin.exercises.update', $exercise->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ $exercise->name }}" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="calory">Calory/ 10minute</label>
                        <input type="number" name="calory" id="calory" value="{{ $exercise->calories }}" class="form-control" required>
                    </div>

                    <div class="modal-footer border-0 justify-content-center p-0 my-3">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-sm px-4 me-3 cancel-btn">Cancel"></button>
                        <button type="submit" class="btn btn-sm px-4 edit-btn"><i class="fa-solid fa-circle-check"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


{{-- DELETE --}}
<div class="modal fade" id="delete-exercise{{ $exercise->id }}">
    <div class="modal-dialog">
        <div class="modal-content text-dark text-start">
            <div class="modal-header border-0 pb-0 pt-3 px-5">
                <h3 class="h4">Delete the Exercise</h3>
            </div>
            <div class="modal-body px-5 py-0">
                <p class="mb-0">Are you sure you want to delete?</p>

                <div class="m-1 confirmation-table" >
                    <table class="table table-borderless text-center text-dark mb-0">
                        <thead>
                            <tr>
                                <th class="bg-danger">ID</th>
                                <th class="bg-danger">NAME</th>
                                <th class="bg-danger">CALORY/10 minute</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $exercise->id }}</td>
                                <td>{{ $exercise->name }}</td>
                                <td>{{ $exercise->calory }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center p-0 my-3">
                <form action="{{ route('admin.delete', $exercise->id)}}" method="post">
                    @csrf 
                    @method('DELETE')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm px-4 me-3 cancel-btn">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-danger text-white px-4"> <i class="fa-solid fa-circle-minus"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>