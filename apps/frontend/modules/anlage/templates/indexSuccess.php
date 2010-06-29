<?php include_partial('anlage/search') ?>

<h1>Anlagen</h1>

<?php include_partial('anlage/list', array('anlagen' => $anlagen)) ?>

<a href="<?php echo url_for('anlage/new') ?>">New</a>
