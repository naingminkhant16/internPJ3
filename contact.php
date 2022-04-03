<?php require "header.php" ?>
<?php
if (!empty($_POST)) {
    (!isEmptyInput($_POST)) ? $noErr = true : $err = isEmptyInput($_POST);
    if ($noErr && empty($err)) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $query = "INSERT INTO mails(name,email,subject,message) VALUES (:name,:email,:subject,:message)";
        $data = [
            ":name" => $name,
            ":email" => $email,
            ":subject" => $subject,
            ":message" => $message
        ];
        $insertSuccess = $db->crud($query, $data);
        if ($insertSuccess) {
            echo "<script>alert('Thanks For your message. We value your info.');window.location.href='index.php'</script>";
        }
    } else {
        //found empty input fileds and make ui error message
        $findErrArr = ['name', "email", 'subject', "message"];
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
<div class="bg img-fluid" style="background-image:url('./images/ab.jpg')">
    <div class="bg-text">
        <h3>Contact Us</h3>
    </div>
</div>
<!-- Header End -->

<!-- About Start -->
<div class="row container my-2 my-sm-5 g-3" style="margin: 0 auto;">
    <div class="col col-12 col-md-8">
        <div style="margin:0 auto;max-width: 800px;">
            <h2 class="mt-3 mb-0">Stay in touch</h2>
            <hr>
            <p style="color: black;font-size: 16px;">You can manualy send us message on <a href="">info@goodvibe.org.mm</a></p>
            <form action="" method="POST" class="row g-3 py-2">
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <p style="color:#EF1510"><?= isset($uiErr['name']) ? '*' . $uiErr['name'] : '' ?></p>
                    <input type="text" name="name" class="form-control" placeholder="Enter name.." />
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <p style="color:#EF1510"><?= isset($uiErr['email']) ? '*' . $uiErr['email'] : '' ?></p>
                    <input type="email" name="email" class="form-control" placeholder="Email address.." />
                </div>
                <div class="col-md-12">
                    <label class="form-label">Subject</label>
                    <p style="color:#EF1510"><?= isset($uiErr['subject']) ? '*' . $uiErr['subject'] : '' ?></p>
                    <input type="text" name="subject" class="form-control" placeholder="Subject.." />
                </div>
                <div class="col">
                    <label class="form-label">Message</label>
                    <p style="color:#EF1510"><?= isset($uiErr['message']) ? '*' . $uiErr['message'] : '' ?></p>
                    <textarea class="form-control" name="message" cols="30" rows="8" placeholder="Enter message.."></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-outline-dark">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col col-12 col-md-4 side-contact">
        <h3 class="title">Contact Info</h3>
        <hr>
        <h6>Email:</h6>
        <p>info@goodvibe.org.mm</p>
        <hr>

        <h6>Phone:</h6>
        <p>+959 952128314, +959 795277739</p>
        <hr>

        <h6>Address:</h6>
        <p>No (123), Kabaraye Villa Housing, Yankin ownship, Yangon, Myanmar</p>

    </div>
</div>
<!-- About End -->

<!-- Footer Start -->
<?php require "footer.php" ?>