<table>
  <tbody>
    <tr>
      <th>Name:</th>
      <td><?php echo $zim->getName() ?></td>
    </tr>
    <tr>
      <th>Stunden:</th>
	<table>
	  <tbody>
      <?php foreach ($zim->getStunden() as $stunde): ?>
	    <tr>
              <td><?php echo $stunde ?></td>
    	    </tr>
	    <tr>
	      <th>Anlagen:</th>
		<table>
		  <tbody>
	      <?php foreach ($stunde->getAnlagen() as $anlage): ?>
		    <tr>
	              <td><?php echo $anlage ?></td>
	    	    </tr>	
	      <?php endforeach; ?>
	  	  </tbody>
		</table>
	    </tr>
      <?php endforeach; ?>
  	  </tbody>
	</table>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('zim/edit?id='.$zim->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('zim/export?id='.$zim->getId()) ?>">Export</a>
&nbsp;
<a href="<?php echo url_for('zim/index') ?>">List</a>
