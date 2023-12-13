$(document).ready(function() {

    // Initialize form validation
    $('#userForm').validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 6,
            },
            password_confirmation: {
                required: true,
                equalTo: '#password',
            },
        },
        messages: {
            name: {
                required: 'Please enter a name',
            },
            email: {
                required: 'Please enter a valid email address',
                email: 'Please enter a valid email address',
            },
            password: {
                required: 'Please enter a password',
                minlength: 'Password must be at least 6 characters long',
            },
            password_confirmation: {
                required: 'Please confirm the password',
                equalTo: 'Passwords do not match',
            },
        },
        submitHandler: function(form) {
            // Form is valid, proceed with AJAX request
            submitForm(form);
        }
    });

    // Function to handle AJAX request
    function submitForm(form) {
        var formData = new FormData(form);

        // Disable the submit button during the AJAX request
        $('#submitForm').prop('disabled', true);

        // Submit form using Ajax
        $.ajax({
            url: $(form).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Handle success, you can redirect or perform any other action
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Admin created successfully!',
                    position: 'top-end',
                    timerProgressBar: true,
                    timer: 3000,
                    showConfirmButton: false,
                    animation: true,
                });
                // Reset the form
                $('#userForm')[0].reset();
                // Enable the submit button after handling the AJAX request
                $('#submitForm').prop('disabled', false);
            },
            error: function(xhr, status, error) {
                // Handle errors
                $('#submitForm').prop('disabled', false);

                if (xhr.status === 422) {
                    // Handle validation errors
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';

                    // Iterate through validation errors and create a message
                    $.each(errors, function(key, value) {
                        errorMessage += value[0] + '<br>';
                    });

                    // Display the Swal modal with validation errors
                    Swal.fire({
                        icon: 'error',
                        html: errorMessage.split('<br>')[0],
                        position: 'top-end',
                        timerProgressBar: true,
                        timer: 3000,
                        showConfirmButton: false,
                        animation: true,
                    });
                } else {
                    // Display a generic error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while creating the admin.',
                        position: 'top-end',
                        timerProgressBar: true,
                        timer: 3000,
                        showConfirmButton: false,
                        animation: true,
                    });
                }
            }
        });
    }
});
