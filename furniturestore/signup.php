<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - DECORA</title>
    <link rel="stylesheet" href="signup.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<header>
    <nav>
        <div class="logo">
            <img src="imges/logofurniture.png" alt="DECORA Logo">
        </div>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="products.html">Products</a></li>
            <li><a href="cart.html">Cart</a></li>
        </ul>
    </nav> 
</header>

<!-- Signup Form -->
<section class="auth-section">
    <div class="auth-container signup-container">
        <h2>Sign Up</h2>
        <form id="signup-form" action="signup.php" method="POST">
            <div class="input-field">
                <input type="text" id="full_name" name="full_name" placeholder="Full Name">
            </div>

            <div class="input-field">
                <input type="text" id="phone" name="phone" placeholder="Phone Number">
            </div>

            <div class="input-field">
                <input type="email" id="email" name="email" placeholder="Email">
            </div>

            <div class="input-field">
                <input type="text" id="address" name="address" placeholder="Address">
            </div>

            <div class="input-field-50">
                <input type="password" id="password" placeholder="Password" name="password">
                <input type="password" id="confirm_password" placeholder="Confirm password" name="confirm_password">
            </div>

            <button type="submit" class="signup-button">Sign Up</button>

            <div class="login-link">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </form>
    </div>
</section>

<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    // استقبال البيانات وتنظيفها
    $full_name = trim($_POST["full_name"]);
    $phone = trim($_POST["phone"]);
    $email = trim($_POST["email"]);
    $address = trim($_POST["address"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // مصفوفة لتخزين الأخطاء
    $errors = [];

    // التحقق من ملء الحقول
    if (empty($full_name)) $errors[] = "Full Name is required!";

    if (empty($phone)) $errors[] = "Phone Number is required!";

    if (!preg_match("/^[0-9]+$/", $phone)) $errors[] = "Phone Number must contain only numbers!";

    if (empty($email)) $errors[] = "Email is required!";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format!";

    if (empty($address)) $errors[] = "Address is required!";

    if (empty($password)) $errors[] = "Password is required!";

    if (strlen($password) < 6) $errors[] = "Password must be at least 6 characters!";

    if ($password !== $confirm_password) $errors[] = "Passwords do not match!";

    // إذا كانت هناك أخطاء، يتم عرضها في SweetAlert
    if (!empty($errors)) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Errors',
                html: '" . implode("<br>", $errors) . "',
                confirmButtonText: 'OK'
            });
        </script>";
        exit();
    }

    // التحقق من وجود البريد الإلكتروني مسبقًا
    $checkEmailQuery = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkEmailQuery);
    $stmt->bind_param("s", $email); //string
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0){
        $emailExists = true;
    }else{
        $emailExists = false;
    }

    $stmt->close();

    if ($emailExists) {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Email Already Exists',
                text: 'This email is already registered. Try another one!',
                confirmButtonText: 'OK'
            });
        </script>";
        exit();
    }

    // تشفير كلمة المرور وإدخال البيانات
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $insertQuery = "INSERT INTO users (full_name, phone, email, address, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sssss", $full_name, $phone, $email, $address, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Registration Successful!',
                text: 'You have been successfully registered.',
                confirmButtonText: 'Go to Login'
            }).then(() => {
                window.location.href = 'login.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Registration Failed!',
                text: 'Something went wrong. Please try again.',
                confirmButtonText: 'OK'
            });
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>

</body>
</html>
