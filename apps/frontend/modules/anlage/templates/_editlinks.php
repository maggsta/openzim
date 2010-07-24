<table id="linktable">
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<?php echo link_to(__('Back to List'),'anlage') ?>
          &nbsp;<?php echo link_to(__('Preview'),'anlage_show',$form->getObject()) ?>
          &nbsp;<?php echo link_to(__('Export'),'anlage_export',$form->getObject()) ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to(__('Delete'), 'anlage_delete',$form->getObject(), array('method' => 'delete', 'confirm' => __('Are you sure?'))) ?>
          <?php endif; ?>
          <input type="submit" value=<?php echo __('Save') ?> />
          <img class="form_loader" src="/images/loader.gif" style="vertical-align: middle; display: none" />
        </td>
      </tr>
    </tfoot>
</table>

