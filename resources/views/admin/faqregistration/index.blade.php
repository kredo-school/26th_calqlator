@extends('layouts.faqregistration')

@section('title', 'Admin: FAQregistration')

@section('content')
    <form action="{{ route('admin.faqregistration.store')}}" method="POST">
        @csrf
        <div class="row my-3">
            <div class="col-2"></div>
            <div class="col-2 fw-bold mt-2">
                FAQ Registration
            </div>
            <div class="col-1">
                <button type="button" id="add-faq" class="btn btn-outline-0 btn-lg">
                    <i class="fa-solid fa-circle-plus text-danger"></i>
                </button>
            </div>
            <div class="col-4"></div>
            <div class="col-2 mt-3 form-group">
                <button type="submit" class="btn text-success btn-outline-success px-4">Save</button>
            </div>
        </div>
        <div id="faqs-container">
            <div class="faq-item">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-4 form-group">
                        <label for="question" class="form-label">Question</label>
                        <textarea name="faqs[0][question]" id="question" rows="6" class="form-control" required></textarea>
                    </div>
                    <div class="col-4 form-group">
                        <label for="answer" class="form-label">Answer</label>
                        <textarea name="faqs[0][answer]" id="answer" rows="6" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9"></div>
                    <div class="col-2 mt-3 form-group">
                        <button type="button" class="remove-faq" style="display:none;">delete</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        let faqIndex = 1;

        $('#add-faq').on('click', function () {
            $('#faqs-container').append(`
                <div class="faq-item">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-4 form-group">
                            <label for="question" class="form-label">Question</label>
                            <textarea name="faqs[${faqIndex}][question]" id="question" rows="6" class="form-control" required></textarea>
                        </div>
                        <div class="col-4 form-group">
                            <label for="answer" class="form-label">Answer</label>
                            <textarea name="faqs[${faqIndex}][answer]" id="answer" rows="6" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-9"></div>
                        <div class="col-2 mt-3 form-group">
                            <button type="button" class="remove-faq">delete</button>
                        </div>
                    </div>
                </div>
            `);
            faqIndex++;
        });

        $(document).on('click', '.remove-faq', function () {
            $(this).closest('.faq-item').remove();
        });
    </script>
@endsection