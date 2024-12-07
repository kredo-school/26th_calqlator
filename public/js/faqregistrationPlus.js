let faqIndex = 1;

document.getElementById('add-faq').addEventListener('click', function () {
    const container = document.getElementById('faqs-container');
    const faqItem = document.createElement('div');
    faqItem.classList.add('faq-item');
    faqItem.innerHTML = `
            <div class="row">
                <div class="col-2"></div>
                <div class="col-4 form-group">
                    <label for="question-${faqIndex}" class="form-label">Question</label>
                    <textarea name="faqs[${faqIndex}][question]" id="question-${faqIndex}" rows="6" class="form-control" required></textarea>
                </div>
                <div class="col-4 form-group">
                    <label for="answer-${faqIndex}" class="form-label">Answer</label>
                    <textarea name="faqs[${faqIndex}][answer]" id="answer-${faqIndex}" rows="6" class="form-control" required></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-9"></div>
                <div class="col-2 mt-3 form-group">
                    <button type="button" class="remove-faq">delete</button>
                </div>
            </div>
    `;
    container.appendChild(faqItem);
    faqIndex++;
});


document.getElementById('faqs-container').addEventListener('click', function (event) {
    if (event.target.classList.contains('remove-faq')) {
        event.target.closest('.faq-item').remove();
    }
});