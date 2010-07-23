<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title><?php include_slot('title', '-= openZIM =-') ?></title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php use_javascript('jquery-1.4.2.min.js') ?>
    <?php use_javascript('tiny_mce/tiny_mce.js') ?>
    <?php use_javascript('jquery.cookies.2.2.0.min.js') ?>
    <?php use_javascript('tinymce.js') ?>
    <?php use_javascript('search.js') ?>
    <?php use_javascript('ajaxformsave.js') ?>
    <?php use_javascript('paginate.js') ?>
    <?php use_javascript('expander.js') ?>
    <?php use_javascript('autosubmit.js') ?>
    <?php use_javascript('zimremoveanlage.js') ?>
    <?php include_javascripts() ?>
    <?php include_stylesheets() ?>
  </head>
  <body>
    <div id="container">
 
      <div id="header">
	<h1>
		<a href="<?php echo url_for('homepage') ?>">
          		<img src="/images/logo.jpg" alt="openZIM" />
        	</a>
	</h1>
	
	<?php include_component('language', 'language') ?>

        <?php if ($sf_user->isAuthenticated()): ?>
  	<div id="menu">
    	<ul>
		<li><?php echo link_to(__('Homepage'), 'homepage') ?></li>
		<li><?php echo link_to(__('Attachments'), 'anlage') ?></li>
		<?php if ($sf_user->hasCredential('admin')): ?>
			<li><?php echo link_to(__('ZIMs'), 'zim') ?></li>
			<li><?php echo link_to(__('User'), 'sf_guard_user') ?></li>
		<?php endif ?>
		<li><?php echo link_to(__('Logout'), 'sf_guard_signout') ?></li>
	</ul>
  	</div>
	<?php endif ?>
      </div>

      <div id="content">
        <?php if ($sf_user->hasFlash('notice')): ?>
          <div class="flash_notice">
            <?php echo $sf_user->getFlash('notice') ?>
          </div>
        <?php endif; ?>
 
        <?php if ($sf_user->hasFlash('error')): ?>
          <div class="flash_error">
            <?php echo $sf_user->getFlash('error') ?>
          </div>
        <?php endif; ?>
 
        <div class="content">
          <?php echo $sf_content ?>
        </div>
      </div>
 
      <div id="footer">
        <div class="content">
          <ul>
	    <li><a href="/about.php"><?php echo __('about openZIM') ?></a></li>
	  </ul>
	</div>
      </div>
    </div>
  </body>
</html>
