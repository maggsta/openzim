<h1>Zims List</h1>

<table>
  <thead>
    <tr>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($zims as $zim): ?>
    <tr>
      <td><a href="<?php echo url_for('zim/show?id='.$zim->getId()) ?>"><?php echo $zim->getName() ?></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('zim/new') ?>">New</a>
