<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('zim/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>

<table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('zim/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'zim/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
</table>

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
	    <td colspan="4"><?php echo $stunde['name'] ?></td>
	    <td><?php echo $stunde['name']->renderError() ?></td>
	 </tr> 
         <?php if ($stunde['Anlagen']->count() > 0 ): ?>
          <tr> <td colspan="6">Anlagen</td></tr>
         <?php endif; ?>
         <?php foreach ($stunde['Anlagen'] as $anlage): ?>
          <tr>
		<td>  <?php echo $anlage['kuerzel']->renderLabelName() ?></td>
		<td>  <?php echo $anlage['kuerzel'] ?></td>
		<td>  <?php echo $anlage['kuerzel']->renderError() ?></td>
		<td>  <?php echo $anlage['lnr']->renderLabelName() ?></td>
		<td>  <?php echo $anlage['lnr'] ?></td>
		<td>  <?php echo $anlage['lnr']->renderError() ?></td>
	 </tr> 
         <?php endforeach; ?>
</table>

</div></div>

<?php endforeach; ?>

<table>
      <?php if ($form['Stunden']->count() > 0 ): ?>
        <tr>
          <td colspan="6"><?php echo link_to('Letzte Stunde löschen',
		'zim/deleteStunde?id='.$form->getObject()->getId(),
			array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
        </tr>
      <?php endif; ?>
      <?php foreach ($form['neueStunden'] as $stunde): ?>
         <td>Neue Stunde</td>
	 <td> <?php echo $stunde['name'] ?></td>
	 <td> <?php echo $stunde['name']->renderError() ?></td>
      <?php endforeach; ?>
    </tbody>
</table>

<table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('zim/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'zim/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
</table>

</form>
