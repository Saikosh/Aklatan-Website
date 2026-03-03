<?php
// Include your existing connection file
include 'connect.php';

// Check if the connection was successful
if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from the form
    $student_number = $_POST['student-number'];
    $full_name      = $_POST['full-name']; 
    $role           = $_POST['college-dept']; 
    $password_hash  = $_POST['password'];
    $confirm_pass   = $_POST['confirm-password'];

    // Password validation pattern: 16-32 chars, includes letters, numbers, and special characters
    $passwordPattern = '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{16,32}$/';

    // 1. Check if passwords match
    if ($pass !== $confirm_pass) {
        echo "<script>alert('Passwords do not match!');</script>";
    } 
    // New: Check if password meets the complexity requirements
    elseif (!preg_match($passwordPattern, $pass)) {
        echo "<script>alert('Password must be 16-32 characters long and include a combination of letters, numbers, and special characters.');</script>";
    }
    else {
        // 2. Check if Student Number already exists
        $checkSql = "SELECT student_number FROM [Users] WHERE student_number = ?";
        $checkParams = array($student_number);
        $checkStmt = sqlsrv_query($conn, $checkSql, $checkParams);

        if (sqlsrv_has_rows($checkStmt)) {
            echo "<script>alert('This Student Number is already registered!');</script>";
        } else {
            // 3. Proceed with registration
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
            
            // Role Logic: Determine role based on student number (Example: if it starts with 'ADM')
            $role = (strpos($student_number, 'ADM') === 0) ? 'Admin' : 'Student';

            $sql = "INSERT INTO [Users] (student_number, password_hash, role, is_active) VALUES (?, ?, ?, ?)";
            $params = array($student_number, $hashed_password, $role, 1);
            
            $stmt = sqlsrv_query($conn, $sql, $params);

            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            } else {
                // Redirecting clears the POST history
                echo "<script>alert('Account created successfully!'); window.location='login.php';</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Virtual Aklatang Emilio Aguinaldo</title>
    <link rel="stylesheet" href="create_account.css">
</head>
<body>

    <main class="page-wrapper">
        <div class="registration-card">
            <div class="form-container">
                
                <header class="form-header">
                    <p class="site-title">The Virtual Aklatang<br>Emilio Aguinaldo</p>
                    <h1 class="main-heading">Sign Up</h1>
                    <p class="sub-heading">Please create an account</p>
                </header>

                <form action="" method="POST" class="signup-form">
                    <div class="input-group">
                        <label for="student-number">Student Number</label>
                        <input type="text" id="student-number" name="student-number" required>
                    </div>

                    <div class="input-group">
                        <label for="full-name">Full Name</label>
                        <input type="text" id="full-name" name="full-name" required>
                    </div>

                    <div class="input-group">
                        <label for="college-dept">College Department</label>
                        <select id="college-dept" name="college-dept">
                            <option value="" disabled selected>Dropdown selection</option>
                            <option value="CEAT">CEAT</option>
                            <option value="CBAA">CBAA</option>
                            <option value="CLAC">CLAC</option>
                            <option value="CoED">CoED</option>
                            <option value="CCJE">CCJE</option>
                            <option value="CICS">CICS</option>
                            <option value="COS">COS</option>
                            <option value="CTHM">CTHM</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="input-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="confirm-password" required>
                    </div>

                    <button type="submit" class="submit-btn">Create Account</button>
                </form>

            </div> 
        </div> 
    </main>

</body>
</html>