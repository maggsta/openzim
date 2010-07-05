<?php 
if(count($anlagen) == 0) {
	echo 'no results';
}
else { ?>   

<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Ziel</th>
      <th>Kurzinhalt</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($anlagen as $i => $anlage): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
      <td class="name">
	<?php echo link_to($anlage->getName(), 'anlage/show?id='.$anlage->getId(), $anlage) ?>
      </td>
      <td class="ziel">
        <?php echo $anlage->getZiel(ESC_RAW) ?>
      </td>
      <td class="inhalt">
        <?php echo $anlage->getKurzInhalt(ESC_RAW) ?>
      </td>
      <td class="export">
	<a href="<?php echo url_for('anlage/edit?id='.$anlage->getId())?>">Edit</a>
      </td>
      <td class="export">
	<a href="<?php echo url_for('anlage/export?id='.$anlage->getId()) ?>">Export</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<?php } ?>

