<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('anlage/update?id='.$form->getObject()->getId()) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="ajax_form">

<?php include_partial('global/editlinks', array('object' => $form->getObject(),
						'name' => 'anlage')) ?>

<div id="form_data">
<input type="hidden" name="sf_method" value="put" />
<?php echo $form->renderHiddenFields() ?>
<div class="msg_list">
<p class="msg_head"><?php echo __('ANLAGE INFO') ?></p>
<div class="msg_content">
<table>
    <tbody>
      <?php echo $form['longname']->renderRow() ?>
      <?php echo $form['zeit']->renderRow() ?>
      <?php echo $form['ziel']->renderRow() ?>
      <?php echo $form['methode']->renderRow() ?>
      <?php echo $form['rolle_tm']->renderRow() ?>
      <?php echo $form['material']->renderRow() ?>
      <?php echo $form['kofferinfo']->renderRow(array('class'=>'nonumbering')) ?>
    </tbody>
  </table>
</div></div>

<div class="msg_list">
<p class="msg_head"><?php echo __('ANLAGE INHALT') ?></p>
<div class="msg_content">
<table>
    <tbody>
      <?php echo $form['kurzinhalt']->renderRow() ?>
      <?php foreach ($form['Sections'] as $nr => $section): ?>
      	<tr><td></td><td><?php echo $nr+1 . ". Abschnitt" ?></td></tr>
     	<?php echo $section['inhalt']->renderRow() ?>
      	<?php echo $section['tip']->renderRow() ?>
      	<?php echo $section['Bild']['path']->renderRow(array('width' => 100)) ?>
        <?php echo $section['Bild']['caption']->renderRow() ?>
      <?php endforeach; ?>
      <tr><td></td><td>Neuer Abschnitt</td></tr>
      <?php foreach ($form['neueSections'] as $section): ?>
          <?php echo $section['inhalt']->renderRow() ?>
          <?php echo $section['tip']->renderRow() ?>         
      <?php endforeach; ?>
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
