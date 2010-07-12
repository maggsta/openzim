<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('anlage/update?id='.$form->getObject()->getId()) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="anlage_form">

<?php include_partial('editlinks', array('form' => $form)) ?>

<?php include_partial('formdata', array('form' => $form)) ?>

<?php include_partial('editlinks', array('form' => $form)) ?>

</form>
