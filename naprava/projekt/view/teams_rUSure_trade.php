<?php require_once __DIR__.'/_header_rUSure.php'; ?>


<form  action="index.php?rt=teams/sendTradeRequest" method="post">


  <p>Are you sure you want to trade
    <?php
    $cnt1 = 1;
    foreach($myPlayers as $myPlayer)
    {
      echo ' <span class="myy">'.$myPlayer->name.'</span>';
      if($cnt1 < $_SESSION['trade_count']) echo ',';
      $cnt1++;
    }
    ?>
  for
  <?php
  $cnt2 = 1;
  foreach($otherPlayers as $otherPlayer)
  {
    echo ' <span class="theirr">'.$otherPlayer->name.'</span>';
    if($cnt2 < $_SESSION['my_trade_count']) echo ',';
    $cnt2++;
  }
   ?>


  <?php
  // echo ' '.$otherPlayer->name.' ';
  ?>
  ?
</p>

<button class="acc" type="submit" name="yes">Yes</button>
<button class="rej" type="submit" name="no">No</button>

</form>


<script type="text/javascript">

$(document).ready(function()
{
  $(".myy").css("font-weight","600").css("color","#FF6347");
  $(".theirr").css("font-weight","600").css("color","#3CB371");

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
