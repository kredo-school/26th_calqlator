var form = document.getElementById('edit-form');
var btn = document.getElementById('edit-OK');
var change_password_modal = document.getElementById('change-password');
console.log(has_error_js);
var change_email_modal = document.getElementById('change-email');
console.log(has_error_js);

btn.addEventListener('click', function() {
    form.submit();
});