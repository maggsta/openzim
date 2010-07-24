<table>
 <thead>
    <tr>
      <th>PT</th>
      <th><?php echo __('Name') ?></th>
      <th><?php echo __('Aktionen') ?></th>
      <th> </th>
      <th> </th>        
    </tr>
  </thead>
 <tbody>
    <?php foreach ($zims as $i => $zim): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
      <td><?php echo $zim->getPtkuerzel(); ?> <?php echo $zim->getPtjahr(); ?></td>
      <td><?php echo link_to($zim->getName(), 'zim_show',$zim) ?></td>
      <td><?php echo link_to(__('Edit'), 'zim_edit',$zim) ?></td>
      <td><?php echo link_to(__('Export'), 'zim_export',$zim) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

