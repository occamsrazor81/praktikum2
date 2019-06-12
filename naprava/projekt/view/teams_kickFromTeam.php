<?php require_once __DIR__.'/_header_endDraft.php'; ?>

<form  action="index.php?rt=teams/kickPlayerFromTeam" method="post">

<table>

<tr><th>Player Name</th><th>Position</th><th>Cut</th></tr>

  <?php

  foreach($myCurrentPlayers as $player)
  {
    echo '<tr>'.
    '<td>'.$player->name.'</td>'.
    '<td>'.$player->position.'</td>'.

    '<td><button class="att" type="submit" name="player_id" value="'.
    $player->id.'">'.'Kick from Team</button></td>';

    echo '</tr>';
  }


   ?>

</table>

</form>


<script>

$(document).ready(function()
{
      $("body").css("background-color", "orange");
      $("table").css("background-color", "gold")
								.css("border-collapse","collapse")
								.css("border-spacing","0")
								.css("width","100%");

      $("th").css("border", "0.7px solid black")
      			 .css("background-color", 'gold')
             .css("width", "80").css("height", "40")
             .css("text-align", "center")
             .css("margin", "0").css("padding", "16px")
             .css("text-transform", "uppercase")
             .css("letter-spacing", "1.6")
             .css("font-weight", "900")
             .css("font-style", "italic");

      $("td").css("border", "0.5px solid black")
      			 .css("background-color", 'gold')
             .css("width", "80").css("height", "40")
             .css("text-align", "center")
             .css("margin", "0").css("padding", "16px")
             .css("letter-spacing", "1.1");

      $(".att").css("background-color", 'gold')
                 .css("width", "100%")
                 .css("color","red")
								 .css("border","none")
                 .css("font-weight", "800").css("display", "table-cell")
                 .css("letter-spacing", "1.1")
                 .on("mouseenter", function(){
                  $(this).css("opacity", "0.4");

                    var td = $(this).parent();
                    td.css("opacity","0.8");
                 })
                 .on("mouseleave", function(){
                  $(this).css("opacity", "1");
                    var td = $(this).parent();
                    td.css("opacity","1");
                 });




});


</script>




<?php require_once __DIR__.'/_footer.php'; ?>
