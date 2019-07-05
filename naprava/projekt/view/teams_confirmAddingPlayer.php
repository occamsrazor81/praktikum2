<?php require_once __DIR__.'/_header_rUSure.php'; ?>


<form  action="index.php?rt=teams/confirmAddingPlayer" method="post">

<p>Are you sure you want to add <?php echo ' <b id="addd">'.$newPlayer->name; ?></b>
  to the <?php echo ' '.$team_name; ?>?
</p>

<button class="acc" type="submit" name="yes">Yes</button>
<button class="rej" type="submit" name="no">No</button>

</form>

<script type="text/javascript">

$(document).ready(function()
{
  $("#addd").css("font-weight","600").css("color","#3CB371");

  $(".acc") .css("width", "10%")
            .css('background-color', '#3CB371')
            .css("padding", '5px')
             .css("border","none")
             .css("font-weight", "800")
             .css("letter-spacing", "1.1")
             .on("mouseenter", function(){
              $(this).css("opacity", "0.7");

             })
             .on("mouseleave", function(){
              $(this).css("opacity", "1");
            });

  $(".rej") .css("width", "10%")
            .css('background-color', '#FF6347')
            .css("padding", '5px')
            .css("border","none")
            .css("font-weight", "800")
            .css("letter-spacing", "1.1")
            .on("mouseenter", function(){
            $(this).css("opacity", "0.7");
             })
            .on("mouseleave", function(){
            $(this).css("opacity", "1");
              });
});
</script>



<?php require_once __DIR__.'/_footer.php'; ?>
