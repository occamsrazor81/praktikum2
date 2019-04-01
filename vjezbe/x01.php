<!DOCTYPE html>

<?php
session_start();



inicijalizirajIgru();
odigrajPotez();
crtajPlocu();



debug();

//------------------------

function debug()
{
  echo '<pre>';
  echo '$_POST =';
  print_r($_POST);
  print_r($_SESSION);
  echo '</pre>';
}


function inicijalizirajIgru()
{
  if(!isset($_SESSION['na_potezu']))
  {
    $_SESSION['na_potezu'] = 'x';
    $_SESSION['ploca'] =
    [
      ['?','?','?'],
      ['?','?','?'],
      ['?','?','?']
    ];
  }
}

function odigrajPotez()
{
  for($red=0; $red<3; $red++)
    for($stup=0; $stup<3; $stup++)
      if(isset($_POST['btn_'.$red.'_'.$stup]))
        {
          $_SESSION['ploca'][$red][$stup] = $_SESSION['na_potezu'];
          if(strcmp($_SESSION['na_potezu'],'x') === 0)
          $_SESSION['na_potezu'] = 'o';

          elseif(strcmp($_SESSION['na_potezu'],'o') === 0)
          $_SESSION['na_potezu'] = 'x';
        }
}


function crtajPlocu()
{
  ?>
  <HTML>
  <HEAD>
    <title>xo</title>
    <style> table,tr,td {border: solid 2px;}</style>
  </HEAD>

  <BODY>
    <h1>Na potezu je: <?php echo $_SESSION['na_potezu'] ?></h1>
  <form method="POST" action="x01.php">
    <table>
      <?php
        for($red=0; $red<3; $red++)
        {
          echo '<tr>';
          for($stup = 0; $stup < 3; $stup++)
          {
            // if(strcmp($_SESSION['ploca'][$red][$stup],'?') === 0)
            // {
              echo '<td>';

              echo '<input type="submit"';
              echo ' name="btn_'.$red.'_'.$stup.'"';
              echo ' value="'.$_SESSION['ploca'][$red][$stup].'"';
              echo '/>';
              echo '</td>';
          //  }

            // else
            // {
            //   echo '<td>';
            //
            //   echo '<input type="submit"';
            //   echo ' name="btn_'.$red.'_'.$stup.'"';
            //   echo ' value="'.$_SESSION['ploca'][$red][$stup].'"';
            //   echo 'disabled';
            //   echo '/>';
            //   echo '</td>';
            //
            // }


          }


          echo '</tr>';
          echo "\n";
         }

       ?>
    </table>
  </form>





  </BODY>
  </HTML>
  <?php
}
