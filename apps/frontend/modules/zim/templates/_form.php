<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('zim/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> <?php if (!$form->getObject()->isNew()) echo 'id="ajax_form"' ?> >

<?php include_partial('global/editlinks', array('object' => $form->getObject(),
						'name' => 'zim')) ?>

<div id="form_data">

<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<?php echo $form->renderHiddenFields(false) ?>

<div id="zim_details" class="msg_list">
<p class="msg_head"><?php echo __('ZIM DETAILS') ?></p>
<div class="msg_content">

  <table>
    <tbody>
      <?php echo $form['name']->renderRow() ?>
      <?php echo $form['ptkuerzel']->renderRow() ?>
      <?php echo $form['ptjahr']->renderRow() ?>
      <?php echo $form['user_id']->renderRow() ?>
      <?php echo $form['ziele']->renderRow(array('class' => 'tinymce')) ?>	
      <?php echo $form['zielGruppe']->renderRow() ?> 
      <?php echo $form['roterFaden']->renderRow(array('class' => 'tinymce')) ?> 
     </tbody>
    </table>	

</div></div>

<?php foreach ($form['Stunden'] as $nr => $stunde): ?>
	<?php include_partial('zim/stundeform', array('nr' => $nr, 'form' => $form)) ?>
<?php endforeach; ?>

<table>
    <tbody>
      <?php include_partial('zim/deletestunde', array('form' => $form)) ?>
      <?php foreach ($form['neueStunden'] as $stunde): ?>
        <tr>
          <th colspan="5">Stunde hinzufügen</th>
 	  <td> <?php echo $stunde['name']->render(array('class' => 'clearonsubmit')) ?></td>
 	  <td> <?php echo $stunde['name']->renderError() ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
</table>

</div>

<?php include_partial('global/editlinks', array('object' => $form->getObject(),'name' => 'zim')) ?>

</form>
