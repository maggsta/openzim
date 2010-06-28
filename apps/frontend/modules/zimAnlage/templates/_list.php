<table class="zimAnlagen">
  <?php foreach ($zimAnlagen as $i => $anlage): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
      <td class="name">
	<?php echo link_to($anlage->getName(), 'zimAnlage/show?id='.$anlage->getId(), $anlage) ?>
      </td>
      <td class="ziel">
        <?php echo $anlage->getInhalt() ?>
      </td>
      <td class="inhalt">
        <?php echo $anlage->getInhalt() ?>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
