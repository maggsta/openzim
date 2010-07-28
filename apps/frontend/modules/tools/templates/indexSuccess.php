<h1><?php echo __('Backup Erstellen') ?></h1>
<form method="post" action="download">
	<select name="backuptype">
		<option value="datenbank"><?php echo __('Datenbank') ?></option>
		<option value="anlagen"><?php echo __('Bilder, Anhänge') ?></option>
	</select>
	<input type="hidden" name="formsend" value="submitted"/>
	<input type="submit" value="<?php echo __('backup now') ?>"/>
</form>
