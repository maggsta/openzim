<div class="newlink">
<?php echo link_to('Neues Zim erstellen','zim_new') ?>
</div>

<h1><?php echo __('Zim Liste') ?></h1>
<div class="paginatelist">

<?php include_partial('zim/list', array('zims' => $pager->getResults())) ?>
<?php include_partial('global/paginator', array('pager' => $pager,
						'internal_uri' => 'zim/index')) ?>
</div>
