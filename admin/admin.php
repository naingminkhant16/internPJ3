<?php require "header.php" ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Admins Dashboard</h1>
</div>
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Admins Table</h4>
    <table class="table">
      <thead>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
      </thead>
      <tbody>
        <?php
        if (empty($_POST['search'])) {
          $admins = $db->crud("SELECT * FROM admins", null, false, true);
        } else {
          $searchKey = $_POST['search'];
          $admins = $db->crud("SELECT * FROM admins WHERE name LIKE '%$searchKey%'", null, false, true);
        }
        if ($admins) :
          $no = 1;
          foreach ($admins as $admin) : ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $admin->name ?></td>
              <td><?= $admin->email ?></td>
              <td>
                <?php if ($_SESSION['admin']['email'] == $admin->email) : ?>
                  <a href="edit-profile.php?id=<?= $admin->id ?>" class="btn btn-sm btn-outline-dark"><span class="d-none d-md-inline">Edit</span><i class="fa-solid fa-pen-to-square ps-0 ps-md-2"></i></a>
                <?php else : ?>
                  #
                <?php endif; ?>
              </td>
            </tr>
        <?php $no++;
          endforeach;
        endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php require "footer.php" ?>