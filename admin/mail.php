<?php require "header.php" ?>
<?php

?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Users' Mails Dashboard</h1>
</div>
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-1">
    <?php
    if (empty($_POST['search'])) {
        $result = $db->crud("SELECT * FROM mails", null, false, true);
    } else {
        $searchKey = $_POST['search'];
        $result = $db->crud("SELECT * FROM mails WHERE email LIKE '%$searchKey%'", null, false, true);
    }
    if ($result) :
        foreach ($result as $mail) :
    ?>
            <div class="col">
                <div id="card<?= $mail->id ?>" class="card <?php
                                                            if ($mail->is_read) echo "text-light bg-dark";
                                                            else echo "text-dark bg-white";
                                                            ?>   mb-3">
                    <div class="card-body">
                        <h5 class="card-title">From <?= $mail->name ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Email - <?= $mail->email ?></h6>
                        <h6><?= $mail->subject ?></h6>
                        <hr>
                        <p class="card-text"><?= $mail->message ?></p>
                        <a href="delete-mail.php?id=<?= $mail->id ?>" class="card-link btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete?')">Delete<i class="fa-solid fa-trash ps-0 ps-md-2"></i></a>
                        <a href="read.php?id=<?= $mail->id ?>" class="card-link <?php
                                                                                if ($mail->is_read) echo "disabled";
                                                                                ?> btn btn-outline-secondary"><?php
                                                                                                                if ($mail->is_read) echo "Read";
                                                                                                                else echo "Mark as read";
                                                                                                                ?></a>
                    </div>
                </div>
            </div>
    <?php endforeach;
    endif;
    ?>
</div>
<?php require "footer.php" ?>