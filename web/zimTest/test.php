<link rel="stylesheet" type="text/css" href="./css/screen.css" media="screen, print" /> 

<?php

require_once('./library/odf.php');

if((isset($_POST['send']))) {

	$odf = new odf("./odftmp/Anlage_template.odt");

	$zeit = $_POST['zeit'];
	$ziel = $_POST['ziel'];
	$tip = $_POST['tip'];
	$inhalt = $_POST['inhalt'];
	$methode = $_POST['methode'];	
	$material = $_POST['material'];
	#$bild = $_POST['bild'];

	$odf->setVars('zeit', $zeit, false);
	$odf->setVars('ziel', $ziel, false);
	$odf->setVars('tip', $tip, false);
	$odf->setVars('Inhalt', $inhalt, false);
	$odf->setVars('methode', $methode, false);
	$odf->setVars('material', $material, false);
	$odf->saveToDisk('./odts/fichier.odt');

}
         
?>

<!--
<script type="text/javascript" src="./tinymce/jscripts/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">
tinyMCE.init({
mode : "textareas",
theme : "simple"
});
</script>
-->
 
<form method="post" action="#" enctype="multipart/form-data">

<h1>Zeit</h1>
<input type="text" name="zeit" size="30" maxlength="150" value="<?php echo "$zeit"; ?>"/> 

<h1>Ziel</h1>
<textarea name="ziel" rows="5"><?php echo "$ziel"; ?></textarea>

<h1>Methoden</h1>
<textarea name="methode" rows="5"><?php echo "$methode"; ?></textarea>

<h1>Material</h1>
<textarea name="material" rows="5"><?php echo "$material"; ?></textarea>

<h1>Tip</h1>
<textarea name="tip" rows="3"><?php echo "$tip"; ?></textarea>

<h1>Inhalt</h1>
<textarea name="inhalt" rows="5"><?php echo "$inhalt"; ?></textarea>

<p>
<input type="submit" name="Submit" value="Write to file" />
</p>
<input type="hidden" name="send" value="process" />

</form>
