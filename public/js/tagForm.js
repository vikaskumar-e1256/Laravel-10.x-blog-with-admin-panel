$(document).ready(function() {

    // Initialize form validation
    $('#tagForm').validate({
        rules: {
            name: {
                required: true,
                // Add more rules if needed
            },
            slug: {
                required: true,
                // Add more rules if needed
            },
            // Add rules for other form fields
        },
        messages: {
            name: {
                required: 'Please enter a title',
                // Add more custom messages if needed
            },
            slug: {
                required: 'Please enter a slug',
                // Add more custom messages if needed
            },
            // Add custom messages for other form fields
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
                    text: 'Tag created successfully!',
                    position: 'top-end',
                    timerProgressBar: true,
                    timer: 3000,
                    showConfirmButton: false,
                    animation: true,
                });
                // Reset the form
                $('#tagForm')[0].reset();
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
                        text: 'An error occurred while creating the tag.',
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
