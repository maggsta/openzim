<h1>Neue Anlage</h1>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('anlage/create') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('anlage/index') ?>">Back to list</a>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderHiddenFields() ?>
      <?php echo $form['stunde_id']->renderRow() ?>
      <?php echo $form['kuerzel']->renderRow() ?>
      <?php echo $form['lnr']->renderRow() ?>
    </tbody>
  </table>
</form>
