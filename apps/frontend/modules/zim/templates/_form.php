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
    <tbody>
      <?php echo $form->renderHiddenFields() ?>
      <tr>
	<td>  <?php echo $form['name']->renderLabelName() ?></td>
	<td colspan="4">  <?php echo $form['name'] ?></td>
	<td>  <?php echo $form['name']->renderError() ?></td>
      </tr>
      <tr>
	<td>  <?php echo $form['ziele']->renderLabelName() ?></td>
	<td colspan="4">  <?php echo $form['ziele'] ?></td>
	<td>  <?php echo $form['ziele']->renderError() ?></td>
      </tr>
      <tr>
	<td>  <?php echo $form['zielGruppe']->renderLabelName() ?></td>
	<td colspan="4">  <?php echo $form['zielGruppe'] ?></td>
	<td>  <?php echo $form['zielGruppe']->renderError() ?></td>
      </tr>
      <tr>
	<td>  <?php echo $form['roterFaden']->renderLabelName() ?></td>
	<td colspan="4">  <?php echo $form['roterFaden'] ?></td>
	<td>  <?php echo $form['roterFaden']->renderError() ?></td>
      </tr>
      <?php foreach ($form['Stunden'] as $stunde): ?>
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
      <?php endforeach; ?>
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
</form>
