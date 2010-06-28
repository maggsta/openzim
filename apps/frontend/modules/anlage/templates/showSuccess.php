<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $anlage->getId() ?></td>
    </tr>
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
      <td><?php echo $anlage->getInhalt() ?></td>
    </tr>
    <tr>
      <th>Rolle tm:</th>
      <td><?php echo $anlage->getRolleTm() ?></td>
    </tr>
    <tr>
      <th>Zim:</th>
      <td><?php echo $anlage->getZimId() ?></td>
    </tr>
    <tr>
      <th>Lnr:</th>
      <td><?php echo $anlage->getLnr() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $anlage->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $anlage->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('anlage/edit?id='.$anlage->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('anlage/index') ?>">List</a>
