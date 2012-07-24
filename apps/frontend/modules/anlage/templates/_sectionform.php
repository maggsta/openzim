<?php $section = $form['Sections'][$nr]; ?>
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