<?php  require_once 'header.php'; ?>
<?php  require_once 'classdb.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

	
function sil(oEvent) {
	
$.post('islem.php', { id : oEvent , islem : 'sil_user' }, 
  function(data) {
    location.reload();

});
};



function duzenle(oEvent) {


    var x = document.getElementById("update");
 
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    };

$.post('islem.php', { id : oEvent , islem : 'getir_user' },
    function(data) {
    
    var a = data.split("-");
	debugger;
    document.getElementById("isim_user").value      = a[1];
    document.getElementById("mail_user").value      = a[2];
    document.getElementById("time_user").value  	   = a[4]  + '.' + a[5] + '.' + a[6];
    document.getElementById("Yetki_user").value     = a[7];
   
});
};

function kaydet(argument) {

  var id      =     document.getElementById("isim_user").value;
  var isim    =     document.getElementById("mail_user").value ;
  var fiyat   =     document.getElementById("user_mail").value ;
  $.post('islem.php', { urun_id : id , urun_isim : isim , urun_fiyat : fiyat , urun_resim : resim ,islem : 'updata_urun' },
        function(data) {
      debugger;
          if (data == 1 ) {
           alert('işlem başarılı');
          };
         location.reload();

   
});
};
function EKLEME(argument) {
  // body...
var x = document.getElementById("insert");
 
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    };

};

function insert(argument) {
  var isim    =     document.getElementById("isim_insert").value ;
  var fiyat   =     document.getElementById("fiyat_insert").value ;
  var resim   =     document.getElementById("file").files[0].name ;
 debugger;
  $.post('islem.php', {  urun_isim : isim , urun_fiyat : fiyat , urun_resim : resim ,islem : 'insert_urun' },
        function(data) {
 
           alert(data);

         location.reload();
});
  //////
};
</script>
<?php 
$db = new DataBase();
$login = array();
$menu = $db->selectAnd("users", $login);
?>
 <button  id="sil"  onclick="EKLEME()"  type="button" style="width: 120px " class="btn btn-warning">User EKLE</button> 
<a href="index.php" style="width: 120px " class="btn btn-warning"> Home</a> 
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">User id</th>
      <th scope="col">User Adı</th>
      <th scope="col">User Mail </th>
      <th scope="col">user creat Time</th>
      <th scope="col">user Yetki</th>
      <th scope="col">İşlemler</th>
    </tr>
  </thead>
  <tbody>

 <?php 
foreach ($menu as $key => $value) {
 ?>
    <tr>
      <th scope="row" > <?php  echo($value[0]) ?></th>
      <td><?php    echo($value[1]) ?></td>
      <td><?php    echo($value[2]) ?></td>
      <td><?php    echo($value[4]) ?></td>
      <td><?php    echo($value[5]) ?></td>
    

      <td><button  id="sil"  onclick="duzenle('<?php echo $value[0] ?>' )"  type="button" style="width: 90px " class="btn btn-warning"> Görüntüle</button> 
          <button  id="sil"  onclick="sil('<?php echo $value[0] ?>' )"  type="button" style="width: 50px " class="btn btn-warning"> SİL</button> </td>
 
    </tr>

<?php }; ?>

 	  </tbody>
</table>

  <div style="display: none;" " id="update"  class="card card-body bg-light mt-5">
          User GÜNCELLEME
          <br>
          İSİM
          <input id="isim_user" class="form-control" type="text">
          <br>
          Mail
          <input  type="email" id="mail_user" class="form-control" type="text">
          <br>
          Creat Time
          <input id="time_user" readonly class="form-control"  type="text">
          <br>
 </div>


   <div style="display: none;" " id="insert"  class="card card-body bg-light mt-5">
	
<?php  require_once '..\register.php'; ?>
 </div>


<?php  require_once 'footer.php'; ?>