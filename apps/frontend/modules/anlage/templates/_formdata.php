<div id="form_data">
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<?php echo $form->renderHiddenFields() ?>
<div class="msg_list">
<p class="msg_head"><?php echo __('ANLAGE INFO') ?></p>
<div class="msg_content">
<table>
    <tbody>
      <?php echo $form['zeit']->renderRow() ?>
      <?php echo $form['ziel']->renderRow() ?>
      <?php echo $form['methode']->renderRow() ?>
      <?php echo $form['rolle_tm']->renderRow() ?>
      <?php echo $form['material']->renderRow() ?>
      <?php echo $form['kofferinfo']->renderRow() ?>
    </tbody>
  </table>
</div></div>

<div class="msg_list">
<p class="msg_head"><?php echo __('ANLAGE INAHLT') ?></p>
<div class="msg_content">
<table>
    <tbody>
      <?php echo $form['tip']->renderRow() ?>
      <?php echo $form['kurzinhalt']->renderRow() ?>
      <?php echo $form['inhalt']->renderRow() ?>
    </tbody>
  </table>  
</div></div>

<div class="msg_list">
<p class="msg_head"><?php echo __('ANLAGE BILDER') ?></p>
<div class="msg_content">
<table>
    <tbody>
      <?php foreach ($form['Bilder'] as $bild): ?>
          <?php echo $bild['path']->renderRow(array('width' => 100)) ?>
          <?php echo $bild['caption']->renderRow() ?>
      <?php endforeach; ?>
      <?php foreach ($form['neueBilder'] as $bild): ?>
          <?php echo $bild['path']->renderRow() ?>
          <?php echo $bild['caption']->renderRow() ?>
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

