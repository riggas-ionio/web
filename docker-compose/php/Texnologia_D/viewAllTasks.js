document.addEventListener('DOMContentLoaded', function() {
    let currentListId = null;

    // Function to display messages
    function displayMessage(message, isError = false) {
        const messageContainer = document.getElementById('message-container');
        messageContainer.textContent = message;
        messageContainer.style.color = isError ? 'red' : 'green';
    }

    // Attach event listeners to delete buttons
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const listItem = this.parentElement;
            const listId = listItem.getAttribute('data-id');

            // Confirm before deletion
            if (confirm("Are you sure you want to delete this task list?")) {
                const formData = new FormData();
                formData.append('delete_list_id', listId);

                fetch('view_tasks.php', {
                    method: 'POST',
                    body: formData
                }).then(response => response.text())
                  .then(data => {
                      console.log(data);
                      if (data.includes("deleted")) {
                          listItem.remove();
                          displayMessage("Task list deleted successfully.");
                      } else {
                          displayMessage("Error deleting task list: " + data, true);
                      }
                  }).catch(error => console.error('Error:', error));
            }
        });
    });

    // Attach event listeners to add task buttons
    document.querySelectorAll('.add-task-btn').forEach(button => {
        button.addEventListener('click', function() {
            const listId = this.parentElement.getAttribute('data-id');
            currentListId = listId;
            document.getElementById('add-task-form').style.display = 'block';
        });
    });

    // Handle task addition
    document.getElementById('submit-task-btn').addEventListener('click', function() {
        const taskTitle = document.getElementById('task_title').value;

        if (taskTitle && currentListId) {
            const formData = new FormData();
            formData.append('add_task', 'true');
            formData.append('task_title', taskTitle);
            formData.append('list_id', currentListId);

            fetch('view_tasks.php', {
                method: 'POST',
                body: formData
            }).then(response => response.text())
              .then(data => {
                  displayMessage(data.includes("successfully") ? "Task added successfully." : "Error adding task: " + data, !data.includes("successfully"));
                  document.getElementById('add-task-form').style.display = 'none';
                  document.getElementById('task_title').value = ''; // Reset the form
              }).catch(error => console.error('Error:', error));
        }
    });

    // Cancel adding task
    document.getElementById('cancel-task-btn').addEventListener('click', function() {
        document.getElementById('add-task-form').style.display = 'none';
    });

    // Attach event listeners to toggle tasks buttons
    document.querySelectorAll('.toggle-tasks-btn').forEach(button => {
        button.addEventListener('click', function() {
            const tasksContainer = this.nextElementSibling; // The tasks container
            if (tasksContainer.style.display === 'none' || tasksContainer.style.display === '') {
                tasksContainer.style.display = 'block';
                this.textContent = '▼'; // Change to down arrow
            } else {
                tasksContainer.style.display = 'none';
                this.textContent = '▶'; // Change to right arrow
            }
        });
    });
});
