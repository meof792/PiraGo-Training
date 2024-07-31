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
            max-height: 80vh;
            width: 50%;
        }

        h1,
        h3 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
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
            color: black;
            font-size: 18px;
            cursor: pointer;
        }

        .complete-btn {
            background: none;
            border: none;
            color: green;
            font-size: 18px;
            cursor: pointer;
        }

        .overdue {
            background-color: red;
            /* Màu đỏ cho các công việc quá hạn */
        }

        .not-overdue {
            background-color: orange;
            /* Màu cam cho các công việc chưa tới hạn */
        }

        .complete {
            text-decoration: line-through;
            background-color: green;
            /* Màu xanh cho các công việc đã hoàn thành */
        }
    </style>

    <script>
        function add() {
            document.getElementById('formAdd').style.display = 'block';
            document.getElementById('buttonAdd').style.display = 'none';
        }
    </script>
</head>

<body>
    <div class="todo-container">
        <h1>Todo App</h1>
        <ul class="todo-list" style="height: 60%;">
            @foreach ($todos as $todo)
            @php
            $today = \Carbon\Carbon::today()->format('d-m-Y');
            $deadline = \Carbon\Carbon::parse($todo->deadline)->format('d-m-Y');
            $isComplete = false;
            if($todo->status == 1){
                $isComplete = true;
            }
            $isOverdue = $deadline < $today; @endphp <li class="todo-item {{ $isComplete ? 'complete' : ($isOverdue ? 'overdue' : 'not-overdue') }}">
                <form action="complete" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$todo->id}}">
                    <button type="submit" class="complete-btn">&#10003;</button>
                </form>
                <span><b>{{ $todo->title }}</b> at <b>{{ $deadline }}</b></span>
                <form action="delete" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$todo->id}}">
                    <button type="submit" class="delete-btn">X</button>
                </form>
                </li>
                @endforeach
        </ul>
        <hr>
        <div id="formAdd" style="display: none">
            <form action="addcheck" method="post" style="text-align: center; justify-content: center; align-items: center;">
                @csrf
                <h3>Add new task</h3>
                <input type="text" placeholder="Enter a task's name" name="taskName" required>
                <input type="date" name="deadline" required>
                <button type="submit">Xác nhận</button>
            </form>
        </div>
        <div id="buttonAdd" style="text-align: center; justify-content: center; align-items: center;">
            <button onclick="add()">Add a new task</button>
        </div>
    </div>
</body>

</html>