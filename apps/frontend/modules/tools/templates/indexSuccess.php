<h1><?php echo __('Backup Erstellen') ?></h1>
<form method="post" action="download">
	<select name="backuptype">
		<option value="datenbank"><?php echo __('Datenbank') ?></option>
		<option value="anlagen"><?php echo __('Anlagen') ?></option>
		<option value="all"><?php echo __('Datenbank, Anlagen, Index') ?></option>
	</select>
	<input type="hidden" name="formsend" value="submitted"/>
	<input type="submit" value="<?php echo __('backup now') ?>"/>
</form>
