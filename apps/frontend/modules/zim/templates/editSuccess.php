<h1><?php echo __('Edit Zim').' - '. htmlentities($form->getObject()->getName(), ENT_NOQUOTES, 'UTF-8') ?></h1>

<?php include_partial('form', array('form' => $form)) ?>
