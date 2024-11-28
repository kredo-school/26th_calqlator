@extends('layouts.admin')

@section('title', 'Admin: FAQregistration')

@section('content')
    <form action="{{ route('admin.faqregistration.store')}}" method="POST">
        @csrf
        <div class="row my-3">
            <div class="col-2"></div>
            <div class="col-4 fw-bold">
                FAQ Registration  <button type="button" id="add-faq"><i class="fa-solid fa-circle-plus text-danger"></i></button>
            </div>
        </div>
        <div class="row" id="faqs-container">
            <div class="col-2"></div>
            <div class="col-4 form-group">
                <label for="question" class="form-label">Question</label>
                <textarea name="faqs[0][question]" id="question" rows="6" class="form-control" required></textarea>
            </div>
            <div class="col-4 form-group">
                <label for="answer" class="form-label">Answer</label>
                <textarea name="faqs[0][answer]" id="answer" rows="6" class="form-control"></textarea>
            </div>
            <div class="col">
                <button type="button" class="remove-question" style="display:none;">delete</button>
            </div>
        </div>
        <div class="row">
            <div class="col-6"></div>
            <div class="col-4 text-end mt-3 form-group">
                <button type="submit" class="btn text-success btn-outline-success px-4">Save</button>
            </div>
        </div>
    </form>
    <script>
        let questionIndex = 1;

        $('#add-question').on('click', function () {
            $('#faqs-container').append(`
                <div class="question-item">
                    <label>質問:</label>
                    <input type="text" name="questions[${questionIndex}][question]" required>
                    <label>答え:</label>
                    <input type="text" name="questions[${questionIndex}][answer]" required>
                    <button type="button" class="remove-question">削除</button>
                </div>
            `);
            questionIndex++;
        });

        $(document).on('click', '.remove-question', function () {
            $(this).closest('.question-item').remove();
        });
    </script>
@endsection