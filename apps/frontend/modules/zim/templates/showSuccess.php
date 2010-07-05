<h1><?php echo $zim->getName() ?></h1>
<table>
  <thead>
    <tr>
      <th>Nr.</th>
      <th>Zeit</th>
      <th>Ziel</th>
      <th>Inhalt</th>
      <th>Methode</th>
      <th>Rolle TM</th>
      <th>Anlagen/Hilfsmittel</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($zim->getStunden() as $stunde): ?>
    <tr>
       <td colspan="7"><?php echo $stunde ?></td>
    </tr>
    <tr>
     <?php foreach ($stunde->getAnlagen() as $anlage): ?>
    <tr>
       <td><?php echo $anlage->getName() ?></td>
       <td><?php echo $anlage->getZeit() ?></td>
       <td><?php echo $anlage->getZiel(ESC_RAW) ?></td>
       <td><?php echo $anlage->getKurzinhalt(ESC_RAW) ?></td>
       <td><?php echo $anlage->getMethode(ESC_RAW) ?></td>
       <td><?php echo $anlage->getRolleTm(ESC_RAW) ?></td>
       <td><?php echo $anlage->getMaterial(ESC_RAW) ?></td>
    </tr>	
    <?php endforeach; ?>
    <?php endforeach; ?>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('zim/edit?id='.$zim->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('zim/export?id='.$zim->getId()) ?>">Export</a>
&nbsp;
<a href="<?php echo url_for('zim/index') ?>">List</a>
