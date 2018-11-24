<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		*
		{
			padding:0;
			margin:0;
			box-sizing: border-box;
		}
		.tiket{
			border: 1px solid black;
			padding: 10px;
			text-align: center;
			width: 200px;
		}
		p.nama {
		    font-weight: bold;
		}

		p.alamat {
		    font-size: 12px;
		}

		p.no_antrian {
		    font-size: 70px;
		    padding-bottom: 10px;
		}

		p.didepan {
		    font-size: 15px;
		}

		p.time {
		    font-size: 12px;
		    padding: 5px 0px;
		}
	</style>
</head>
<body>
	<div class="tiket">
		<p class="nama"><?= $MAIN_NAMA?></p>
		<p class="alamat"><?= $MAIN_ALAMAT?></p>
		<p class="kata">Nomor Antrian</p>
		<p class="no_antrian"><?= $no_antrian?></p>
		<p class="didepan">Mohon menunggu, pelanggan di depan anda : <?= $antrian_di_depan?></p>
		<p class="time"><?= date('d-m-Y h:i:s')?></p>
	</div>

	
</body>
<script type="text/javascript">
	// window.print();
	myFunction();
	function myFunction() {
	    setInterval(function(){ 
	    	// window.print();
	    	// console.log("Hello"); 
	    	
		}, 3000);
	}
</script>


</html>