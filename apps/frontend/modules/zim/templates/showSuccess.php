<table>
  <tbody>
    <tr>
      <th>Name:</th>
      <td><?php echo $zim->getName() ?></td>
    </tr>
      <th>Anlagen:</th>
	<table>
	  <tbody>
      <?php foreach ($zim->getAnlagen() as $anlage): ?>
	    <tr>
              <td><?php echo $anlage ?></td>
    	    </tr>
      <?php endforeach; ?>
  	  </tbody>
	</table>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('zim/edit?id='.$zim->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('zim/index') ?>">List</a>
