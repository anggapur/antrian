<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center">No</th>
            <th class="center">Judul</th>
            <th class="center">OP1</th>
            <th class="center">OP2</th>
            <th class="center">OP3</th>
            <th class="center">OP4</th>
            <th class="center">OP5</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$i=1;
		foreach($data->result() as $dt){ 
		?>
        <tr>
        	<td class="center"><?php echo $i++?></td>
            <td class="left"><?php echo $dt->judul;?></td>
            <td class="right"><?php echo $dt->OP1;?></td>
            <td class="right"><?php echo $dt->OP2;?></td>
            <td class="right"><?php echo $dt->OP3;?></td>
            <td class="right"><?php echo $dt->OP4;?></td>
            <td class="center"><?php echo $dt->OP5;?></td>
        </tr>
		<?php } ?>
    </tbody>
</table>