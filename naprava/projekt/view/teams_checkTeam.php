<?php require_once __DIR__.'/_header_endDraft.php'; ?>

<form  action="index.php?rt=teams/askForTrade" method="post">

<br>
<!-- <table>

<tr><th>Player Name</th><th>Position</th></tr> -->

  <?php

  // foreach($playersFromSelectedTeam as $player)
  // {
  //   echo '<tr>'.
  //   '<td><button type="submit" name="player_id" value="'.
  //   $player->id.'">'.$player->name.'</button></td>'.
  //   '<td>'.$player->position.'</td>';
  //
  //   // '<td><button type="submit" name="player_id" value="'.
  //   // $player->id.'" id="'.$player->id.'">'.'Propose Trade</button></td>';
  // }
  ?>

<!-- </table> -->

  <ul class="foxy">


  <?php
  foreach($playersFromSelectedTeam as $player)
  {
    echo '<li class="inUL"><label class="cont"><input type="checkbox" name="players[]"'.
    'value="'.$player->id.'" id="'.$player->id.'">'.$player->name.
    '<span class="checkmark"></span></label></li>';
  }

  echo '<button class="acc" type="submit" name="propose" value="propose">'.'Propose Trade</button>';


   ?>

   </ul>



</form>

<script>

$(document).ready(function(){

        $(".foxy").css('list-style', 'none')
        			.css('margin', '10px')
              .css("padding", '16px')
        			.css('display', 'box')
              .css("overflow", "hidden")
              .css("border" , "1px dotted black");

        $(".inUL").css("padding","7px").css("margin","3px");

        $(".acc") .css("width", "10%")
                  .css('background-color', '#3CB371')
                  .css("padding", '7px').css("margin","3px")
                   .css("border","none")
                   .css("font-weight", "800")
                   .css("letter-spacing", "1.1")
                   .on("mouseenter", function(){
                    $(this).css("opacity", "0.7");

                   })
                   .on("mouseleave", function(){
                    $(this).css("opacity", "1");
                  });

        $(".cont").css("display","block")
                  .css("position", "relative")
                  .css("cursor", "pointer")
                  .css("font-size", "22");


});




</script>



<?php require_once __DIR__.'/_footer.php'; ?>
