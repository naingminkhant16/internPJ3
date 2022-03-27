<?php require "header.php" ?>
<?php
$db = new DB();
$cats = $db->crud("SELECT * FROM categories", null, false, true);
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Category Dashboard</h1>
</div>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Category Table</h4>
        <table class="table">
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($cats as $cat) : ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $cat->name ?></td>
                        <td><?= $cat->description ?></td>
                        <td><?= $cat->created_at ?></td>
                        <td><?= $cat->updated_at ?></td>
                        <td>
                            <a href="edit-category.php?id=<?= $cat->id ?>" class="btn btn-outline-dark">Edit<i class="fa-solid fa-pen-to-square ps-2"></i></a>
                        </td>
                    </tr>
                <?php $no++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require "footer.php" ?>