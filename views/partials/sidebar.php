<!-- views/partials/sidebar.php -->
<ul class="sidebar text_center">
    <p class="text_les_series">Les Séries</p>
    <?php foreach ($series as $serie) { ?>
        <li class="liste_series">
            <a href="index.php?route=products&serie=<?php echo $serie->id ?>">
                <img src="<?php echo $serie->logo ?>.png" alt="<?php echo $serie->name ?>" class="image_series" id="<?php echo $serie->id ?>_sidebar" >
            </a>
        </li>
    <?php } ?>
</ul>