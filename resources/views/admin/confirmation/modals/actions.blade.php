{{-- confirm --}}
<div class="modal fade" id="confirm-food{{ $food->id }}">
    <div class="modal-dialog">
        <div class="modal-content text-dark text-start">
            <div class="modal-header border-0 pb-0 pt-3 px-5">
                <h3 class="h4">Confirm Food</h3>
            </div>
            <div class="modal-body px-5 py-0">
                <p class="mb-0">Are you sure you want to confirm the food below?</p>

                <div class="m-1 confirmation-table">
                    <table class="table table-borderless text-center text-dark mb-0">
                        <thead class="food-confirmation">
                            <tr>
                                <th>Name</th>
                                <th>Calories</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $food->item_name }}</td>
                                <td>{{ $food->calories }}</td>
                                <td>{{ $food->amount }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center p-0 my-3">
                <form action="{{ route('admin.food.confirm', $food->id)}}" method="post">
                    @csrf 
                    @method('PATCH')
                        <button type="button" data-bs-dismiss="modal" class="btn btn-sm px-4 me-3 cancel-btn">Cancel</button>
                        <button type="submit" class="btn btn-sm px-4 food-confirm-btn"> <i class="fa-solid fa-circle-check"></i> Confirm</button>
                </form>    
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
                <p class="mb-0">Are you sure you want to delete the food below?</p>

                <div class="m-1 confirmation-table" >
                    <table class="table table-borderless text-center text-dark mb-0">
                        <thead>
                            <tr>
                                <th class="bg-danger">Name</th>
                                <th class="bg-danger">Calories</th>
                                <th class="bg-danger">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $food->item_name }}</td>
                                <td>{{ $food->calories }}</td>
                                <td>{{ $food->amount }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center p-0 my-3">
                <form action="{{ route('admin.food.delete', $food->id)}}', $food->id)}}" method="post">
                    @csrf 
                    @method('DELETE')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm px-4 me-3 cancel-btn">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-danger text-white px-4"> <i class="fa-solid fa-circle-minus"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>