<?php require_once __DIR__.'/_header_endDraft.php'; ?>

<form  action="index.php?rt=teams/checkTeam" method="post">

<br>
<table>

<tr><th>Username</th><th>Team Name</th></tr>

  <?php

  foreach($otherTeams as $teams)
  {
    echo '<tr>'.
    '<td>'.$teams['username'].'</td>'.
    '<td><button class="propose" type="submit" name="team_id" '.
    'value="'.$teams['id'].'">'.
    $teams['team_name'].'</button></td>'.

    '<tr>';
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
             .css("text-transform","capitalize")
             .css("font-weight","600")
             .css("margin", "0").css("padding", "16px")
             .css("letter-spacing", "1.1");

      $(".propose").css("background-color", 'gold')
                 .css("width", "100%")
                 .css("color","blue")
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
