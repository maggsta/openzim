<?php if ($form['Stunden']->count() > 0 ): ?>
        <tr id="delete_stunde_link">
          <th colspan="5">
		<?php echo link_to('Letzte Stunde löschen',
		'zim_delete_stunde',$form->getObject(),
		array('class' => 'ajaxLink', 'confirm' => __('Are you sure?'))) ?>
	  </th>
	  <th><img class="link_loader" src="/images/loader.gif" alt="loader" style="vertical-align: middle; display: none" /></th>
        </tr>
<?php endif; ?>