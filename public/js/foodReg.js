let addRow = document.getElementById('input_row');
var count = 2;

function add() {
    let div = document.createElement('DIV');
    div.classList.add('row', 'mt-4');

    let label = document.createElement('LABEL');
    label.classList.add('form-label', 'fs-5', 'fw-bold', 'green');
    label.textContent = 'No.' + count;
    div.appendChild(label);

    // Food Name
    let divCol_name = document.createElement('DIV');
    divCol_name.classList.add('col-3');

    let label_name = document.createElement('LABEL');
    label_name.setAttribute('for', 'name_'+count);
    label_name.classList.add('form-label', 'fw-bold');
    label_name.textContent = 'Food Name';
    divCol_name.appendChild(label_name);

    let input_name = document.createElement('INPUT');
    input_name.setAttribute('type', 'text');
    input_name.setAttribute('name', 'item_name[]');
    input_name.setAttribute('id', 'name_'+count);
    input_name.classList.add('form-control', 'custom-border');
    input_name.setAttribute('placeholder', 'ex) Banana');
    input_name.setAttribute('required', 'true');
    divCol_name.appendChild(input_name);

    let errorName = document.createElement('DIV');
    errorName.classList.add('text-danger', 'small');
    errorName.textDontent = '{{ $message }}';
    divCol_name.appendChild(errorName);
    div.appendChild(divCol_name);

    // Image
    let divCol_image = document.createElement('DIV');
    divCol_image.classList.add('col-3');

    let label_image = document.createElement('LABEL');
    label_image.setAttribute('for', 'image_'+count);
    label_image.classList.add('form-label', 'fw-bold');
    label_image.textContent = 'Image';
    divCol_image.appendChild(label_image);

    let input_image = document.createElement('INPUT');
    input_image.setAttribute('type', 'file');
    input_image.setAttribute('name', 'image[]');
    input_image.setAttribute('id', 'image_'+count);
    input_image.classList.add('form-control');
    divCol_image.appendChild(input_image);

    let text_image = document.createElement('DIV');
    text_image.setAttribute('id', 'image');
    text_image.classList.add('form-text', 'text-muted');

    let image_formats = document.createElement('P');
    image_formats.classList.add('my-0');
    image_formats.textContent = 'Allowed formats: jpeg, jpg, png, gif.';
    text_image.appendChild(image_formats);

    let image_size = document.createElement('P');
    image_size.classList.add('my-0');
    image_size.textContent = 'Maximum file size is 1048kb.';
    text_image.appendChild(image_size);
    divCol_image.appendChild(text_image);

    let errorImage = document.createElement('DIV');
    errorImage.classList.add('text-danger', 'small');
    errorImage.textDontent = '{{ $message }}';
    divCol_image.appendChild(errorImage);
    div.appendChild(divCol_image);

    // calory
    let divCol_calory = document.createElement('DIV');
    divCol_calory.classList.add('col-2');

    let label_calory = document.createElement('LABEL');
    label_calory.setAttribute('for', 'calory'+count);
    label_calory.classList.add('form-label', 'fw-bold');
    label_calory.textContent = 'Foods Calory';
    divCol_calory.appendChild(label_calory);

    let inputGroup_cal = document.createElement('DIV');
    inputGroup_cal.classList.add('input-group', 'd-flex', 'align-items-center');

    let input_calory = document.createElement('INPUT');
    input_calory.setAttribute('type', 'number');
    input_calory.setAttribute('name', 'calories[]');
    input_calory.setAttribute('id', 'calory_'+count);
    input_calory.classList.add('form-control', 'custom-border', 'w-50');
    input_calory.setAttribute('placeholder', 'ex) 40');
    input_calory.setAttribute('required', 'true');
    inputGroup_cal.appendChild(input_calory);

    let span_cal = document.createElement('SPAN');
    span_cal.classList.add('input-group-append');
    span_cal.textContent = 'kcal';
    inputGroup_cal.appendChild(span_cal);
    divCol_calory.appendChild(inputGroup_cal);

    let errorCalory = document.createElement('DIV');
    errorCalory.classList.add('text-danger', 'small');
    errorCalory.textDontent = '{{ $message }}';
    divCol_calory.appendChild(errorCalory);

    div.appendChild(divCol_calory);

    // per amount
    let divCol_amount = document.createElement('DIV');
    divCol_amount.classList.add('col-3');

    let label_amount = document.createElement('LABEL');
    label_amount.setAttribute('for', 'amount_'+count);
    label_amount.classList.add('form-label', 'fw-bold');
    label_amount.textContent = 'Per Amount';
    divCol_amount.appendChild(label_amount);

    let input_amount = document.createElement('INPUT');
    input_amount.setAttribute('type', 'text');
    input_amount.setAttribute('name', 'amount[]');
    input_amount.setAttribute('id', 'amount_'+count);
    input_amount.classList.add('form-control', 'custom-border');
    input_amount.setAttribute('placeholder', 'ex) 1 per');
    input_amount.setAttribute('aria-describedby', 'amount');
    input_amount.setAttribute('required', 'true');
    divCol_amount.appendChild(input_amount);

    let small_amount = document.createElement('SMALL');
    small_amount.setAttribute('id', 'amount');
    small_amount.classList.add('form-text', 'text-muted');
    small_amount.textContent = 'Please also input the unit of measurement for the amount of ingredients.';
    divCol_amount.appendChild(small_amount);

    let errorAmount = document.createElement('DIV');
    errorAmount.classList.add('text-danger', 'small');
    errorAmount.textDontent = '{{ $message }}';
    divCol_amount.appendChild(errorAmount);
    div.appendChild(divCol_amount);

    // delete button
    let divCol_del = document.createElement('DIV');
    divCol_del.classList.add('col-1', 'd-flex', 'justify-content-center', 'align-items-center');

    let del_btn = document.createElement('BUTTON');
    del_btn.setAttribute('type', 'button');
    del_btn.classList.add('btn', 'del-btn');
    del_btn.setAttribute('onclick', 'del(this)');

    let del_i = document.createElement('I');
    del_i.classList.add('fa-solid', 'fa-minus');
    del_btn.appendChild(del_i);
    divCol_del.appendChild(del_btn);
    div.appendChild(divCol_del);

    addRow.appendChild(div);
    count++;
}



function del(o) {
    o.parentNode.parentNode.remove();
}

