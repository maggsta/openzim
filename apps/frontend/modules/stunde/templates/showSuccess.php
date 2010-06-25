<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $stunde->getId() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $stunde->getDescription() ?></td>
    </tr>
    <tr>
      <th>Zim:</th>
      <td><?php echo $stunde->getZimId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $stunde->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $stunde->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('stunde/edit?id='.$stunde->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('stunde/index') ?>">List</a>
