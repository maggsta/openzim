<div class="newlink">
<?php echo link_to('', 'zim_new') ?>
</div>

<h1>Zims List</h1>

<table>
  <tbody>
    <?php foreach ($zims as $zim): ?>
    <tr>
      <td><?php echo link_to($zim->getName(), 'zim_show',$zim) ?></td>
      <td><?php echo link_to('Edit', 'zim_edit',$zim) ?></td>
      <td><?php echo link_to('Export', 'zim_export',$zim) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

