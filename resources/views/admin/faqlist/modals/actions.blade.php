<!-- Update -->
<div class="modal fade" id="edit-faq-{{ $faq->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="h5 modal-title">
                    Edit the FAQ
                </div>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to edit?</p>
                <table class="table align-middle text-secondary">
                    <thead class="small table-success text-secondary">
                        <tr>
                            <th>ID</th>
                            <th>Questions</th>
                            <th>Answer</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>{{ $faq->id }}</td>
                                <td><input type="text" name="new_question" id="question" class="form-control" value="{{ old('question' , $faq->question)}}"></input></td>
                                <td><input type="text" name="new_answer" id="answer" class="form-control" value="{{ old('answer' , $faq->answer)}}"></input></td>
                            </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.faqlist.update', $faq->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <button type="button" class="btn btn-secondary btn-sm">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa-solid fa-circle-check text-white"></i>Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete-faq-{{ $faq->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <div class="h5 modal-title text-danger">
                    Delete the FAQ
                </div>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete?</p>
                <table class="table align-middle text-secondary">
                    <thead class="small table-danger text-secondary">
                        <tr>
                            <th>ID</th>
                            <th>Questions</th>
                            <th>Answer</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>{{ $faq->id }}</td>
                                <td>{{ $faq->question }}</td>
                                <td>{{ $faq->answer }}</td>
                            </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.faqlist.delete', $faq->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary btn-sm text-white">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm text-white"><i class="fa-solid fa-circle-check text-white"></i>Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>