  <div class="search">
        <h2>Anlage Suchen/Filtern:</h2>
        <form action="<?php echo url_for('anlage_search') ?>" method="get">
                <input type="text" name="query" value="<?php echo $sf_request->getParameter('query') ?>" id="search_keywords" />
                <input type="submit" value="GO" />
                <img id="loader" src="/images/loader.gif" style="vertical-align: middle; display: none" />
                <div class="help">
                        Suche nach Keywords (Name, Ziel, Inhalt, ...)
                </div>
        </form>
      </div>

<h1>Anlagen</h1>

<?php include_partial('anlage/list', array('anlagen' => $anlagen)) ?>

<a href="<?php echo url_for('anlage/new') ?>">New</a>
