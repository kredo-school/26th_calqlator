{{-- Edit --}}
<div class="modal fade" id="edit-food{{ $food->id }}">
    <div class="modal-dialog">
        <div class="modal-content text-dark text-start">
            <div class="modal-header border-0 pb-0 pt-3 px-5">
                <h3 class="h4">Edit the Food</h3>
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
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $food->name }}</td>
                                <td>{{ $food->calory }}</td>
                                <td>{{ $food->amount }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Edit Form --}}
                <form action="{{ route('admin.foods.update', $food->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group mb-3">
                        <input type="text" name="name" id="name" value="{{ $food->name }}" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="number" name="calory" id="calory" value="{{ $food->calory }}" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <input type="number" name="amount" id="amount" value="{{ $food->amount }}" class="form-control" required>
                            <select name="unit" id="unit" class="form-select" required>
                                <option value="g" {{ $food->unit === 'g' ? 'selected' : '' }}>g</option>
                                <option value="ml" {{ $food->unit === 'ml' ? 'selected' : '' }}>ml</option>
                                <option value="quantity" {{ $food->unit === 'quantity' ? 'selected' : '' }}>quantity</option>
                                <option value="one meal" {{ $food->unit === 'one meal' ? 'selected' : '' }}>one meal</option>
                            </select>
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
<div class="modal fade" id="delete-food{{ $food->id }}">
    <div class="modal-dialog">
        <div class="modal-content text-dark text-start">
            <div class="modal-header border-0 pb-0 pt-3 px-5">
                <h3 class="h4">Delete Food</h3>
            </div>
            <div class="modal-body px-5 py-0">
                <p class="mb-0">Are you sure you want to delete?</p>

                <div class="m-1 delete-table" >
                    <table class="table table-borderless text-center text-dark mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Calories</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $food->id }}</td>
                                <td>{{ $food->name }}</td>
                                <td>{{ $food->calories }}</td>
                                <td>{{ $food->amount }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center p-0 my-3">
                <form action="{{ route('admin.delete', $food->id)}}" method="post">
                    @csrf 
                    @method('DELETE')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm px-4 me-3 cancel-btn">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-danger text-white px-4"> <i class="fa-solid fa-circle-minus"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>