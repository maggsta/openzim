
<script type="text/javascript" src="/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	readonly : true
});
</script>

<table>
  <tbody>
    <tr>
      <th>Name:</th>
      <td><?php echo $anlage->getName() ?></td>
    </tr>
    <tr>
      <th>Zeit:</th>
      <td><?php echo $anlage->getZeit() ?></td>
    </tr>
    <tr>
      <th>Ziel:</th>
      <td><?php echo $anlage->getZiel() ?></td>
    </tr>
    <tr>
      <th>Methode:</th>
      <td><?php echo $anlage->getMethode() ?></td>
    </tr>
    <tr>
      <th>Material:</th>
      <td><?php echo $anlage->getMaterial() ?></td>
    </tr>
    <tr>
      <th>Tip:</th>
      <td><?php echo $anlage->getTip() ?></td>
    </tr>
    <tr>
      <th>Kurzinhalt:</th>
      <td><?php echo $anlage->getKurzinhalt() ?></td>
    </tr>
    <tr>
      <th>Inhalt:</th>
      <td><textarea style="width:100%; height:300px"><?php echo $anlage->getInhalt() ?></textarea></td>
    </tr>
    <tr>
      <th>Rolle tm:</th>
      <td><?php echo $anlage->getRolleTm() ?></td>
    </tr>
    <tr>
      <th>Zim:</th>
      <td><?php echo $anlage->getStunde()->getZim()->getName() ?></td>
    </tr>
    <tr>
      <th>Stunde:</th>
      <td><?php echo $anlage->getStunde()->getLnr().'. '.$anlage->getStunde()->getName() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('anlage/edit?id='.$anlage->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('anlage/export?id='.$anlage->getId()) ?>">Export</a>
&nbsp;
<a href="<?php echo url_for('anlage/index') ?>">List</a>
