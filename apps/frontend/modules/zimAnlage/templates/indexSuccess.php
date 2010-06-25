<h1>Zim anlages List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Zeit</th>
      <th>Ziel</th>
      <th>Methode</th>
      <th>Material</th>
      <th>Tip</th>
      <th>Kurzinhalt</th>
      <th>Inhalt</th>
      <th>Rolle tm</th>
      <th>Bild</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($zim_anlages as $zim_anlage): ?>
    <tr>
      <td><a href="<?php echo url_for('zimAnlage/show?id='.$zim_anlage->getId()) ?>"><?php echo $zim_anlage->getId() ?></a></td>
      <td><?php echo $zim_anlage->getName() ?></td>
      <td><?php echo $zim_anlage->getZeit() ?></td>
      <td><?php echo $zim_anlage->getZiel() ?></td>
      <td><?php echo $zim_anlage->getMethode() ?></td>
      <td><?php echo $zim_anlage->getMaterial() ?></td>
      <td><?php echo $zim_anlage->getTip() ?></td>
      <td><?php echo $zim_anlage->getKurzinhalt() ?></td>
      <td><?php echo $zim_anlage->getInhalt() ?></td>
      <td><?php echo $zim_anlage->getRolleTm() ?></td>
      <td><?php echo $zim_anlage->getBildId() ?></td>
      <td><?php echo $zim_anlage->getCreatedAt() ?></td>
      <td><?php echo $zim_anlage->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('zimAnlage/new') ?>">New</a>
