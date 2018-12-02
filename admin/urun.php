<?php  require_once 'header.php'; ?>
<?php  require_once 'classdb.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

	
function sil(oEvent) {
	
$.post('islem.php', { urun_id : oEvent , islem : 'sil' }, 
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

$.post('islem.php', { urun_id : oEvent , islem : 'getir' },
    function(data) {
    var a = data.split("-");

    document.getElementById("id").value      = a[0];
    document.getElementById("isim").value   = a[1];
    document.getElementById("fiyat").value  = a[2];
    document.getElementById("resim").src    = a[3];
   
});
};

function kaydet(argument) {

  var id      =     document.getElementById("id").value;
  var isim    =     document.getElementById("isim").value ;
  var fiyat   =     document.getElementById("fiyat").value ;
  var resim   =     document.getElementById("resim").value ;
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
$menu = $db->selectAnd("menu", $login);
?>
 <button  id="sil"  onclick="EKLEME()"  type="button" style="width: 120px " class="btn btn-warning">ÜRÜN EKLE</button> 

<a href="index.php" style="width: 120px " class="btn btn-warning"> Home</a> 


<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Ürün id</th>
      <th scope="col">Ürün Adı</th>
      <th scope="col">Ürun fiyat </th>
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
      <td><button  id="sil"  onclick="duzenle('<?php echo $value[0] ?>' )"  type="button" style="width: 90px " class="btn btn-warning"> DÜZENLE</button> 
          <button  id="sil"  onclick="sil('<?php echo $value[0] ?>' )"  type="button" style="width: 50px " class="btn btn-warning"> SİL</button> </td>
 
    </tr>

<?php }; ?>

 	  </tbody>
</table>

  <div style="display: none;" " id="update"  class="card card-body bg-light mt-5">
          ÜRÜN GÜNCELLEME
          ID 
          <input id="id" class="form-control" type="text" value="test" >
          <br>
          İSİM
          <input id="isim" class="form-control" type="text">
          <br>
          FİYAT
          <input id="fiyat" class="form-control" type="text">
          <br>
          RESİM
          <img id="resim" src="" alt="">
          <br>

          RESİM DEĞİŞTİR
          <br>
          <br>
          <input type="file" align="center" class="form-control-file" id="exampleFormControlFile1">
          <br>
          <button  id="sil"  onclick="kaydet()"  type="button" style="width: 90px " class="btn btn-warning">kaydet</button> 
 </div>


   <div style="display: none;" " id="insert"  class="card card-body bg-light mt-5">

          ÜRÜN EKLEME
          İSİM
          <input id="isim_insert" class="form-control" type="text">
          <br>
          FİYAT
          <input id="fiyat_insert" class="form-control" type="text">
          <br>
          RESİM
          <br>
          <input id="file" type="file"  align="center" class="form-control-file" id="exampleFormControlFile1">
          <br>
          <button  id="sil"  onclick="insert()"  type="button" style="width: 90px " class="btn btn-warning">kaydet</button> 
 </div>


<?php  require_once 'footer.php'; ?>