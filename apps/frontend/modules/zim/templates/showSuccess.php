<h1><?php echo $zim->getName() ?></h1>

<table>
<tr><td>
<a href="<?php echo url_for('zim/edit?id='.$zim->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('zim/export?id='.$zim->getId()) ?>">Export</a>
&nbsp;
<a href="<?php echo url_for('zim/index') ?>">Back to List</a>
</td></tr>
</table>
    
<div class="msg_list">
<p class="msg_head"><?php echo __('ZIM DETAILS') ?></p>
<div class="msg_content">	

<table>
  <thead>    
    <tr>
       <th><b>Ziele</b></th>
    </tr>
    <tr>
       <td colspan="7"><?php echo $zim->getZiele(ESC_RAW) ?></td>
    </tr>
    <tr>
       <th><b>Zielgruppe</b></th>
    </tr>
    <tr>
       <td colspan="7"><?php echo $zim->getZielGruppe() ?></td>
    </tr>
    <tr>
       <th colspan="7"><b>Roter Faden</b></th>
    </tr>
    <tr>
       <td colspan="7"><?php echo $zim->getRoterFaden(ESC_RAW) ?></td>
    </tr>
</thead>
</table>

</div></div>

<?php foreach ($zim->getStunden() as $stunde): ?>

<div class="msg_list">
<p class="msg_head"><?php echo $stunde ?></p>
<div class="msg_content">

<table>
  <thead>
    <tr>
       <th><b>Anlagen</b></th>
    </tr>
    <tr>
      <td>Nr.</td>
      <td>Zeit</td>
      <td>Ziel</td>
      <td>Inhalt</td>
      <td>Methode</td>
      <td>Rolle TM</td>
      <td>Anlagen/Hilfsmittel</td>
    </tr>
  </thead>
  <tbody>
    <tr>
       <th colspan="7"><b><?php echo $stunde ?></b></th>
    </tr>
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
  </tbody>
</table>

</div></div>

<?php endforeach; ?>

<table>
<tr><td>
<a href="<?php echo url_for('zim/edit?id='.$zim->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('zim/export?id='.$zim->getId()) ?>">Export</a>
&nbsp;
<a href="<?php echo url_for('zim/index') ?>">Back to List</a>
</td></tr>
</table>
