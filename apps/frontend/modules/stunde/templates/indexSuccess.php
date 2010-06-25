<h1>Stundes List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Description</th>
      <th>Zim</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($stundes as $stunde): ?>
    <tr>
      <td><a href="<?php echo url_for('stunde/show?id='.$stunde->getId()) ?>"><?php echo $stunde->getId() ?></a></td>
      <td><?php echo $stunde->getDescription() ?></td>
      <td><?php echo $stunde->getZimId() ?></td>
      <td><?php echo $stunde->getCreatedAt() ?></td>
      <td><?php echo $stunde->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('stunde/new') ?>">New</a>
