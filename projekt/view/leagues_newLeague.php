<?php require_once __DIR__.'/_header_ulogiranog.php'; ?>

<hr>
<form  action="index.php?rt=leagues/createNewLeague" method="post">

League title: <input type="text" name="leagueName" >
<br>
Target league members: <input type="number" name="leagueNumber" >
<br>
League type:
<select  name="leagueSelect">
  <option value="public">Public</option>
  <option value="private">Private</option>
  <option value="public_paid">Public Paid</option>
  <option value="private_paid">Private Paid</option>

</select>
<hr>

<input type="submit" name="create" value="Create League">

</form>

<?php require_once __DIR__.'/_footer.php'; ?>
