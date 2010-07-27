
<script type="text/javascript">
	$(document).ready(function()
	{
		tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		readonly : true,
		width : "100%"
		});
	});
</script>

<?php include_partial('showlinks', array('anlage' => $anlage)) ?>

<div class="msg_list">
<p class="msg_head"><?php echo __('ANLAGE INFO') ?></p>
<div class="msg_content">

<table>
  <tbody>
    <tr>
      <th>Nr.:</th>
      <td><?php echo $anlage->getName() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $anlage->getLongname() ?></td>
    </tr>
    <tr>
      <th>Zeit:</th>
      <td><?php echo $anlage->getZeit() ?></td>
    </tr>
    <tr>
      <th>Ziel:</th>
      <td><textarea cols="40" rows="4"><?php echo $anlage->getZiel() ?></textarea></td>
    </tr>
    <tr>
      <th>Methode:</th>
      <td><textarea cols="40" rows="4"><?php echo $anlage->getMethode() ?></textarea></td>
    </tr>
    <tr>
      <th>Rolle tm:</th>
      <td><textarea cols="40" rows="4"><?php echo $anlage->getRolleTm() ?></textarea></td>
    </tr>
    <tr>
      <th>Material:</th>
      <td><textarea cols="40" rows="4"><?php echo $anlage->getMaterial() ?></textarea></td>
    </tr>
    <tr>
      <th>Kofferinfo:</th>
      <td><textarea cols="40" rows="4"><?php echo $anlage->getKofferinfo() ?></textarea></td>
    </tr>

</tbody>
</table>

</div></div>

<div class="msg_list">
<p class="msg_head"><?php echo __('ANLAGE INHALT') ?></p>
<div class="msg_content">

<table>
  <tbody>
    <tr>
      <th>Tip:</th>
      <td><textarea cols="40" rows="4"><?php echo $anlage->getTip() ?></textarea></td>
    </tr>
    <tr>
      <th>Kurzinhalt:</th>
      <td><textarea cols="40" rows="4"><?php echo $anlage->getKurzinhalt() ?></textarea></td>
    </tr>
    <tr>
      <th>Inhalt:</th>
      <td><textarea style="height:300px" cols="40" rows="4"><?php echo $anlage->getInhalt() ?></textarea></td>
    </tr>
  </tbody>
</table>

</div></div>

<?php if ($anlage->getBilder()->count() > 0) : ?>
<div class="msg_list">
<p class="msg_head"><?php echo __('ANLAGE BILDER') ?></p>
<div class="msg_content">

<table>
  <tbody>
    <?php foreach ($anlage->getBilder() as $i => $bild): ?>
    <tr>
      <th><?php echo $i+1 ?>. Bild:</th>
      <td><img style="height:100px" src="<?php echo '/'.basename(sfConfig::get('sf_upload_dir')).'/bilder/'.$bild->getPath() ?>" />
      </td>
    </tr>
    <tr>
      <th>Beschriftung:</th>
      <td><textarea cols="40" rows="4"><?php echo $bild->getCaption() ?></textarea></td>
    </tr>
    <?php endforeach; ?>
</tbody>
</table>

</div></div>
<?php endif; ?>

<?php if ($anlage->getAnhaenge()->count() > 0) : ?>
<div class="msg_list">
<p class="msg_head"><?php echo __('ANLAGE ANHÄNGE') ?></p>
<div class="msg_content">

<table>
  <tbody>
    <?php foreach ($anlage->getAnhaenge() as $i => $anhang): ?>
    <tr>
      <th><?php echo $i+1 ?>. Anhang:</th>
      <td>
          <?php echo link_to($anhang->getName(),'anhang_download',$anhang) ?>
      </td>
    </tr>
    <?php endforeach; ?>
</tbody>
</table>

</div></div>
<?php endif; ?>

<div class="msg_list">
<p class="msg_head"><?php echo __('ANLAGE ZIM INFO') ?></p>
<div class="msg_content">

<table>
  <tbody>
    <tr>
      <th>Zim:</th>
      <td><?php echo $anlage->getStunde()->getZim() ?></td>
    </tr>
    <tr>
      <th>Stunde:</th>
      <td><?php echo $anlage->getStunde()->getLnr().'. '.$anlage->getStunde()->getName() ?></td>
    </tr>
  </tbody>
</table>

</div></div>

<hr />

<?php include_partial('showlinks', array('anlage' => $anlage)) ?>

