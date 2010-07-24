<table id="linktable">
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<?php echo link_to(__('Back to List'),'zim') ?>
	  &nbsp;<?php echo link_to('Export','zim_export',$zim) ?>
          <?php if (!$zim->isNew()): ?>
            &nbsp;<?php echo link_to(__('Delete'), 'zim_delete',$zim, 
			array('method' => 'delete', 'confirm' => __('Are you sure?'))) ?>
          <?php endif; ?>
          <input type="submit" value="<?php echo __('Save') ?>" />
          <img class="form_loader" src="/images/loader.gif" style="vertical-align: middle; display: none" />
        </td>
      </tr>
    </tfoot>
</table>

