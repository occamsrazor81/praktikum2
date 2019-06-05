<?php require_once __DIR__.'/_header_endDraft.php'; ?>

<hr>
<form  action="index.php?rt=teams/changeTeamNameResults" method="post">

New team name: <input type="text" name="team_name" >
<br>

<input type="submit" name="change" value="Apply changes">

</form>

<?php require_once __DIR__.'/_footer.php'; ?>
