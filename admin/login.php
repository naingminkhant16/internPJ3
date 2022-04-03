<?php
session_start();
if (!empty($_SESSION['admin']) || !empty($_SESSION['loggedin'])) {
    echo "ERROR";
    die();
};
require_once "../config/DB.php";
require_once "../config/functions.php";
if (!empty($_POST)) {
    //check empty input fields
    (!isEmptyInput($_POST)) ? $noErr = true : $err = isEmptyInput($_POST);

    if ($noErr && empty($err)) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        //check email exist
        $result = $db->crud("SELECT * FROM admins WHERE email=:email", [':email' => $email], true);
        if ($result) {
            //check password match if email exist
            if (password_verify($password, $result->password)) {
                $_SESSION['admin']['name'] = $result->name;
                $_SESSION['admin']['email'] = $result->email;
                $_SESSION['admin']['id'] = $result->id;
                $_SESSION['loggedin'] = true;
                header("location: index.php");
                die();
            } else {
                //incorrect password error
                $pswErr = true;
            }
        } else {
            //email doesn't exit error
            $emailErr = true;
        }
    } else {
        //found empty input fileds and make ui error message
        $findErrArr = ['email', "password"];
        $err = explode(',', $err);
        $uiErr = [];
        foreach ($findErrArr as $findErr) {
            if (in_array($findErr, $err)) {
                $uiErr[$findErr] = $findErr . " is required!";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Login</title>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/fontawesome.min.css">
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>

    <div class="login p-5 shadow-lg">
        <h4 class="text-light text-center h3 mb-3">Admin Login</h4>
        <form action="" method="POST">
            <?php if ($emailErr) : ?>
                <div class="alert alert-danger p-2"><i class="fa-solid fa-triangle-exclamation pe-2"></i>Email doesn't exist!</div>
            <?php endif; ?>
            <?php if ($pswErr) : ?>
                <div class="alert alert-danger p-2"><i class="fa-solid fa-triangle-exclamation pe-2"></i>Incorrect Password</div>
            <?php endif; ?>

            <div class="mb-3">
                <label class="form-label fw-bold">Email:</label>
                <p style="color:#EF1510"><?= isset($uiErr['email']) ? '*' . $uiErr['email'] : '' ?></p>
                <input type="email" name="email" class="form-control" style="<?= isset($uiErr['email']) ? "border:1px solid red;" : ''; ?>">
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Password:</label>
                <p style="color:#EF1510"><?= isset($uiErr['password']) ? '*' . $uiErr['password'] : '' ?></p>
                <input type="password" name="password" class="form-control" style="<?= isset($uiErr['password']) ? "border:1px solid red;" : ''; ?>">
            </div>
            <div class="mb-3">
                <button class="btn text-light w-100" type="submit" style="background-color: #067593;">LOGIN</button>
            </div>
        </form>
    </div>

</body>

</html>