<div class="newlink">
<?php echo link_to('Neues Zim erstellen','zim_new') ?>
</div>

<h1>Zim Liste</h1>
<div class="paginatelist">

<?php include_partial('zim/list', array('zims' => $pager->getResults())) ?>

<?php if ($pager->haveToPaginate()): ?>
  <div class="pagination">
    <a href="<?php echo url_for('zim/index') ?>?page=1">
      <img src="/images/first.png" alt="First page" title="First page" />
    </a>
 
    <a href="<?php echo url_for('zim/index') ?>?page=<?php echo
$pager->getPreviousPage() ?>">
      <img src="/images/previous.png" alt="Previous page" title="Previous
page" />
    </a>
 
    <?php foreach ($pager->getLinks() as $page): ?>
      <?php if ($page == $pager->getPage()): ?>
        <?php echo $page ?>
      <?php else: ?>
        <a href="<?php echo url_for('zim/index') ?>?page=<?php echo
$page ?>"><?php echo $page ?></a>
      <?php endif; ?>
    <?php endforeach; ?>
 
    <a href="<?php echo url_for('zim/index') ?>?page=<?php echo
$pager->getNextPage() ?>">
      <img src="/images/next.png" alt="Next page" title="Next page" />
    </a>
 
    <a href="<?php echo url_for('zim/index') ?>?page=<?php echo
$pager->getLastPage() ?>">
      <img src="/images/last.png" alt="Last page" title="Last page" />
    </a>
  </div>
<?php endif; ?>
</div>
