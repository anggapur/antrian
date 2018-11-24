// console.log(terbilang(126));
	// alert(onlyChar("ABa123"));		
	var sounds = new Array();		
	var i = 0;		
	//functionnya 
	function checkData(BASEURL)
	{
		$.ajax({
			type	: 'POST',
			url		: BASEURL+"/display/getDataForTv",			
			cache	: false,
			dataType : 'json',
			success	: function(data,BASEURL){
				$.each(data,function(i,val){
					//console.log(val);
					$('.boxLoket[data-nama-loket="'+val.NAMA_LOKET+'"]').find('.noAntrian').html(val.ANTRIAN_NO);
					//delay untuk cek suara
					if(val.STATUS == "INCALL")
					{
						var isPlay = false;
						console.log("Ada Yang Dicall");
						// alert("Panggil "+val.ANTRIAN_ID);
						ubahStateAntrianNo(val.ANTRIAN_ID);
						//panggil
						noAntrian = complexSplit(val.ANTRIAN_NO);
						klinikTujuan = complexSplit(val.NAMA_LOKET);
						console.log(noAntrian);
						console.log(klinikTujuan);
						makeSound(BASEURL+"nomor_antrian",noAntrian,"dipersilakan_menuju_klinik_tujuan",klinikTujuan);
						playSnd(0);
					}
				});
			}
		});
	}	

	function makeSound(BASEURL,kata1,noAntrian,kata2,klinikTujuan)
	{
		console.log(noAntrian.length);
		console.log(klinikTujuan.length);
		//awal
		iteration = 0;		
		sounds[iteration] = new Audio(BASEURL+"assets/audio/"+kata1+".mp3");
		//buat nomor antrian
		for(it = 0; it < noAntrian.length; it++)
			sounds[++iteration] = new Audio(BASEURL+"assets/audio/"+noAntrian[it]+".mp3");
		//Dipersilahkan
		sounds[++iteration] = new Audio(BASEURL+"assets/audio/"+kata2+".mp3");
		//Klinik tujuan
		for(it = 0; it < klinikTujuan.length; it++)
			sounds[++iteration] = new Audio(BASEURL+"assets/audio/"+klinikTujuan[it]+".mp3");
	}
	function ubahStateAntrianNo(BASEURL,ANTRIAN_ID)
	{

		$.ajax({
			type	: 'POST',
			url		: BASEURL+"/display/ubahStateAntrianNo",			
			cache	: false,
			dataType : 'json',
			data : {
				'ANTRIAN_ID' : ANTRIAN_ID
			},
			success	: function(data){
				console.log(data);
				if(data == "success")
					var isPlay = true;				
			}
		});
	}

	
	function playSnd(index) {	    
	    sounds[index].play();
	    sounds[index].addEventListener("ended",function(){
	    	playSnd(index+1);
	    });
	}

	function penyebut(nilai) {
		nilai = Math.abs(nilai);
		huruf = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
		temp = "";
		if (nilai < 12) {
			temp = " "+ huruf[nilai];
		} else if (nilai <20) {
			temp = penyebut(nilai - 10)+ " belas";
		} else if (nilai < 100) {
			temp = penyebut(Math.floor(nilai/10))+" puluh"+ penyebut(nilai % 10);
		} else if (nilai < 200) {
			temp = " seratus" + penyebut(nilai - 100);
		} else if (nilai < 1000) {
			temp = penyebut(Math.floor(nilai/100)) + " ratus" + penyebut(nilai % 100);
		} else if (nilai < 2000) {
			temp = " seribu" + penyebut(nilai - 1000);
		} else if (nilai < 1000000) {
			temp = penyebut(Math.floor(nilai/1000)) + " ribu" + penyebut(nilai % 1000);
		} else if (nilai < 1000000000) {
			temp = penyebut(Math.floor(nilai/1000000)) + " juta" + penyebut(nilai % 1000000);
		}
		return temp;
	}
 
	function terbilang(nilai) {
		if(nilai<0) {
			hasil = "minus ". penyebut(nilai);
		} else {
			hasil = penyebut(nilai);
		}     		
		return hasil;
	}

	function onlyNumber(str)
	{
		str = str.replace(/[^0-9\.]+/g, "");
		return str;
	}
	function onlyChar(str)
	{
		str = str.replace(/[^A-Za-z\.]+/g, "");
		return str.toLowerCase();
	}
	function complexSplit(str)
	{
		str = str.match(/[a-zA-Z]+|[0-9]+/g);	
		arr = [];
		a = 0;
		for(i = 0; i < str.length ; i++)	
		{
			if(isNaN(str[i]))
			{
				arr[a++] = str[i].toLowerCase();
			}
			else
			{				
				wordSplit = terbilang(str[i]).split(" ");
				for(x = 0; x < wordSplit.length; x++)
				{
					arr[a++] = wordSplit[x];
				}
			}
		}
		return arr.filter(function(e){return e});
	}