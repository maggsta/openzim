<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $zim->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $zim->getName() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $zim->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $zim->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('zim/edit?id='.$zim->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('zim/index') ?>">List</a>
