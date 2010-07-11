<table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<?php echo link_to('Back to list','anlage') ?>
          &nbsp;<?php echo link_to('Export','anlage_export',$form->getObject()) ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'anlage_delete',$form->getObject(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
</table>

