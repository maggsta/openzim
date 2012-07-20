<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title><?php include_slot('title', '-= openZIM =-') ?></title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php use_javascript('autosubmit.js') ?>
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
		<li><?php echo link_to(__('Attachments'), 'anlage') ?></li>
		<?php if ($sf_user->hasCredential('admin')): ?>
			<li><?php echo link_to(__('ZIMs'), 'zim') ?></li>
			<li><?php echo link_to(__('User'), 'sf_guard_user') ?></li>
			<li><?php echo link_to(__('Tools'), 'admin_tools') ?></li>
		<?php endif ?>
		<li><?php echo link_to($sf_user->getUsername().' ('.__('Logout').')', 'sf_guard_signout') ?></li>
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

	<div id="page-wrap">

        <h2 id="chat">oZchat</h2>

        <p id="name-area"></p>

        <div id="chat-wrap"><div id="chat-area"></div></div>

        <form id="send-message-area">
            <p>Your message: </p>
            <textarea id="sendie" maxlength = '100' ></textarea>
        </form>

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
