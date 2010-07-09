<table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<?php echo link_to('Back to list','zim') ?>
	  &nbsp;<?php echo link_to('Export','zim_export',$zim) ?>
          <?php if (!$zim->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'zim_delete',$zim, 
			array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
</table>

