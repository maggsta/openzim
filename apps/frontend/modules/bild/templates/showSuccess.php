<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $bild->getId() ?></td>
    </tr>
    <tr>
      <th>Path:</th>
      <td><?php echo $bild->getPath() ?></td>
    </tr>
    <tr>
      <th>Caption:</th>
      <td><?php echo $bild->getCaption() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $bild->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $bild->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('bild/edit?id='.$bild->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('bild/index') ?>">List</a>
