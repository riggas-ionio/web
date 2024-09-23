document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('signup-form');

    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent form from submitting normally

        // Clear any previous error messages
        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

        const formData = new FormData(form);

        // Send form data to PHP for validation and database check
        fetch('process-signup.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'error') {
                // Show error messages below the respective fields
                document.getElementById(`${data.field}-error`).textContent = data.message;
            } else if (data.status === 'success') {
                window.location.href = 'signup-success.html'; // Redirect on success
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
