<?php require "header.php" ?>

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
                <th class="d-none d-md-block">Updated At</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php
                if (empty($_POST['search'])) {
                    $cats = $db->crud("SELECT * FROM categories", null, false, true);
                } else {

                    $searchKey = $_POST['search'];
                    $cats = $db->crud("SELECT * FROM categories WHERE name LIKE '%$searchKey%'", null, false, true);
                    // dd($admins);
                }
                if ($cats) :
                    $no = 1;
                    foreach ($cats as $cat) : ?>

                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $cat->name ?></td>
                            <td><?= $cat->description ?></td>
                            <td class="d-none d-md-block"><?= $cat->updated_at ?></td>
                            <td class="">
                                <a href="edit-category.php?id=<?= $cat->id ?>" class="btn btn-sm btn-outline-dark"><span class="d-none d-md-inline">Edit</span> <i class="fa-solid fa-pen-to-square ps-0 ps-md-2"></i></a>
                                <a href="delete-category.php?id=<?= $cat->id ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete?')"><span class="d-none d-md-inline">Delete</span><i class="fa-solid fa-trash ps-0 ps-md-2"></i></a>
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