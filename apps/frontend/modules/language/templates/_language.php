<?php if( $sf_user->isAuthenticated() ) { ?>

<form id="languageForm" action="<?php echo url_for('change_language') ?>">
  <ul>
  <?php echo $form ?>
  </ul>
  <input type="submit" value="ok" />
</form>

<?php } ?>
