<table>
  <tbody>
    <tr>
      <th>Name:</th>
      <td><?php echo $zim->getName() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('zim/edit?id='.$zim->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('zim/index') ?>">List</a>
