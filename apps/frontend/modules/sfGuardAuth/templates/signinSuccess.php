<?php use_helper('I18N') ?>

<div class="signinform">
<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
  <table>
  	<?php $form->getWidgetSchema()->setLabels(array(
		'username'  => __('Username'),
		'password' => __('Password'),
  		'remember' => __('Remember me'))); ?>
    <?php echo $form ?>
  </table>
  <input type="submit" value="" />
</form>
</div>
