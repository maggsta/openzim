<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $zim_anlage->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $zim_anlage->getName() ?></td>
    </tr>
    <tr>
      <th>Zeit:</th>
      <td><?php echo $zim_anlage->getZeit() ?></td>
    </tr>
    <tr>
      <th>Ziel:</th>
      <td><?php echo $zim_anlage->getZiel() ?></td>
    </tr>
    <tr>
      <th>Methode:</th>
      <td><?php echo $zim_anlage->getMethode() ?></td>
    </tr>
    <tr>
      <th>Material:</th>
      <td><?php echo $zim_anlage->getMaterial() ?></td>
    </tr>
    <tr>
      <th>Tip:</th>
      <td><?php echo $zim_anlage->getTip() ?></td>
    </tr>
    <tr>
      <th>Kurzinhalt:</th>
      <td><?php echo $zim_anlage->getKurzinhalt() ?></td>
    </tr>
    <tr>
      <th>Inhalt:</th>
      <td><?php echo $zim_anlage->getInhalt() ?></td>
    </tr>
    <tr>
      <th>Rolle tm:</th>
      <td><?php echo $zim_anlage->getRolleTm() ?></td>
    </tr>
    <tr>
      <th>Bild:</th>
      <td><?php echo $zim_anlage->getBildId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $zim_anlage->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $zim_anlage->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('zimAnlage/edit?id='.$zim_anlage->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('zimAnlage/index') ?>">List</a>
