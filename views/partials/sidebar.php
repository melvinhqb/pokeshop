<!-- views/partials/sidebar.php -->
<ul class="sidebar">
    <?php foreach ($series as $serie) { ?>
        <li class="liste_series">
            <a href="index.php?route=products&serie=<?php echo $serie->id ?>">
                <img src="<?php echo $serie->logo ?>.png" alt="<?php echo $serie->name ?>" class="image_series">
            </a>
        </li>
    <?php } ?>
</ul>