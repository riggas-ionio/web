document.addEventListener('DOMContentLoaded', function() {
    let currentListId = null;
    let addTaskFormVisible = false;

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
            const listItem = this.parentElement;
            currentListId = listItem.getAttribute('data-id');

            // Toggle task form visibility
            const taskForm = listItem.querySelector('.add-task-form');
            if (!taskForm) {
                const formHtml = `
                    <div class="add-task-form" style="display:block;">
                        <input type="text" class="task-input" placeholder="Enter task title">
                        <button class="submit-task-btn">Add Task</button>
                        <button class="cancel-task-btn">Cancel</button>
                    </div>`;
                listItem.insertAdjacentHTML('beforeend', formHtml);

                // Attach event listeners to dynamically added buttons
                const newTaskForm = listItem.querySelector('.add-task-form');
                newTaskForm.querySelector('.submit-task-btn').addEventListener('click', function() {
                    const taskTitle = newTaskForm.querySelector('.task-input').value;
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
                              newTaskForm.remove(); // Hide the form after submission
                          }).catch(error => console.error('Error:', error));
                    }
                });

                newTaskForm.querySelector('.cancel-task-btn').addEventListener('click', function() {
                    newTaskForm.remove(); // Hide form on cancel
                });
            } else {
                taskForm.style.display = taskForm.style.display === 'block' ? 'none' : 'block';
            }
        });
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
