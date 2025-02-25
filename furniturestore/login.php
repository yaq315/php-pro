<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DECORA</title>
    <link rel="stylesheet" href="login.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
session_start();

// استدعاء ملف الاتصال
include 'db_config.php';  // تأكد من مسار الملف الصحيح

// تعريف متغيرات الخطأ
$errors = [
    "email" => "",
    "password" => ""
];

// التحقق عند إرسال النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // التحقق من ملء الحقول
    if (empty($email)) {
        $errors["email"] = "Email is required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format!";
    }

    if (empty($password)) {
        $errors["password"] = "Password is required!";
    }
    
    // إذا كانت هناك أخطاء في الحقول، نعرضها تحت الحقول في النموذج
    if (empty($errors["email"]) && empty($errors["password"])) {
        // إذا لم تكن هناك أخطاء، يتم التحقق من البيانات في قاعدة البيانات
        $sql = "SELECT id, email, password FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $db_email, $db_password);
                $stmt->fetch();     

                // التحقق من كلمة المرور
                if (password_verify($password, $db_password)) {
                    // نجاح تسجيل الدخول
                    $_SESSION["user_id"] = $id;
                    $_SESSION["email"] = $db_email;


                    echo "<script>
                        Swal.fire({
                            title: 'Success!',
                            text: 'Login successful!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = 'index.php';
                        });
                    </script>";
                    exit(); 
                } else {
                    echo 
                        $errors["password"]= "Incorrect password!";
                  
                }
            } else {
                echo "<script>
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Email not found! Please sign up first.',
                        icon: 'error',
                        confirmButtonText: 'Try Again'
                    });
                </script>";
            }

            $stmt->close();
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Database error. Please try again later.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
    }

    // إغلاق الاتصال بقاعدة البيانات
    $conn->close();
}
?>  

<header>
    <nav>
        <div class="logo">
            <img src="imges/logofurniture.png" alt="DECORA Logo">
        </div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="cart.php">Cart</a></li>
        </ul>
    </nav> 
</header>

<!-- Login Form -->
<section class="auth-section">
    <div class="auth-container">
        <h2>Login</h2>
        <form id="login-form" action="login.php" method="POST">
            <div class="input-field">
                <input type="email" placeholder="Email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                <?php if (!empty($errors["email"])): ?>
                    <span class="error-message"><?= $errors["email"] ?></span>
                <?php endif; ?>
            </div>

            <div class="input-field">
                <input type="password" placeholder="Password" id="password" name="password">
                <?php if (!empty($errors["password"])): ?>
                    <span class="error-message"><?= $errors["password"] ?></span>
                <?php endif; ?>
            </div>

            <button type="submit" class="login-button">Login</button>

            <div class="signup-link">
                <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
            </div>
        </form>
    </div>
</section>

</body>
</html>