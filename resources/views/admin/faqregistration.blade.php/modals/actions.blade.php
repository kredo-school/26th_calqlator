<!-- Complete -->
<div class="modal fade" id="store-faq-{{ $this->faq->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <div class="h5 modal-title text-danger">
                    Complete!
                </div>
            </div>
            <div class="modal-body">
                <p>The following questions and answers have added</p>
                    <div class="row">
                        <div class="col">{{ $this->faq->question }}</div>
                        <div class="col">{{ $this->faq->answer }}</div>
                    </div>
            </div>
            <div class="modal-footer text-end">
                <a href="{{ route('admin.faqregistration.index')}}">
                    <button type="button" class="btn btn-secondary btn-sm">
                        Back
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>