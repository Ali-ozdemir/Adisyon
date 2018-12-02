<?php  require_once 'header.php'; ?>
<?php  require_once 'classdb.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

	
function sil(oEvent) {
	
$.post('islem.php', { masa_id : oEvent , islem : 'masa_sil' }, 
  function(data) {
    location.reload();

});
};



function EKLEME_MASA(argument) {
	debugger;

  $.post('islem.php', {islem :  'insert_MASA' },
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
$menu = $db->selectAnd("masadurum", $login);
?>
 <button  id="sil"  onclick="EKLEME_MASA()"  type="button" style="width: 120px " class="btn btn-warning">MASA EKLE</button> 
<a href="index.php" style="width: 120px " class="btn btn-warning"> Home</a> 
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Masa id</th>
      <th scope="col">Masa Adı</th>
      <th scope="col">İşlemler</th>
    </tr>
  </thead>
  <tbody>
 <?php 
foreach ($menu as $key => $value) {
 ?>
    <tr>
      <th scope="row" > <?php  echo($value[0]) ?></th>
      <td>


      <?php  if (($value[1]) == 1 ) {  
      	?>
			<p class="text-primary">Açık</p>
        <?php } ?>
      	
 		<?php  if (($value[1]) == 0 ) {  
      	?>
      	<p class="text-danger">Kapalı</p>
        <?php } ?>

      </td>
      <td>
          <button  id="sil"  onclick="sil('<?php echo $value[0] ?>' )"  type="button" style="width: 50px " class="btn btn-warning"> SİL</button> </td>
 
    </tr>

<?php }; ?>

 	  </tbody>
</table>



<?php  require_once 'footer.php'; ?>