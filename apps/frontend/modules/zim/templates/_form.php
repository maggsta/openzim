<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('zim/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>

<?php include_partial('editlinks', array('zim' => $form->getObject())) ?>

<div class="msg_list">
<p class="msg_head"><?php echo __('ZIM DETAILS') ?></p>
<div class="msg_content">

  <table>
    <tbody>
      <?php echo $form->renderHiddenFields() ?>
      <?php echo $form['name']->renderRow() ?>
      <?php echo $form['user_id']->renderRow() ?>
      <?php echo $form['ziele']->renderRow() ?>	
      <?php echo $form['zielGruppe']->renderRow() ?> 
      <?php echo $form['roterFaden']->renderRow() ?> 
     </tbody>
    </table>	

</div></div>

<?php foreach ($form['Stunden'] as $stunde): ?>

<div class="msg_list">
<p class="msg_head"><?php echo $stunde['lnr']->getValue().". Stunde: ".$stunde['name']->getValue() ?></p>
<div class="msg_content">

<table> 
          <tr>
            <?php echo $stunde['lnr']->render(array('type'=>'hidden')) ?>
            <td><?php echo $stunde['lnr']->getValue() ?>. Stunde</td>
	    <td colspan="5"><?php echo $stunde['name'] ?></td>
	    <td><?php echo $stunde['name']->renderError() ?></td>
	 </tr> 
         <?php if ($stunde['Anlagen']->count() > 0 ): ?>
          <tr> <td colspan="7">Anlagen</td></tr>
         <?php endif; ?>
         <?php foreach ($stunde['Anlagen'] as $anlage): ?>
          <tr>
		<td>  <?php echo $anlage['kuerzel']->renderLabelName() ?></td>
		<td>  <?php echo $anlage['kuerzel'] ?></td>
		<td>  <?php echo $anlage['kuerzel']->renderError() ?></td>
		<td>  <?php echo $anlage['lnr']->renderLabelName() ?></td>
		<td>  <?php echo $anlage['lnr'] ?></td>
		<td>  <?php echo $anlage['lnr']->renderError() ?></td>
          	<td><?php echo link_to('Aus ZIM entfernen',
			'anlage/removeStunde?id='.$anlage['id']->getValue()) ?> </td>
        </tr>
	 </tr> 
         <?php endforeach; ?>
         <?php if (AnlageTable::getAllFreeCount() > 0 ): ?>
	    <?php echo $stunde['neueAnlage']->renderRow() ?>
         <?php endif; ?>
</table>

</div></div>

<?php endforeach; ?>

<table>
    <tbody>
      <?php if ($form['Stunden']->count() > 0 ): ?>
        <tr>
          <td colspan="6"><?php echo link_to('Letzte Stunde löschen',
		'zim_delete_stunde',$form->getObject(),
		array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
	  </td>
        </tr>
      <?php endif; ?>
      <?php foreach ($form['neueStunden'] as $stunde): ?>
         <td>Stunde hinzufügen</td>
	 <td> <?php echo $stunde['name'] ?></td>
	 <td> <?php echo $stunde['name']->renderError() ?></td>
      <?php endforeach; ?>
    </tbody>
</table>

<?php include_partial('editlinks', array('zim' => $form->getObject())) ?>

</form>
