<h1>Bilds List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Path</th>
      <th>Caption</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($bilds as $bild): ?>
    <tr>
      <td><a href="<?php echo url_for('bild/show?id='.$bild->getId()) ?>"><?php echo $bild->getId() ?></a></td>
      <td><?php echo $bild->getPath() ?></td>
      <td><?php echo $bild->getCaption() ?></td>
      <td><?php echo $bild->getCreatedAt() ?></td>
      <td><?php echo $bild->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('bild/new') ?>">New</a>
