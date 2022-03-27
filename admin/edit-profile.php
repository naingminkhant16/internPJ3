<?php require_once "header.php" ?>
<?php
$id = $_GET['id'];
$admin = new DB();
$admin = $admin->crud("SELECT * FROM admins WHERE id=:id", [':id' => $id], true);
$uiErr = [];

if (!empty($_POST)) {
    //check change psw or not
    if (!empty($_POST['new_password']) || !empty($_POST['current_password']) || !empty($_POST['confirm_password'])) {

        $current_psw = $_POST['current_password'];
        $new_psw = $_POST['new_password'];
        $confirm_psw = $_POST['confirm_password'];
        //check current psw
        if (password_verify($current_psw, $admin->password)) {
            //check psw input fields is empty or not
            (empty(trim($_POST['new_password']))) ? $uiErr['new_password'] = "New Password is required!" : '';
            (empty(trim($_POST['confirm_password']))) ? $uiErr['confirm_password'] = "Confirm Password is required!" : '';


            //check new psw is match with confirm psw
            if (!empty($uiErr) || $new_psw != $confirm_psw) {
                $pswMatchErr = "Password doesn't match";
            } else {
                //check new psw length
                if (strlen(trim($new_psw)) < 6) {
                    $pswLengthErr = "Password must have atleast 6 characters";
                } else {
                    //all backend validation success and make query
                    $db = new DB();
                    $query = "UPDATE admins SET name=:name,password=:password WHERE id=:id";
                    $data = [
                        ":name" => $_POST['name'],
                        ":password" => password_hash($new_psw, PASSWORD_DEFAULT),
                        ":id" => $id
                    ];
                    $result = $db->crud($query, $data);
                    if ($result) {
                        $_SESSION['admin']['name'] = $_POST['name'];
                        echo "<script>alert('Successfully updated Profile!');window.location.href='admin.php'</script>";
                    }
                }
            }
        } else {
            $currentPswErr = "Incorrect Current Password!";
        }
    } else {
        //update only name
        (empty(trim($_POST['name']))) ? $uiErr['name'] = "Name is required!" : '';
        if (empty($uiErr)) {
            $db = new DB();
            $query = "UPDATE admins SET name=:name WHERE id=:id";
            $data = [
                ":name" => $_POST['name'],
                ":id" => $id
            ];
            $result = $db->crud($query, $data);
            if ($result) {
                $_SESSION['admin']['name'] = $_POST['name'];
                echo "<script>alert('Successfully updated Profile!');window.location.href='admin.php'</script>";
            }
        }
    }
}
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">My Profile</h1>
</div>

<form action="" method="POST" style="max-width: 500px;" class="container mt-4">
    <h3 class="text-uppercase text-center mb-3">Change Password</h3>
    <?php if ($currentPswErr) : ?>
        <div class="alert alert-warning">
            <i class="fa-solid fa-triangle-exclamation pe-2"></i>
            <?= $currentPswErr ?>
        </div>
    <?php endif; ?>
    <?php if ($pswLengthErr) : ?>
        <div class="alert alert-warning">
            <i class="fa-solid fa-triangle-exclamation pe-2"></i>
            <?= $pswLengthErr ?>
        </div>
    <?php endif; ?>
    <?php if ($pswMatchErr) : ?>
        <div class="alert alert-warning">
            <i class="fa-solid fa-triangle-exclamation pe-2"></i>
            <?= $pswMatchErr ?>
        </div>
    <?php endif; ?>
    <div class="mb-3">
        <label class="form-label">Name :</label>
        <p style="color:#EF1510"><?= isset($uiErr['name']) ? '*' . $uiErr['name'] : '' ?></p>
        <input type="text" name="name" class="form-control" value="<?= $admin->name ?>">
    </div>
    <div class="mb-4">
        <label class="form-label">Current Password :</label>
        <p style="color:#EF1510"><?= isset($uiErr['current_password']) ? '*' . $uiErr['current_password'] : '' ?></p>
        <input type="password" name="current_password" class="form-control">
    </div>
    <div class="mb-4">
        <label class="form-label">New Password :</label>
        <p style="color:#EF1510"><?= isset($uiErr['new_password']) ? '*' . $uiErr['new_password'] : '' ?></p>
        <input type="password" name="new_password" class="form-control">
    </div>
    <div class="mb-4">
        <label class="form-label">Confrim Password :</label>
        <p style="color:#EF1510"><?= isset($uiErr['confirm_password']) ? '*' . $uiErr['confirm_password'] : '' ?></p>
        <input type="password" name="confirm_password" class="form-control">
    </div>
    <div class="mb-3">
        <button class="btn btn-outline-dark w-100" type="submit">Submit</button>
    </div>
</form>

<?php require_once "footer.php" ?>