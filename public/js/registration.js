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
    divCol_name.classList.add('col-2', 'me-2');

    let label_name = document.createElement('LABEL');
    label_name.setAttribute('for', 'name_'+count);
    label_name.classList.add('form-label', 'fw-bold');
    label_name.textContent = 'Food Name';
    divCol_name.appendChild(label_name);

    let input_name = document.createElement('INPUT');
    input_name.setAttribute('type', 'text');
    input_name.setAttribute('name', 'item_name');
    input_name.setAttribute('id', 'name_'+count);
    input_name.classList.add('form-control', 'custom-border');
    input_name.setAttribute('placeholder', 'ex) Banana');
    divCol_name.appendChild(input_name);

    let errorName = document.createElement('DIV');
    errorName.classList.add('text-danger', 'small');
    errorName.textDontent = '{{ $message }}';
    divCol_name.appendChild(errorName);
    div.appendChild(divCol_name);

    // Image
    let divCol_image = document.createElement('DIV');
    divCol_image.classList.add('col-2', 'me-2');

    let label_image = document.createElement('LABEL');
    label_image.setAttribute('for', 'image_'+count);
    label_image.classList.add('form-label', 'fw-bold');
    label_image.textContent = 'Image';
    divCol_image.appendChild(label_image);

    let input_image = document.createElement('INPUT');
    input_image.setAttribute('type', 'file');
    input_image.setAttribute('name', 'image');
    input_image.setAttribute('id', 'image_'+count);
    input_image.classList.add('form-control');
    divCol_image.appendChild(input_image);

    let errorImage = document.createElement('DIV');
    errorImage.classList.add('text-danger', 'small');
    errorImage.textDontent = '{{ $message }}';
    divCol_image.appendChild(errorImage);
    div.appendChild(divCol_image);

    // calory
    let divCol_calory = document.createElement('DIV');
    divCol_calory.classList.add('col-2', 'me-2');

    let label_calory = document.createElement('LABEL');
    label_calory.setAttribute('for', 'calory'+count);
    label_calory.classList.add('form-label', 'fw-bold');
    label_calory.textContent = 'Foods Calory';
    divCol_calory.appendChild(label_calory);

    let inputGroup_cal = document.createElement('DIV');
    inputGroup_cal.classList.add('input-group', 'd-flex', 'align-items-center');

    let input_calory = document.createElement('INPUT');
    input_calory.setAttribute('type', 'number');
    input_calory.setAttribute('name', 'calories');
    input_calory.setAttribute('id', 'calory_'+count);
    input_calory.classList.add('form-control', 'custom-border', 'w-50');
    input_calory.setAttribute('placeholder', 'ex) 40');
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
    divCol_amount.classList.add('col-2', 'me-2');

    let label_amount = document.createElement('LABEL');
    label_amount.setAttribute('for', 'amount_'+count);
    label_amount.classList.add('form-label', 'fw-bold');
    label_amount.textContent = 'Per Amount';
    divCol_amount.appendChild(label_amount);

    let inputGroup_amount = document.createElement('DIV');
    inputGroup_amount.classList.add('input-group');

    let input_amount = document.createElement('INPUT');
    input_amount.setAttribute('type', 'number');
    input_amount.setAttribute('name', 'amount');
    input_amount.setAttribute('id', 'amount_'+count);
    input_amount.classList.add('form-control', 'custom-border');
    input_amount.setAttribute('placeholder', 'ex) 1');
    inputGroup_amount.appendChild(input_amount);

    let select = document.createElement('SELECT');
    select.classList.add('input-group-append', 'form-select', 'ms-2');

    let option0 = document.createElement('OPTION');
    option0.setAttribute('selected', 'selected');
    option0.setAttribute('disabled', 'disabled');
    option0.textContent = 'Select unite';
    select.appendChild(option0);

    let option1 = document.createElement('OPTION');
    option1.setAttribute('value', 'g');
    option1.textContent = 'g';
    select.appendChild(option1);

    let option2 = document.createElement('OPTION');
    option2.setAttribute('value', 'ml');
    option2.textContent = 'ml';
    select.appendChild(option2);

    let option3 = document.createElement('OPTION');
    option3.setAttribute('value', 'quantity');
    option3.textContent = 'quantity';
    select.appendChild(option3);

    let option4 = document.createElement('OPTION');
    option4.setAttribute('value', 'one_meal');
    option4.textContent = 'one meal';
    select.appendChild(option4);
    inputGroup_amount.appendChild(select);
    divCol_amount.appendChild(inputGroup_amount);

    let errorAmount = document.createElement('DIV');
    errorAmount.classList.add('text-danger', 'small');
    errorAmount.textDontent = '{{ $message }}';
    divCol_amount.appendChild(errorAmount);
    div.appendChild(divCol_amount);

    // delete button
    let divCol_del = document.createElement('DIV');
    divCol_del.classList.add('col-1', 'position');

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
    updateLabels();
}

