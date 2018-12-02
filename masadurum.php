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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
 <script>
   function admin() {
    window.location.href = "admin/index.php";
   };


 </script>
  <title>Adisyon  </title>
</head>
<body class="bg-primary">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card card-body bg-light mt-5">
          <h2>Ana Sayfa <small class="text-muted"><?php echo $_SESSION['email']; ?></small>
          <a href="logout.php"  style="width: 120px "  class="btn btn-warning"> Çıkış </a>
          </h2>

              
          <p>Hoş Geldin <?php echo $_SESSION['name']; ?></p>

          <?php  $yetki= $pdo->prepare("SELECT * FROM users where email = :email and yetki = :yetki"); 

                  $yetki->execute(array(
              'email' => $_SESSION['email'],
              'yetki' => 1
                ));

           $row = $yetki->fetch(PDO::FETCH_ASSOC);
           if ($row) {
            ?>
                <input type="submit" style="width: 1055px ; height: 50px "   class="btn btn-dark" onclick="admin()" name="admin" value="Yönetim Paneli" />
                <br>
            <?php        
           }
           ?>
    
          <form action="masadetay.php">
                <?php 
              $masadurum= $pdo->prepare("SELECT * FROM masadurum ");
              $masadurum->execute();
              while($masadurumcek=$masadurum->fetch(PDO::FETCH_ASSOC)) {
                if ($masadurumcek['masa_durum'] == 1) {           


                   echo '<input type="submit" style="width: 260px ; height: 200px "   class="btn btn-primary" name="clicked" value="'.$masadurumcek['masa_id'].'" />';
                ?> 
                <?php  
                          }
                      if ($masadurumcek['masa_durum'] == 0) {
                            echo '<input type="submit" style="width: 260px ; height: 200px "   class="btn btn-danger" name="clicked" value="'.$masadurumcek['masa_id'].'" />';
                        ?>
               <?php   
                }
           }
           ?>

          </form>
      


        </div>
      </div>
    </div>
  </div>
</body>
</html>