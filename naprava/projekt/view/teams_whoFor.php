<?php require_once __DIR__.'/_header_endDraft.php'; ?>

<form  action="index.php?rt=teams/confirmTradeRequest" method="post">

<br>
<!-- <table>

<tr><th>Player Name</th><th>Position</th></tr> -->

  <?php

  // foreach($myPlayers as $player)
  // {
  //   echo '<tr>'.
  //   '<td><button type="submit" name="player_id" value="'.
  //   $player->id.'">'.$player->name.'</button></td>'.
  //   '<td>'.$player->position.'</td>';
  //
  //   // '<td><button type="submit" name="player_id" value="'.
  //   // $player->id.'" id="'.$player->id.'">'.'Cut from Team</button></td>';
  //
  //   echo '</tr>';
  // }


   ?>


<!-- </table> -->

<ul class="foxy">


<?php
foreach($myPlayers as $player)
{
  echo '<li class="inUL"><input type="checkbox" name="myplayers[]"'.
  'value="'.$player->id.'" id="'.$player->id.'">'.$player->name.'</li>';

}

echo '<button class="acc" type="submit" name="cofirm" value="confirm">'.'Confirm Trade Request</button> ';
echo '<button class="rej" type="submit" name="cancel">Cancel Trade</button>';

 ?>

 </ul>

<br>
<!-- <button type="submit" name="cancel">Cancel Trade</button> -->


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

        $(".rej") .css("width", "20%")
                  .css('background-color', '#FF6347')
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

        $(".acc") .css("width", "20%")
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
