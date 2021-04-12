<?php

function yuzde($kisiSayisi,$takim)
{
	$hesapla = ($takim*100)/10;
	return $hesapla;
}

$dosya = "anket.txt";



if (isset($_POST["katil"])
{   
	if (!empty($_POST["takim"]))
	{
		$takim = $_POST["takim"];
	    $ip = $_SERVER["REMOTE_ADDR"];
	    $tarih = date("d/m/Y");
	    $ekle = $takim.";".$ip.";".$tarih."\n";
	    $yaz = fopen($dosya, "a");
		fwrite($yaz, $ekle);
		fclose($yaz);
		echo "Ankete katıldığınız için teşekkürler :)";
	}
    else
    {
        echo "Lütfen bir takım seçiniz...";  
    }

	
}

elseif (isset($_POST["sonuclari_getir"])) 
{
	if (file_exists($dosya))
	{
		$oku = fopen($dosya, "r");
		$fb = 0;
		$gs = 0;
		$bjk = 0;
		$ts = 0;
		$kisiSayisi = 0;
		while (!feof($dosya))
		{
			$kisiSayisi++;
			$satir = fgets($oku);
			$dizi = explode(";", $satir);
			if ($dizi[0]=="Fenerbahçe")
			{
			   	$fb++;
			}
			elseif ($dizi[0]=="Galatasaray")
			{
				$gs++;
			}
			elseif ($dizi[0]=="Beşiktaş")
			{
				$bjk++;
			}
			else
			{
				$ts++;
			}
		}
		echo "Fenerbahçeli kişi sayısı: ".$fb."<br>";
		echo "Galatasaraylı kişi sayısı: ".$gs."<br>";
		echo "Trabzonsporlu kişi sayısı: ".$ts."<br>";
		echo "Beşiktaşlı kişi sayısı: ".$bjk."";
		echo ".......................................<br>";
		$fbYuzde = yuzde($kisiSayisi,$fb);
		$gsYuzde = yuzde($kisiSayisi,$gs);
		$bjkYuzde = yuzde($kisiSayisi,$bjk);
		$tsYuzde = yuzde($kisiSayisi,$ts);
		echo "Fenerbahçe: $fbYuzde % <br>";
		echo "Galatasaray: $gsYuzde % <br>";
		echo "Beşiktaş: $bjkYuzde % <br>";
		echo "Trabzonspor: $tsYuzde % <br>";

		echo "Fenerbahçe";
	}
	else
	{
		echo "Ankete henüz kimse katılmamış!";
	}
}




?>