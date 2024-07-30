<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
        }

        .todo-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .todo-input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .todo-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .todo-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .todo-item:last-child {
            border-bottom: none;
        }

        .todo-item input[type="checkbox"] {
            margin-right: 10px;
        }

        .delete-btn {
            background: none;
            border: none;
            color: #ff0000;
            font-size: 18px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="todo-container">
        <h1>Todo App</h1>
        <input type="text" class="todo-input" placeholder="Add a new task...">
        <ul class="todo-list">
            <li class="todo-item">
                <input type="checkbox">
                <span>Sample Task 1</span>
                <button class="delete-btn">&times;</button>
            </li>
            <li class="todo-item">
                <input type="checkbox">
                <span>Sample Task 2</span>
                <button class="delete-btn">&times;</button>
            </li>
        </ul>
    </div>

    <script>
        document.querySelector('.todo-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && this.value.trim() !== '') {
                const taskText = this.value.trim();
                const newTask = document.createElement('li');
                newTask.classList.add('todo-item');
                newTask.innerHTML = `
                    <input type="checkbox">
                    <span>${taskText}</span>
                    <button class="delete-btn">&times;</button>
                `;
                document.querySelector('.todo-list').appendChild(newTask);
                this.value = '';
            }
        });

        document.querySelector('.todo-list').addEventListener('click', function(e) {
            if (e.target.classList.contains('delete-btn')) {
                e.target.parentElement.remove();
            }
        });
    </script>
</body>

</html>