<!-- apps/frontend/templates/layout.php -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title><?php include_slot('title', 'open BRD plus - branch, rank and discuss plus many things more ...') ?></title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_javascripts() ?>
    <?php include_stylesheets() ?>
  </head>
  <body>
    <div id="container">
      <div id="header">
        <div class="content">

          <!--
	  <h1><a href="<?php echo url_for('bild/index') ?>">
            <img src="/images/logo.jpg" alt="openBRD+" />
          </a></h1>
          
          <div id="sub_header">
		
            <div class="search">
              <h2>Search for Content / Discussions</h2>
              <form action="" method="get">
                <input type="text" name="keywords"
                  id="search_keywords" />
                <input type="submit" value="search" />
                <div class="help">
                  Enter some keywords (city, country, position, ...)
                </div>
              </form>
            </div>
          </div>
          -->

	<div id="sub_header"></div>
	</div>
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
            <li><a href="">about openZIM</a></li>
            <li class="feed"><a href="">Full feed</a></li>
            <li><a href="">openZIM API</a></li>
            <li class="last"><a href="">Affiliates</a></li>
            <li><?php echo link_to('Logout', '@sf_guard_signout') ?></li>
	  </ul>
        </div>
      </div>
    </div>
  </body>
</html>
