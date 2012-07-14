<table class="linktable">
      <tr>
        <td colspan="2">
          &nbsp;<?php echo link_to(__('Back to List'),$name) ?>
          <?php if (!$object->isNew()): ?>&nbsp;
          <?php	echo link_to(__('Preview'),$name.'_show',$object) ?>&nbsp;
          <?php echo link_to('Export',$name.'_export',$object) ?>&nbsp;
          <?php echo link_to(__('Delete'), $name.'_delete',$object, 
			array('method' => 'delete', 'confirm' => __('Are you sure?'))) ?>
          <?php endif; ?>
          <input type="submit" value="<?php echo __('Save') ?>" />
          <img class="form_loader" src="/images/loader.gif" alt="loader" style="vertical-align: middle; display: none" />
        </td>
      </tr>
</table>

