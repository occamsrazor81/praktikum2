<?php require_once __DIR__.'/_header_rUSure.php'; ?>


<form  action="index.php?rt=teams/confirmCuttingPlayer" method="post">

<p>Are you sure you want to cut <?php echo ' '.$kickedPlayer->name; ?>
  from the <?php echo ' '.$team_name; ?>?
</p>

<button type="submit" name="yes">Yes</button>
<button type="submit" name="no">No</button>

</form>

<?php require_once __DIR__.'/_footer.php'; ?>
