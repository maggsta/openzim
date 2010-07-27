<script type="text/javascript">
	$(document).ready(function()
	{
		tinyMCE.init({
		mode : "exact",
		theme : "advanced",
		elements : "ziele_content,rf_content",
		readonly : true
		});
	});
</script>

<h1><?php echo $zim ?></h1>

<?php include_partial('showlinks', array('zim' => $zim)) ?>
    
<div class="msg_list">
<p class="msg_head"><?php echo __('ZIM DETAILS') ?></p>
<div class="msg_content">	

<table>
    <tr>
       <th><b>PT / Jahr</b></th>
    </tr>
    <tr>
       <td><?php echo $zim->getPtkuerzel(); ?> <?php echo $zim->getPtjahr(); ?></td>
    </tr>

    <tr>
       <th><b>Bearbeiter</b></th>
    </tr>
    <tr>
       <td><?php echo $zim->getSfGuardUser()->getUserName()?$zim->getSfGuardUser():'gesperrt'; ?></td>
    </tr>

    <tr>
       <th><b>Ziele</b></th>
    </tr>
    <tr>
       <td><div id="ziele_content"><?php echo $zim->getZiele(ESC_RAW) ?></div></td>
    </tr>
    <tr>
       <th><b>Zielgruppe</b></th>
    </tr>
    <tr>
       <td><?php echo $zim->getZielGruppe() ?></td>
    </tr>
    <tr>
       <th><b>Roter Faden</b></th>
    </tr>
    <tr>
       <td><div id="rf_content"><?php echo $zim->getRoterFaden(ESC_RAW) ?></div></td>
    </tr>
</table>

</div></div>

<?php foreach ($zim->getStunden() as $stunde): ?>

<div class="msg_list">
<p class="msg_head"><?php echo $stunde ?></p>
<div class="msg_content">

<table class="zim_table">
  <col class="nr" />
  <col class="zeit" />
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
      <td>Anlagen/ Hilfsmittel</td>
    </tr>
  </thead>
  <tbody>
     <?php foreach ($stunde->getAnlagen() as $anlage): ?>
    <tr>
       <td><?php echo link_to($anlage->getName(),'anlage_show',$anlage) ?></td>
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

<?php include_partial('showlinks', array('zim' => $zim)) ?>
