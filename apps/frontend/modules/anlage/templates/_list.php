<?php 
if(count($anlagen) == 0) {
	echo 'no results';
}
else { ?>   

<table>
  <thead>
    <tr>
      <th>Nr.</th>
      <th>Name</th>
      <th>Ziel</th>
      <th>Aktionen</th>
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
	<th colspan="5"><?php echo $curZimId!=-1?$curZim:'Keinem ZIM zugeordnet.' ?></th>
      </tr>	
  <?php } ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
      <td class="name">
	<?php echo link_to($anlage->getName(), 'anlage/show?id='.$anlage->getId(), $anlage) ?>
      </td>
      <td class="longname">
        <?php echo $anlage->getLongname() ?>
      </td>
      <td class="ziel">
        <?php echo $anlage->getZiel(ESC_RAW) ?>
      </td>
      <td class="export">
	<a href="<?php echo url_for('anlage/edit?id='.$anlage->getId())?>">Edit</a>
      </td>
      <td class="export">
	<a href="<?php echo url_for('anlage/export?id='.$anlage->getId()) ?>">Export</a>
      </td>
    </tr>
  <?php endforeach; ?>
</tbody>
</table>

<?php } ?>

