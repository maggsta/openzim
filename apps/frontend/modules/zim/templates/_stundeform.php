<?php $stunde = $form['Stunden'][$nr]; ?>

<div id="<?php echo "stunde_" . $stunde['lnr']->getValue() ?>" class="msg_list">
<p class="msg_head"><?php echo $stunde['lnr']->getValue().". Stunde: " ?>
	<span id="<?php echo "stunde_" . $stunde['lnr']->getValue(). "_name" ?>"><?php echo $stunde['name']->getValue() ?></span></p>
<div class="msg_content">
<?php echo $stunde->renderHiddenFields() ?>
<?php echo $stunde['lnr']->render(array('type'=>'hidden')) ?>
<table> 
          <tr>
            <th>Name</th>
	    <td colspan="6"><?php echo $stunde['name'] ?></td>
	    <td><?php echo $stunde['name']->renderError() ?></td>
	 </tr> 
         <?php if ($stunde['Anlagen']->count() > 0 ): ?>
          <tr> <th colspan="8"><strong>Anlagen</strong></th></tr>
         <?php endif; ?>
         <?php foreach ($stunde['Anlagen'] as $anlage): ?>
          <tr>
		<th>  <?php echo $anlage['kuerzel']->renderLabelName() ?></th>
		<td>  <?php echo $anlage['kuerzel'] ?></td>
		<td>  <?php echo $anlage['kuerzel']->renderError() ?></td>
		<th>  <?php echo $anlage['lnr']->renderLabelName() ?></th>
		<td>  <?php echo $anlage['lnr'] ?></td>
		<td>  <?php echo $anlage['lnr']->renderError() ?></td>
          	<td><?php echo link_to('Aus ZIM entfernen',
			'anlage/removeStunde?id='.$anlage['id']->getValue(),
			array('class' => 'ajaxLink') ) ?></td> 
            <td><img class="link_loader" src="/images/loader.gif" alt="loader" style="vertical-align: middle; display: none" /></td>
	 </tr> 
         <?php endforeach; ?>
         <?php if (AnlageTable::getAllFreeCount() > 0 ): ?>
	    <?php echo $stunde['neueAnlage']->renderRow() ?>
         <?php endif; ?>
</table>

</div></div>