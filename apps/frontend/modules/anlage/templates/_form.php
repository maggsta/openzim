<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('anlage/update?id='.$form->getObject()->getId()) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="ajax_form">

<?php include_partial('global/editlinks', array('object' => $form->getObject(),
						'name' => 'anlage')) ?>

<div id="form_data">
<input type="hidden" name="sf_method" value="put" />
<?php echo $form->renderHiddenFields(false) ?>
<div class="msg_list">
<p class="msg_head"><?php echo __('ANLAGE INFO') ?></p>
<div class="msg_content">
<table>
    <tbody>
      <?php echo $form['longname']->renderRow() ?>
      <?php echo $form['zeit']->renderRow() ?>
      <?php echo $form['ziel']->renderRow(array('class' => 'tinymce')) ?>
      <?php echo $form['methode']->renderRow(array('class' => 'tinymce')) ?>
      <?php echo $form['rolle_tm']->renderRow(array('class' => 'tinymce')) ?>
      <?php echo $form['material']->renderRow(array('class' => 'tinymce')) ?>
      <?php echo $form['kofferinfo']->renderRow(array('class'=>'nonumbering tinymce')) ?>
    </tbody>
  </table>
</div></div>

<div class="msg_list">
<p class="msg_head"><?php echo __('ANLAGE INHALT') ?></p>
<div class="msg_content">
<table>
    <tbody>
      <?php echo $form['kurzinhalt']->renderRow(array('class' => 'tinymce')) ?>
    </tbody>
</table>
      <?php foreach ($form['Sections'] as $nr => $section): ?>
<div id="section_<?php echo $section['id']->getValue() ?>">
<?php echo $section->renderHiddenFields() ?>
<table >
    <tbody>      
      	<tr>
      		<td><span id="section_<?php echo $section['id']->getValue() ?>_lnr"><?php echo $nr+1 ?></span>. Abschnitt</td>
      		<td><?php echo link_to('Abschnitt löschen',
			'anlage/removeSection?id='.$section['id']->getValue(),
			array('class' => 'ajaxLink',
				'confirm' => __('Are you sure?')) ) ?></td>
			<td><img class="link_loader" src="/images/loader.gif" alt="loader" style="vertical-align: middle; display: none" /></td>
      	</tr>
     	<?php echo $section['inhalt']->renderRow(array('class' => 'tinymce')) ?>
      	<?php echo $section['tip']->renderRow(array('class' => 'tinymce')) ?>
      	<?php echo $section['Bild']['path']->renderRow(array('width' => 100)) ?>
        <?php echo $section['Bild']['caption']->renderRow(array('class' => 'tinymce')) ?>
   </tbody>
</table>
</div>
      <?php endforeach; ?>
<table>
    <tbody>      
      <tr>
      		<td>Neuer Abschnitt</td>
      		<td><?php echo link_to('Abschnitt hinzufügen',
			'anlage/addSection?id='. $form->getObject()->getId(),
			array('class' => 'ajaxLink') ) ?></td>
			<td><img class="link_loader" src="/images/loader.gif" alt="loader" style="vertical-align: middle; display: none" /></td>
      	</tr>
    </tbody>
  </table>
</div></div>

<div class="msg_list">
<p class="msg_head"><?php echo __('ANLAGE ANHÄNGE') ?></p>
<div class="msg_content">
  <table>
    <tbody>
      <?php foreach ($form['Anhaenge'] as $anhang): ?>
          <?php echo $anhang['path']->renderRow(array('width' => 100)) ?>
      <?php endforeach; ?>
      <?php echo $form['neuerAnhang']['path']->renderRow() ?>
    </tbody>
  </table>  
</div></div>

</div>

<?php include_partial('global/editlinks', array('object' => $form->getObject(),
						'name' => 'anlage')) ?>

</form>
