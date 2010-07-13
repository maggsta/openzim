<table>
  <tbody>
    <?php foreach ($zims as $i => $zim): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
      <td><?php echo link_to($zim->getName(), 'zim_show',$zim) ?></td>
      <td><?php echo link_to('Edit', 'zim_edit',$zim) ?></td>
      <td><?php echo link_to('Export', 'zim_export',$zim) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

