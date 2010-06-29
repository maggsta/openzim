<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $bild->getId() ?></td>
    </tr>
    <tr>
      <th>Path:</th>
      <td><img src="/uploads/bilder/<?php echo $bild->getPath() ?>" alt="<?php
echo $job->getCaption() ?> logo" /></td>
    </tr>
    <tr>
      <th>Caption:</th>
      <td><?php echo $bild->getCaption() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('bild/edit?id='.$bild->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('bild/index') ?>">List</a>
