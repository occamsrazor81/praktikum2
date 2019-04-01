<!DOCTYPE html>

<?php
$a = 'x';
  function odigraj($a)
  {
    if(isset($_POST['p1']))
    {
      $_POST['p1'] = $a;

    }
    elseif(isset($_POST['p2']))
    {
      $_POST['p2'] = $a;
    }
    elseif(isset($_POST['p3']))
    {
      $_POST['p3'] = $a;
    }
    elseif(isset($_POST['p4']))
    {
      $_POST['p5'] = $a;
    }
    elseif(isset($_POST['p6']))
    {
      $_POST['p6'] = $a;
    }
    elseif(isset($_POST['p7']))
    {
      $_POST['p7'] = $a;
    }
    elseif(isset($_POST['p8']))
    {
      $_POST['p8'] = $a;
    }
    elseif(isset($_POST['p9']))
    {
      $_POST['p9'] = $a;
    }
    if($a = 'x') $a = 'o';
    else $a = 'x';
  }
 ?>


<HTML>
<HEAD>
  <title>xo</title>
  <style> table,tr,td {border: solid 2px;}</style>
</HEAD>

<BODY>
  <form action = "xo.php" method = "POST" >
    <table>
      <tr>
        <td><input type="submit" value="?" name="p1"/></td>
        <td><input type="submit" value="?" name="p2"/></td>
        <td><input type="submit" value="?" name="p3"/></td>

      </tr>

      <tr>
        <td><input type="submit" value="?" name="p4"/></td>
        <td><input type="submit" value="?" name="p5"/></td>
        <td><input type="submit" value="?" name="p6"/></td>

      </tr>

      <tr>
        <td><input type="submit" value="?" name="p7"/></td>
        <td><input type="submit" value="?" name="p8"/></td>
        <td><input type="submit" value="?" name="p9"/></td>
      </tr>

    </table>

  </form>

  <table>
    <tr>
      <td><input type="submit" value=<?php echo $_POST['p1'] ?> name="p1"/></td>
      <td><input type="submit" value=<?php echo $_POST['p2'] ?> name="p2"/></td>
      <td><input type="submit" value=<?php echo $_POST['p3'] ?> name="p3"/></td>

    </tr>

    <tr>
      <td><input type="submit" value=<?php echo $_POST['p4'] ?> name="p4"/></td>
      <td><input type="submit" value=<?php echo $_POST['p5'] ?> name="p5"/></td>
      <td><input type="submit" value=<?php echo $_POST['p6'] ?> name="p6"/></td>

    </tr>

    <tr>
      <td><input type="submit" value=<?php echo $_POST['p7'] ?> name="p7"/></td>
      <td><input type="submit" value=<?php echo $_POST['p8'] ?> name="p8"/></td>
      <td><input type="submit" value=<?php echo $_POST['p9'] ?> name="p9"/></td>
    </tr>

  </table>


</BODY>
</HTML>
