<h1>Zims List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($zims as $zim): ?>
    <tr>
      <td><a href="<?php echo url_for('zim/show?id='.$zim->getId()) ?>"><?php echo $zim->getId() ?></a></td>
      <td><?php echo $zim->getName() ?></td>
      <td><?php echo $zim->getCreatedAt() ?></td>
      <td><?php echo $zim->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('zim/new') ?>">New</a>
