<?php
$related_arts = $db->crud("SELECT * FROM articles ORDER BY created_at desc LIMIT 10 ", null, null, true);
?>
<div class="owl2 owl-carousel mt-5">
    <?php
    foreach ($related_arts as $art) :
    ?>
        <div id="art-img-container"> <img class="art-img img-fluid" width="100%" src="./images/article_images/<?= $art->image ?>">
            <a class="middle" href="art_detail.php?art_id=<?=$art->id?>">
                <div class="text">
                    <p><?= $art->title ?></p>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>