<div class="newlink">
<?php
 if ( $sf_user->hasZim() || $sf_user->hasCredential('admin') )
        echo link_to('Neue Anlage erstellen','anlage/new') ?>
</div>

<?php include_partial('anlage/search', array('form' => $form)) ?>

<h1><?php echo __('Anlagen') ?></h1>
<div class="paginatelist" id="anlagen">

<?php include_partial('anlage/list', array('anlagen' => $pager->getResults())) ?>
<?php include_partial('global/paginator', array('pager' => $pager,
						'internal_uri' => 'anlage_search')) ?>

</div>
