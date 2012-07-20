<?php 
if(count($anlagen) == 0) {
	echo __('No attachments found');
}
else { ?>   

<table>
  <thead>
    <tr>
      <th><?php echo __('Nr.') ?></th>
      <th><?php echo __('Name') ?></th>
      <th><?php echo __('Ziel') ?></th>
      <th><?php echo __('Aktionen') ?></th>
      <th> </th>	
    </tr>
  </thead>
  <tbody>
  <?php 
     $curZimId = null;
     foreach ($anlagen as $i => $anlage):
       $curStunde = $anlage->getStunde();
       $newZimId = -1;
       if ( $curStunde ){
          $curZim   = $curStunde->getZim();
          $newZimId = $curZim->getId();
       }
       if ( $newZimId != $curZimId ){
		$curZimId = $newZimId;
   ?>
      <tr class="anlage_zim">
	<th colspan="5"><?php echo $curZimId!=-1?$curZim:__('Keinem ZIM zugeordnet.') ?></th>
      </tr>	
  <?php } ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
      <td class="name">
	<?php echo link_to($anlage->getName(), 'anlage_show',$anlage) ?>
      </td>
      <td class="longname">
        <?php echo $anlage->getLongname() ?>
      </td>
      <td class="ziel">
        <?php echo $anlage->getZiel(ESC_RAW) ?>
      </td>
      <td class="export">
	<?php echo link_to(__('Edit'),'anlage_edit',$anlage) ?>
      </td>
      <td class="export">
	<?php echo link_to(__('Export'),'anlage_export',$anlage) ?>
      </td>
    </tr>
  <?php endforeach; ?>
</tbody>
</table>

<?php } ?>

