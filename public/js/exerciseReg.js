
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
    label_name.textContent = 'Exercise Name';
    divCol_name.appendChild(label_name);
    let input_name = document.createElement('INPUT');
    input_name.setAttribute('type', 'text');
    input_name.setAttribute('name', 'name[]');
    input_name.setAttribute('id', 'name_'+count);
    input_name.classList.add('form-control', 'custom-border');
    input_name.setAttribute('placeholder', 'ex) running');
    divCol_name.appendChild(input_name);
    let errorName = document.createElement('DIV');
    errorName.classList.add('text-danger', 'small');
    errorName.textDontent = '{{ $message }}';
    divCol_name.appendChild(errorName);
    div.appendChild(divCol_name);
    // calory
    let divCol_calory = document.createElement('DIV');
    divCol_calory.classList.add('col-2', 'me-2');
    let label_calory = document.createElement('LABEL');
    label_calory.setAttribute('for', 'calory'+count);
    label_calory.classList.add('form-label', 'fw-bold');
    label_calory.textContent = 'Calory per 10 minutes';
    divCol_calory.appendChild(label_calory);
    let inputGroup_cal = document.createElement('DIV');
    inputGroup_cal.classList.add('input-group', 'd-flex', 'align-items-center');
    let input_calory = document.createElement('INPUT');
    input_calory.setAttribute('type', 'number');
    input_calory.setAttribute('name', 'calories[]');
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
