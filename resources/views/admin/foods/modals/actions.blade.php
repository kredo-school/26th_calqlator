{{-- Edit --}}
<div class="modal fade" id="edit-food{{ $food->id }}">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 50%;">
        <div class="modal-content text-dark text-start">
            <div class="modal-header border-0 pb-0 pt-3 px-5">
                <h3 class="h4">Edit the Food</h3>
            </div>
            <div class="modal-body px-5 py-0">
                <p class="mb-0">Are you sure you want to edit?</p>

                {{-- edit table --}}
                <div class="m-1 edit-table">
                    <table class="table text-center text-dark mb-0">
                        <thead class="food-edit">
                            <tr>
                                <th>Name</th>
                                <th>Calory</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <form action="{{ route('admin.foods.update', $food->id) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                    <input type="text" name="item_name" class="form-control" value="{{ old('item_name', $food->item_name) }}" required>
                                </td>
                                <td>
                                    <input type="text" name="calories" class="form-control" value="{{ old('calories', $food->calories) }}" required>
                                </td>
                                <td>
                                    <input type="text" name="amount" class="form-control" value="{{ old('amount', $food->amount) }}" required>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center p-0 my-3">
               
                     <button type="button" data-bs-dismiss="modal" class="btn btn-sm px-4 me-3 cancel-btn" style="width: 120px;">Cancel</button>
                     <button type="submit" class="btn btn-sm px-4 edit-btn" style="width: 120px;" value="{{ $food->item_name }}"><i class="fa-solid fa-circle-check"></i> Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- DELETE --}}
<div class="modal fade" id="delete-food{{ $food->id }}">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 50%;">
        <div class="modal-content text-dark text-start">
            <div class="modal-header border-0 pb-0 pt-3 px-5">
                <h3 class="h4">Delete Food</h3>
            </div>
            <div class="modal-body px-5 py-0">
                <p class="mb-0">Are you sure you want to delete?</p>

                <div class="m-1 delete-table" >
                    <table class="table table-borderless text-center text-dark mb-0">
                        <thead class="food-delete">
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
                                <td>{{ $food->item_name }}</td>
                                <td>{{ $food->calories }}</td>
                                <td>{{ $food->amount }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center p-0 my-3">
                <form action="{{ route('admin.foods.delete', $food->id)}}" method="post">
                    @csrf 
                    @method('DELETE')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm px-4 me-3 cancel-btn">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-danger text-white px-4"> <i class="fa-solid fa-circle-minus"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>