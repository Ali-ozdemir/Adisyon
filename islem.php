 <?php    
 require_once 'conn\db.php';

if ($_POST['islem'] == 'ekle') {
	

		$masadetay= $pdo->prepare("SELECT  * FROM masa_siparis WHERE masa_id = :masa_id and urun_id =:urun_id ");
              	$masadetay->execute(array(
				      'masa_id' => $_POST['masa_id'],
				      'urun_id' => $_POST['urun_id']
              	));
              	$row = $masadetay->fetch(PDO::FETCH_ASSOC);
		              if( ! $row)
						{
						 $insert_urun=$pdo->prepare("INSERT INTO  masa_siparis SET
							masa_id		=:masa_id,
							urun_id		=:urun_id,
							urun_adet 	=:urun_adet
							");
						$kaydet=$insert_urun->execute(array(
							'masa_id'		=> $_POST['masa_id'],
							'urun_id' 		=> $_POST['urun_id'],
							'urun_adet'	    => 1
					));
						};

						if($row)
						{
								
						 $insert_urun=$pdo->prepare("UPDATE masa_siparis SET
							masa_id		=:masa_id,
							urun_id		=:urun_id,
							urun_adet 	=:urun_adet
							where urun_id={$_POST['urun_id']} and  masa_id={$_POST['masa_id']}
							");
						$kaydet=$insert_urun->execute(array(
							'masa_id'		=> $_POST['masa_id'],
							'urun_id' 		=> $_POST['urun_id'],
							'urun_adet'	    => $row['urun_adet'] + 1 
					));
						};
	$masadetay= $pdo->prepare("SELECT  * FROM masa_siparis WHERE masa_id = :masa_id");
              	$masadetay->execute(array(
				      'masa_id' => $_POST['masa_id']
              	));
                while($masadetaycek=$masadetay->fetch(PDO::FETCH_ASSOC)) {

	                	$urun_Detay= $pdo->prepare("SELECT  * FROM menu WHERE urun_id = :urun_id");
	              	$urun_Detay->execute(array(
					      'urun_id' => $masadetaycek['urun_id']
	              	));
	                while($urun_Detay_cek=$urun_Detay->fetch(PDO::FETCH_ASSOC)) {

	                	echo($urun_Detay_cek['urun_ad'] ."-". $masadetaycek['urun_adet'] ."-". $masadetaycek['urun_adet']  * $urun_Detay_cek['urun_fiyat'] ."-/"  );
	                };
                } 


	};
   

if ($_POST['islem'] == 'sil') {

	$masadetay= $pdo->prepare("SELECT  * FROM masa_siparis WHERE masa_id = :masa_id and urun_id =:urun_id ");
              	$masadetay->execute(array(
				      'masa_id' => $_POST['masa_id'],
				      'urun_id' => $_POST['urun_id']
              	));
              	$row = $masadetay->fetch(PDO::FETCH_ASSOC);
              			// echo($row);	
						if($row)
						{




						 $update_masa=$pdo->prepare("UPDATE masa_siparis SET
							urun_adet 	=:urun_adet
							where urun_id={$_POST['urun_id']} and  masa_id={$_POST['masa_id']}
							"   );


	
						 $kaydet= $update_masa->execute(array(
							'urun_adet'	    =>  $row['urun_adet'] - 1
							));
						};



				$masadetay= $pdo->prepare("SELECT  * FROM masa_siparis WHERE masa_id = :masa_id");
              	$masadetay->execute(array(
				      'masa_id' => $_POST['masa_id']
              	));
                while($masadetaycek=$masadetay->fetch(PDO::FETCH_ASSOC)) {

	                	$urun_Detay= $pdo->prepare("SELECT  * FROM menu WHERE urun_id = :urun_id");
	              	$urun_Detay->execute(array(
					      'urun_id' => $masadetaycek['urun_id']
	              	));
	                while($urun_Detay_cek=$urun_Detay->fetch(PDO::FETCH_ASSOC)) {

	                	echo($urun_Detay_cek['urun_ad'] ."-". $masadetaycek['urun_adet'] ."-". $masadetaycek['urun_adet']  * $urun_Detay_cek['urun_fiyat'] ."-/"  );
	                };
                } 
};

if ($_POST['islem'] == 'masa_ac') {
	 $masa_ac=$pdo->prepare("UPDATE masadurum SET
							masa_id			=:masa_id,
							masa_durum		=:masa_durum
							where masa_id	={$_POST['masa_id']}
							");
						$masa_ac_up=$masa_ac->execute(array(
							'masa_id'		=> $_POST['masa_id'],
							'masa_durum' 	=> 1
					));
};
if ($_POST['islem'] == 'masa_kapat') {
	$masadetay= $pdo->prepare("SELECT  * FROM masa_siparis WHERE masa_id = :masa_id");
              	$masadetay->execute(array(
				      'masa_id' => $_POST['masa_id']
              	));
                while($masadetaycek=$masadetay->fetch(PDO::FETCH_ASSOC)) {

	                	$urun_Detay= $pdo->prepare("SELECT  * FROM menu WHERE urun_id = :urun_id");
	              	$urun_Detay->execute(array(
					      'urun_id' => $masadetaycek['urun_id']
	              	));
	                while($urun_Detay_cek=$urun_Detay->fetch(PDO::FETCH_ASSOC)) {

	                	echo($urun_Detay_cek['urun_ad'] ."-". $masadetaycek['urun_adet'] ."-". $masadetaycek['urun_adet']  * $urun_Detay_cek['urun_fiyat'] ."-/"  );
	                };
                } ;
};

if ($_POST['islem'] == 'ödeme') {

	$masa_ac=$pdo->prepare("DELETE FROM masa_siparis
							where masa_id	={$_POST['masa_id']}
							");
						$masa_ac_up=$masa_ac->execute(array(
							
					));
	 $masa_KAPAT=$pdo->prepare("UPDATE masadurum SET
							masa_id			=:masa_id,
							masa_durum		=:masa_durum
							where masa_id	={$_POST['masa_id']}
							");
						$masa_KAPAT_CL=$masa_KAPAT->execute(array(
							'masa_id'		=> $_POST['masa_id'],
							'masa_durum' 	=> 0
					));




		echo($masa_KAPAT_CL);
};

  ?>