<!-- <?php 	
echo $_GET['clicked'] ;

 ?> -->



 <?php
  // Init session
  session_start();

  // Include db config
 require_once 'conn\db.php';

  // Validate login
  if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    header('location: login.php');
    exit;
  }

    		 $masadetay= $pdo->prepare("SELECT  * FROM masadurum WHERE masa_id = :masa_id");
              $masadetay->execute(array(
				'masa_id' => $_GET['clicked']
              	));
                while($masadetaycek=$masadetay->fetch(PDO::FETCH_ASSOC)) {
                
                }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	   $("#siparis_ver").hide()
	   $("#hesap_kapat").hide()

    $("#hesapkapat").click(function(){
        $("#hesap_kapat").show(function clear() {
        }) ;
         $("#siparis_ver").hide() ;
          var masa_id = <?php echo $_GET['clicked'] ?>;
      $.post('islem.php', {masa_id : masa_id , islem : 'masa_kapat' }, 
  function(data) {       
     debugger;
    var one = 1;
    var TOPLAM = 0;
   var arr = data.split('/');
for (var i = arr.length - 1; i >= 0; i--) {
 var arr2 = arr[i].split('-');
if (one == 2 ) {
  if (i == 0) {
 arr2[0] = arr2[0].substring(1,arr2[0].length)
  };
document.getElementById('total').innerHTML = document.getElementById('total').innerHTML + 
  arr2[0];

document.getElementById('total').innerHTML = document.getElementById('total').innerHTML + 
   '<br>' +' ADET : ' +  arr2[1] + '  TOPLAM : '+ arr2[2]  + '<p  align="center"><button  class="btn btn-danger" > Sadece öde</button></p>' +'<hr>'  ;
TOPLAM = TOPLAM + parseInt(arr2[2]);
};
 one = 2;
};

document.getElementById('total').innerHTML = document.getElementById('total').innerHTML;
document.getElementById('total3').innerHTML = document.getElementById('total3').innerHTML + TOPLAM ;
});
    });
    $("#siparisver").click(function(){
      var masa_id = <?php echo $_GET['clicked'] ?>;
      $.post('islem.php', {masa_id : masa_id , islem : 'masa_ac' }, 
  function(data) {

});
        $("#siparis_ver").show(function clear1() {
          // body...
        });
          $("#hesap_kapat").hide() ;
    });

//     $( "#ekle" ).click(function() {
//     debugger
//  	 var fired_button = $(this).text();
//     alert(fired_button);
// });
// 
// 
});
function ekleme(oEvent) {
var masa_id = <?php echo $_GET['clicked'] ?>;
$.post('islem.php', {masa_id : masa_id , urun_id : oEvent , islem : 'ekle' }, 
  function(data) {
    var one = 1;
   var arr = data.split('/');
for (var i = arr.length - 1; i >= 0; i--) {
 var arr2 = arr[i].split('-');
if (one == 2 ) {
  if (i == 0) {
 arr2[0] = arr2[0].substring(1,arr2[0].length)
  };
document.getElementById(arr2[0]).innerHTML =' ADET : ' +  arr2[1] + '  TOPLAM : '+ arr2[2]  ;
};
 one = 2;

};
});
};



function sil(oEvent) {
   

var masa_id = <?php echo $_GET['clicked'] ?>;

$.post('islem.php', {masa_id : masa_id , urun_id : oEvent , islem : 'sil' }, 
  function(data) {
    var one = 1;
    debugger;
   var arr = data.split('/');
for (var i = arr.length - 1; i >= 0; i--) {
 var arr2 = arr[i].split('-');
if (one == 2 ) {
  if (i == 0) {
 arr2[0] = arr2[0].substring(1,arr2[0].length)
  };
document.getElementById(arr2[0]).innerHTML = ' ADET : ' +  arr2[1] + '  TOPLAM : '+ arr2[2] + '<hr>';
};
 one = 2;

};

});

};
function ödeme() {

var masa_id = <?php echo $_GET['clicked'] ?>;
$.post('islem.php', {masa_id : masa_id , islem : 'ödeme' }, 
  function(data) {
    if (data) {
      alert('Ödeme Yapıldı. Teşekkürler . ');
      window.location = "masadurum.php";
    };
});

};


</script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <title>Masa Detay</title>
</head>
<body class="bg-primary">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card card-body bg-light mt-5">
          <h2>Masa Detay  <small class="text-muted"><?php echo $_SESSION['email']; ?></small>

        <a href="masadurum.php"  style="width: 120px "  class="btn btn-warning"> Home</a>
          </h2>

			<?php 

				$masadetay= $pdo->prepare("SELECT  * FROM masadurum WHERE masa_id = :masa_id");
              	$masadetay->execute(array(
				      'masa_id' => $_GET['clicked']
              	));
                while($masadetaycek=$masadetay->fetch(PDO::FETCH_ASSOC)) {
              	if ($masadetaycek['masa_durum'] == 1) {
              	  	 echo '<input id = "hesapkapat" type="submit" style="width: 260px ; height: 200px "   class="btn btn-success" name="clicked" value="HESAP KAPAT" />

              	  	 <input id = "siparisver" type="submit" style="width: 260px ; height: 200px "   class="btn btn-success" name="clicked" value="siparis ver" />
              	  	 ';
              	  }  
              	  	if ($masadetaycek['masa_durum'] == 0) {
              	  	 echo '<input type="submit" id = "siparisver" style="width: 260px ; height: 200px "   class="btn btn-danger" name="clicked" value="sipariş gir" />';
              	  }  
                }

			 ?>

        </div>
        <div id="siparis_ver"  class="card card-body bg-light mt-5">

	 	<form method="POST" id="siparisver">
        	
        		<?php 

				 $menu= $pdo->prepare("SELECT * FROM menu ");
              $menu->execute();
              while($menucek= $menu->fetch(PDO::FETCH_ASSOC)) {
 				?>
 		
			
			
			<button  id="ekle" value="<?php echo $menucek['urun_id'] ?>" onclick="ekleme('<?php echo $menucek['urun_id'] ?>' )"  type="button" style="width: 150px" class="btn btn-warning"><?php echo  $menucek['urun_ad'] ?> <?php echo $menucek['urun_fiyat'] ?> TL </button>


      <button  id="ekle" value="<?php echo $menucek['urun_id'] ?>" onclick="sil('<?php echo $menucek['urun_id'] ?>' )"  type="button" style="width: 150px" class="btn btn-danger">   SİL </button>

        <p class="bg-warning" style="width: 300px" id ="<?php echo $menucek['urun_ad'] ?>"> </p>
					<br> 
            	<?php   	
              }
			 ?> 
    
</form>

        </div>
 		<div  id="hesap_kapat"   class="card card-body bg-light mt-5">
    			  <p align="center" id="total" ></p>
            <p align="center" id="total2" ></p>
            <p align="right"  id="total3" >TOPLAM : </p>
              
             


             <button align="center"   id="ödeme" value="" onclick="ödeme()"  type="button" style="width: 1070px " class="btn btn-danger"> Ödeme Yap</button>
        </div>

      </div>
    </div>
  </div>
</body>
</html>