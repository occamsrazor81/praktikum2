<?php require_once __DIR__.'/_header_rUSure.php'; ?>


<form  action="index.php?rt=teams/confirmAddingFreeAgent" method="post">


<p>Are you sure you want to replace <?php echo ' '.$kickedPlayer->name.' '; ?>
  with <?php echo ' '.$newPlayer->name.' '; ?>?
</p>

<button type="submit" name="yes">Yes</button>
<button type="submit" name="no">No</button>

</form>

<?php require_once __DIR__.'/_footer.php'; ?>
