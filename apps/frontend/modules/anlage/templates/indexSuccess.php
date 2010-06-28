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

<table id="anlagen">
  <thead>
    <tr>
      <th>Name</th>
      <th>Ziel</th>
      <th>Kurzinhalt</th>
    </tr>
  </thead>
  <tbody>

  <?php foreach ($anlages as $i => $anlage): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
      <td class="name">
	<?php echo link_to($anlage->getName(), 'anlage/show?id='.$anlage->getId(), $anlage) ?>
      </td>
      <td class="ziel">
        <?php echo $anlage->getZiel() ?>
      </td>
      <td class="inhalt">
        <?php echo $anlage->getKurzInhalt() ?>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<a href="<?php echo url_for('anlage/new') ?>">New</a>
