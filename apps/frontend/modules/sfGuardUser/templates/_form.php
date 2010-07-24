<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('sfGuardUser/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>

<?php echo $form->renderHiddenFields() ?>

<?php include_partial('editlinks') ?>

<table>
    <tbody>
      <?php echo $form['username']->renderRow() ?>
      <?php echo $form['password']->renderRow() ?>
      <?php echo $form['password_again']->renderRow() ?>
      <?php echo $form['is_active']->renderRow() ?>
      <?php echo $form['groups_list']->renderRow() ?>
    </tbody>
</table>

<?php include_partial('editlinks') ?>

</form>
