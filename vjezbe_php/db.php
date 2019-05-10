<?php

include 'db_class.php';




if($username = pokusaj_logina_uspio())
  crtaj_ulogirani_korisnik();

elseif (pokusaj_registracije())
  registriraj_korisnika();


else
  crtaj_formu_za_login();





//---------------------------------



function pokusaj_registracije()
{
  if(isset($_POST['register'])
  && isset($_POST['username']) && isset($_POST['password']))
  return true;

  else return false;
}


function registriraj_korisnika()
{
  $db = DB::getConnection();

  $st = $db->prepare('INSERT INTO users:(Username,Password) VALUES (:username,:password) ');
  $st->execute(array(
      'username'=>$_POST['username'],
      'password'=>password_hash($_POST['password']),PASSWORD_DEFAULT));

  echo "Registracija uspjela.";
  echo '<a href="db.php">Povratak</a>';
}




function pokusaj_logina_uspio()
{

  if(!(isset($_POST['register'])
  && isset($_POST['username']) && isset($_POST['password'])))
  return false;


  $db = DB::getConnection();
  $st = $db->prepare('SELECT Username,Password FROM users WHERE Username= :username');
  $st->execute( array('username' => $_POST['username']));

  if($st->rowCount()!== 1)
   return false;

   $row = $st->fetch();

   if(password_verify($_POST["password"],$row['Password']))
      return $_POST['username'];

    else
      return false;

}





function crtaj_ulogirani_korisnik()
{
  ?>
  <!DOCTYPE html>

  <HTML>
  <HEAD>
    <title>mysql</title>
  </HEAD>

  <BODY>
    Dobro dosli, <?php echo $username ?>.
      Uspjesno ste ulogirani.

  </BODY>
  </HTML>


  <?php
}




function crtaj_formu_za_login()
{
  ?>
  <!DOCTYPE html>

  <HTML>
  <HEAD>
    <title>mysql</title>

  </HEAD>

  <BODY>




      <form action = "db.php" method = "POST">
      Username: <input type="text" name="username"/>
        <br/><br/>
      Password: <input type="password" name="password"/>
        <br/><br/>

        <input type="submit" name ="register" value="Register" />
        <input type="submit" name=" login" value="Login" />


      </form>

    </BODY>
    </HTML>

    <?php
}

?>
