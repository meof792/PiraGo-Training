<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <style>
        .error { color: red; }
    </style>
</head>
<body>
    <?php
    $email = $password = "";
    $emailErr = $passwordErr = "";
    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $errors[] = $emailErr;
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                $errors[] = $emailErr;
            }
        }

        if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
            $errors[] = $passwordErr;
        } else {
            $password = test_input($_POST["password"]);
            if (strlen($password) < 8) {
                $passwordErr = "Password must be at least 8 characters";
                $errors[] = $passwordErr;
            } 
            if (!preg_match('/[A-Z]/', $password)) {
                $passwordErr = "Password must contain at least one uppercase letter";
                $errors[] = $passwordErr;
            }
            if (!preg_match('/[a-z]/', $password)) {
                $passwordErr = "Password must contain at least one lowercase letter";
                $errors[] = $passwordErr;
            }
            if (!preg_match('/[0-9]/', $password)) {
                $passwordErr = "Password must contain at least one number";
                $errors[] = $passwordErr;
            }
            if (!preg_match('/[\W]/', $password)) {
                $passwordErr = "Password must contain at least one special character";
                $errors[] = $passwordErr;
            }
        }

        if (empty($errors)) {
            echo "<p>Form submitted successfully!</p>";
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>">
            <span class="error"><?php echo $emailErr; ?></span>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <span class="error"><?php echo $passwordErr; ?></span>
        </div>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
