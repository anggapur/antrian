<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center">No</th>
            <th class="center">CSR/Operator</th>
            <th class="center">Jml Trx</th>
            <th class="center">Proses Pelayanan</th>
            <th class="center">Jml Terlayani</th>
            <th class="center">Min Waktu Layanan</th>
            <th class="center">Max Waktu Layanan</th>
            <th class="center">Rata2 Waktu Layanan</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$i=1;
		foreach($data->result() as $dt){ 
		?>
        <tr>
        	<td class="center"><?php echo $i++?></td>
            <td class="left"><?php echo $dt->csr;?></td>
            <td class="right"><?php echo $dt->jml;?></td>
            <td class="right"><?php echo $dt->stat_inprogress;?></td>
            <td class="right"><?php echo $dt->stat_close;?></td>
            <td class="center"><?php echo $dt->min_time;?></td>
            <td class="center"><?php echo $dt->max_time?></td>
            <td class="center"><?php echo $dt->average_time;?></td>
        </tr>
		<?php } ?>
    </tbody>
</table>