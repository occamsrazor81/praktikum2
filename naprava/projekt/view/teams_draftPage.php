<?php require_once __DIR__.'/_header_timova.php'; ?>
<!-- <meta http-equiv="refresh" content="10" /> -->
<p>Na redu: <span id="nr"><?php if(isset($_SESSION['na_redu'])) echo $_SESSION['na_redu']; ?></span></p>


<!-- <form  action="index.php?rt=teams/processDraft" method="post"> -->


<table id="draftTable">

<tr><th>Player Name</th><th>Position</th><th>Pick</th></tr>

  <?php

  if(strcmp($_SESSION['na_redu'], $_SESSION['name']) === 0)
  foreach($players as $player)
  {
    echo '<tr>'.
    '<td class="name">'.$player->name.'</td>'.
    '<td>'.$player->position.'</td>'.

    '<td><button class="pick" type="submit" name="player_id" value="'.
    $player->id.'" id="'.$player->name.'">'.'Select</button></td>';
  }

  else
  foreach($players as $player)
  {
    echo '<tr>'.
    '<td class="name">'.$player->name.'</td>'.
    '<td>'.$player->position.'</td>'.

    '<td><button class="notpick" type="submit" name="player_id" value="'.
    $player->id.'" id="'.$player->id.'" disabled>'.'Select</button></td>';
  }


   ?>

</table>

<!-- </form> -->


<script>

$(document).ready(function()
{

    uredi();
    $("body").on("click", ".pick", pickPlayer);


    //if($("#nr").html() != $("#nick").html())
    wait4Draft(0);


});

function uredi()
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

  $(".pick").css("background-color", 'gold')
             .css("width", "100%")
             .css("color", "#20B2AA")
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



  $(".notpick").css("background-color", 'gold')
               .css("width", "100%")
               .css("color", "#800000")
               .css("border","none")
               .css("font-weight", "800").css("display", "table-cell")
               .css("letter-spacing", "1.1")
               .on("mouseenter", function(){
               $(this).css("opacity", "1")
                 .css("background-color", '#FFFAFA');

                 var td = $(this).parent();
                 td.css("opacity","1")
                   .css("background-color", '#FFFAFA');
               })

               .on("mouseleave", function(){
               $(this).css("opacity", "1").css("background-color", '#FFFAFA');
                 var td = $(this).parent();
                 td.css("opacity","1").css("background-color", '#FFFAFA');
                 });

   $("#nr").css("font-weight", "600")
            .css('font-family', 'Droid serif')
            .css('text-transform', 'capitalize')
            .css("letter-spacing", "1.1px")
            .css("position", "relative");

}


function pickPlayer( e )
{
  //console.log("2");
  var btn = $(this);
  var player_id = btn.prop("value");


  // $(this).prop('disabled', true);
  // $(this).css("background-color", 'gold')
  //              .css("width", "100%")
  //              .css("color", "#800000")
  //              .css("border","none")
  //              .css("font-weight", "800").css("display", "table-cell")
  //              .css("letter-spacing", "1.1")
  //
  //              .on("mouseenter", function(){
  //               $(this).css("opacity", "1")
  //                      .css("background-color", '#FFFAFA');
  //
  //                 var td = $(this).parent();
  //                 td.css("opacity","1")
  //                   .css("background-color", '#FFFAFA');
  //              })
  //
  //              .on("mouseleave", function(){
  //               $(this).css("opacity", "1").css("background-color", '#FFFAFA');
  //                 var td = $(this).parent();
  //                 td.css("opacity","1").css("background-color", '#FFFAFA');
  //                 });
  //
  // $(this).removeClass("pick").addClass("notpick");

  $.ajax({
    url: "index.php?rt=teams/processDraft",
    data:
    {
      player_id: player_id
    },
    method: "POST",
    dataType:"json",
    success: function(data)
    {
      var player_id = data.player_id;
      // console.log(data.player_id);
      // console.log(data.na_redu);
      //console.log(data.error);
      //console.log("uslo");

      $("#nr").html(data.na_redu);
      //location.reload();

      //unavailable.push(data.novi);
      //console.log('#' + data.player_id);


      btn.prop('disabled', true);
      btn.css("background-color", 'gold')
                  .css("width", "100%")
                  .css("color", "#800000")
                  .css("border","none")
                  .css("font-weight", "800").css("display", "table-cell")
                  .css("letter-spacing", "1.1")

                  .on("mouseenter", function(){
                  btn.css("opacity", "1")
                    .css("background-color", '#FFFAFA');

                    var td = btn.parent();
                    td.css("opacity","1")
                      .css("background-color", '#FFFAFA');
                  })

                  .on("mouseleave", function(){
                  btn.css("opacity", "1").css("background-color", '#FFFAFA');
                    var td = btn.parent();
                    td.css("opacity","1").css("background-color", '#FFFAFA');
                    });

      //btn.removeClass("pick").addClass("notpick");



    },
    error: function(xhr,status)
    {
         console.log("pickPlayer :: Status: " + status);

    }


  });
}

/////////////////////////////////////////////////
//
function wait4Draft(lastAccess)
{
  console.log("wait your turn");
  console.log("lastAccess = " + lastAccess);

  $.ajax(
    {
      url: "index.php?rt=teams/waitDraft",
      data:
      {
        lastAccess: lastAccess
      },
      method: "POST",
      dataType:"json",
      success: function( data )
      {
        console.log("uspjeh");

        if( typeof(data.error) !== 'undefined')
        {
          console.log( "wait4draft :: success :: server javio grešku " + data.error );
          wait4Draft(lastAccess);
        }

        else
        {


          //console.log(data.allSelected.length);
          //  console.log(data.lastAccess);
          //tablica iznad
          // for(var i = 0; i < data.allSelected.length; ++i)
          // {
          //    console.log(data.allSelected[i]['name']);
          // }

          osvjeziTablicu(data);
          wait4Draft(data.lastAccess);

        }
      },
      error: function(xhr, status)
      {
        console.log( "wait4Draft :: error :: status = " + status );
            // Nešto je pošlo po krivu...
            // Ako se dogodio timeout, tj. server nije ništa poslao u zadnjih XY sekundi,
            // pozovi ponovno cekajPoruku.
             if( status === "timeout" )
                wait4Draft(lastAccess);
      }




    });
}

function osvjeziTablicu(data)
{
  var tdovi = $("#draftTable .name");


  for(var i = 0; i < data.allSelected.length; ++i)
  {
    for(var j = 0; j < tdovi.length; ++j)
    {
      var td = $("#draftTable .name").eq(j);

      if(data.allSelected[i].name === td.html())
      {
        var targetTD = td.next("td").next("td");
        targetTD.css("background-color", "#FFFAFA");

        var btns = targetTD.children();
        for(var k = 0; k < btns.length; ++k)
        {
          var btn = btns.eq(k);
          btn.css("background-color", "#FFFAFA")
             .css("color", "#800000");

          btn.prop("disabled", true);
        }


      }

    }

  }

  $("#nr").html(data.na_redu);

}


</script>


<?php require_once __DIR__.'/_footer.php'; ?>
