<div class="search">
   <h2><?php echo __('Anlage Suchen/Filtern:') ?></h2>
   <form action="<?php echo url_for('anlage_search') ?>" method="get">
   				<?php echo $form ?>
                <input type="text" name="query" value="<?php echo $sf_request->getParameter('query') ?>" id="search_keywords" />
                <input type="submit" value="GO" />
                <img id="loader" src="/images/loader.gif" alt="search_loader" style="vertical-align: middle; display: none" />
                <div class="help">
                        Suche nach Keywords (Name, Ziel, Inhalt, ...)
                </div>
   </form>
</div>

