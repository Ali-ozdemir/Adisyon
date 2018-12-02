
<?php 
 	require_once 'classdb.php';
	$db1 = new DataBase();

if ($_POST['islem'] =='sil') {

	$data = $db1->delete('menu',$_POST['urun_id'],'urun_id');
	echo($data);

};



if ($_POST['islem'] =='getir') {
	$login = array(
    'urun_id' => $_POST['urun_id']);
	$user = $db1->selectAnd("menu", $login);
	foreach ($user  as $key => $value) {
	echo($value[0] ."-". $value[1] ."-". $value[2] ."-". $value[3]  );
};

};

if ($_POST['islem'] =='updata_urun') { 

echo($_POST['urun_ad']);
$Array = array(
    'urun_ad' 		=> 	$_POST['urun_isim'],
    'urun_fiyat' => $_POST['urun_fiyat'],
    'urun_resim' => $_POST['urun_resim']
);

	$data = $db1->update('menu', $_POST['urun_id'] , $Array , 'urun_id');

	echo($data);
	};


if ($_POST['islem'] =='insert_urun') { 
	$Array = array(
    'urun_ad' 		=> 	$_POST['urun_isim'],
    'urun_fiyat' 	=> $_POST['urun_fiyat'],
    'urun_resim' 	=> $_POST['urun_resim']
);

$data = $db1->insert('menu', $Array);
echo($data ." İD'li ürün Eklendi " );
};

if ($_POST['islem'] =='insert_MASA') { 
	$Array = array(
    'masa_durum' 		=> '0',
);

$data = $db1->insert('masadurum', $Array);
echo($data ." İD'li masa Eklendi " );

};
if ($_POST['islem'] =='masa_sil') {
$data = $db1->delete('masadurum',$_POST['masa_id'],'masa_id');
	echo($data);

 };


 if ($_POST['islem'] =='getir_user') {
	$login = array(
    'id' => $_POST['id']);
	$user = $db1->selectAnd("users", $login);
	foreach ($user  as $key => $value) {
	echo($value[0] ."-". $value[1] ."-". $value[2] ."-". $value[3] ."-". $value[4] ."-". $value[5]  );
};

};


if ($_POST['islem'] =='sil_user') {

	$data = $db1->delete('users',$_POST['id'],'id');
	echo($data);

};
 ?>
