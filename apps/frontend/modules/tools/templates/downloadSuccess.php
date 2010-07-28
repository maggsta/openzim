<?php

function makeDownload($file, $filename, $dir, $type) {
    header("Content-Type: $type");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    readfile($dir.$file);
}

if($_POST['formsend']) {

$type = 'application/octet-stream';

switch($_POST['backuptype']) {
case "datenbank":
        $file = "openZIM.db";
        $dir = '../data/';
        break;
case "anlagen":
        include_once("../lib/zip/pclzip.lib.php");
        $zip_file="openZim_Archive.zip";
        $verzeichnisse=array("uploads/");
        $archive = new PclZip($zip_file);
        $archive->create($verzeichnisse);
        $file = $zip_file;
        $dir = './';
        break;
case "all":
        include_once("../lib/zip/pclzip.lib.php");
        $zip_file="openZim_FullArchive.zip";
        $verzeichnisse=array("uploads/", "../data");
        $archive = new PclZip($zip_file);
        $archive->create($verzeichnisse);
        $file = $zip_file;
        $dir = './';
        break;
}

        if(file_exists ($dir.$file)) {
		$filename = $file."_".date('h-i_j-m-y');
                makeDownload($file, $filename, $dir, $type);
                return;
        }
}
?>
