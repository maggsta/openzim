<table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<?php echo link_to('Zurück zur Liste','anlage') ?>
          &nbsp;<?php echo link_to('Vorschau','anlage_show',$form->getObject()) ?>
          &nbsp;<?php echo link_to('Export','anlage_export',$form->getObject()) ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Löschen', 'anlage_delete',$form->getObject(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
          <img class="anlage_loader" src="/images/loader.gif" style="vertical-align: middle; display: none" />
        </td>
      </tr>
    </tfoot>
</table>

