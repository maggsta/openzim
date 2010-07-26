<h1>Backup Erstellen</h1>
<form method="post" action="download">
	<select name="backuptype">
		<option value="datenbank">Datenbank</option>
		<option value="anlagen">Anlagen</option>
		<option value="all">Datenbank, Anlagen, Index</option>
	</select>
	<input type="hidden" name="formsend" value="submitted"/>
	<input type="submit" value="backup now"/>
</form>
