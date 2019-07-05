<?php require_once __DIR__.'/_header_weekly.php'; ?>

<table id="starteri">

    <tr><th>Name</th><th>Position</th></tr>

  <?php

    $cnt = 0;
    foreach($myPlayers as $player)
    {
      echo '<tr><td>'.$player->name.'</td>';
      echo '<td>'.$player->position.'</td></tr>';
      $cnt++;

      if($cnt === 5)
      {
        echo '</table><br><table id="bench"><th>Bench players</th><th>Position</th>';
      }

    }

   ?>



</table>
<br>
<button type="submit" id="saveChanges">Save Changes</button>

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

      $("#saveChanges").css("width", "100%")
                .css('background-color', '#3CB371')
                .css("padding", '20px').css("margin","6px")
                 .css("border","none")
                 .css("font-weight", "800")
                 .css("letter-spacing", "1.1")
                 .on("mouseenter", function(){
                  $(this).css("opacity", "0.7");

                 })
                 .on("mouseleave", function(){
                  $(this).css("opacity", "1");
                });
                
//dodati spremanje postave negdje(valjda u bazu podataka)


      $("#bench td").css("border", "0.5px solid black")
      			        .css("background-color", '#9370DB')
                    .css("width", "80").css("height", "40")
                    .css("text-align", "center")
                    .css("margin", "0").css("padding", "16px")
                    .css("letter-spacing", "1.1");


    $("#bench th").css("border", "0.7px solid black")
           .css("background-color", '#9370DB')
           .css("width", "80").css("height", "40")
           .css("text-align", "center")
           .css("margin", "0").css("padding", "16px")
           .css("text-transform", "uppercase")
           .css("letter-spacing", "1.6")
           .css("font-weight", "900")
           .css("font-style", "italic");


  $("body").on("click", "td", pushIn);
//  $("body").on("click", "#starteri td", pushOut);

});

  var prvi = null;
  var prviPos = null;

  function pushIn(event)
  {

    if(prvi === null)
    {

      //$(this).css("background-color", "#228B22");
      prvi = $(this);
      prviPos = $(this).next("#bench td");
      console.log(prviPos.html());

      if(prviPos.html() == undefined)
      {
        //$(this).css("background-color", "#9370DB");
        prvi = null;
        prviPos = null;

      }

    }

    else
    {
      var tmp = prvi.html();
      var tmpPos = prviPos.html();

      var novo = $(this).html();
      var novoPos = $(this).next("td");

      if(novoPos == undefined)
      {
        //prvi.css("background-color", "#9370DB");
        prvi = null;
        prviPos = null;
      }

      else
      {

        //prvi.css("background-color", "#9370DB");
        prvi.html(novo);
        prviPos.html(novoPos.html());

        $(this).html(tmp);
        novoPos.html(tmpPos);

        prvi = null;
        prviPos = null;

      }

    }


  }

  // function pushIn(event)
  // {
  //   //console.log("klik");
  //   $(this).css("background-color", "#228B22");
  //
  //   var pos1 = $(this).next("#bench td");
  //
  //   // $("body").on("click", "#starteri td", pushIn);
  //
  //   // console.log($(this).next("#bench td").html());
  //
  //   if(pos1 != undefined)
  //   {
  //     var pressed = $(this);
  //
  //     $("body").on("click", "#starteri td", function(event)
  //     {
  //       // pressed.css("background-color","gold");
  //       // $(this).css("background-color","#9370DB");
  //       var tmp = pressed.html();
  //       var tmpPos = pos1.html();
  //
  //       var novo = $(this).html();
  //       var novoPos = $(this).next("#starteri td");
  //
  //       console.log(novoPos.html());
  //
  //       if(novoPos != undefined)
  //       {
  //         //console.log(novoPos);
  //
  //         pressed.html(novo);
  //         $(this).html(tmp);
  //
  //         pos1.html(novoPos.html());
  //         novoPos.html(tmpPos)
  //
  //
  //
  //         novo = "";
  //         tmp = "";
  //         novoPos = "";
  //         tmpPos = "";
  //
  //         pressed.css("background-color","#9370DB");
  //       }
  //
  //       else
  //       {
  //         pressed.css("background-color", "#9370DB");
  //       }
  //
  //
  //     });
  // }
  //
  // else
  // {
  //
  //   $(this).css("background-color", "#9370DB");
  //
  // }
  //
  // }




</script>


<?php require_once __DIR__.'/_footer.php'; ?>
