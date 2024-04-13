<!-- views/layout.php -->
<?php ob_start(); ?>
<main>
        <div class="content-wrapper">
<?php include(ROOT_PATH . '/partials/sidebar.php'); ?>
<div class="content">
    <div class="series-container">
        <?php foreach ($series as $serie): ?>
            <div class="row-series" id="<?php echo $serie->id; ?>">
                <div class="series" onclick="toggleSets('<?php echo $serie->id; ?>')">
                    <h2>Série <?php echo $serie->name; ?></h2>
                    <svg class="arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7.406 9.375L12 13.967l4.594-4.592 1.416 1.416L12 16.798l-6.016-6.017z"/></svg>
                </div>
                <div class="sets hidden" id="<?php echo $serie->id; ?>-sets">
                    <?php if (!empty($serie->sets)): ?>
                        <?php foreach ($serie->sets as $set): ?>
                            <div class="set">
                                <a href="index.php?route=products&set=<?php echo $set->id; ?>"><img src="<?php echo $set->logo; ?>.png" alt="<?php echo $set->name; ?>"></a>
                                <p><?php echo $set->name; ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Aucun ensemble trouvé pour la série <?php echo $serie->name; ?>.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
                    </div>
                    </main>
<?php $content = ob_get_clean(); ?>

<?php require_once(ROOT_PATH . '/layout.php'); ?>

<script src="ressources/js/accordionSets.js"></script>
