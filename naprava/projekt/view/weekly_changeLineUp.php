<?php require_once __DIR__.'/_header_weekly.php'; ?>
<div id="days"><?php
foreach ($days as $day)
{
  echo '<span>'.$day.'</span>';
} ?>
</div>
<table id="starteri">

    <tr><th>Name</th><th>Position</th></tr>

  <?php


    foreach($myStarters as $starter)
    {
      echo '<tr><td class=day>'.$starter->name.'</td>';
      echo '<td>'.$starter->position.'</td></tr>';

    }
    ?>
  </table>
<br>
  <table id="bench">
    <tr><th>Bench Players</th><th>Position</th></tr>


    <?php

    foreach ($myBench as $bench)
    {
      echo '<tr><td class=day>'.$bench->name.'</td>';
      echo '<td>'.$bench->position.'</td></tr>';

    }

   ?>



</table>
<br>
<button type="submit" id="saveChanges">Save Changes</button>

<script>

$(document).ready(function()
{
    uredi();


  $("body").on("click", "td", pushIn);
  $("body").on("click","#saveChanges", save);
//  $("body").on("click", "#starteri td", pushOut);

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

///dodati spremanje postave negdje(valjda u bazu podataka)


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


    var playersLen = $(".day").length;


    var p = $("#days span").length;
    //var div = $()

    for(var i = 0; i < playersLen; ++i)
    {
      var curr1 = $(".day").eq(i).html();

      var td = $(".day").eq(i);

      for(var j = 0; j < p; ++j)
      {
        var curr2 = $("#days span").eq(j).html();

        if(curr1 == curr2)
        td.html(curr1 + "<br><br>" + "(has game today)");

      }

    }

    $("#days").html("");

  }

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


function Player(name,pos)
{
  this.name = name;
  this.pos = pos;
}


function save( event )
{
  	var starteri = $("#starteri td");

    var allStarters = [];
    for(var i = 0; i < starteri.length; ++i)
    {
    	if(i%2) continue;
    	var starter = starteri.eq(i);
        var pos = starteri.eq(i+1);

        var player = new Player(starter.html(),pos.html());

        allStarters.push(player);

    }

    var bench = $("#bench td");
    var benchPlayers = [];

     for(var i = 0; i < bench.length; ++i)
    {
    	if(i%2) continue;
    	var bencher = bench.eq(i);
        var pos = bench.eq(i+1);

        var player = new Player(bencher.html(),pos.html());

        benchPlayers.push(player);

    }



    //console.log(allStarters);
    //console.log(benchPlayers);

    //trebamo u tablici_project_teams status igraca(starter ili bench)
    // koristimo ajax, koristimo tablicu prokject_teams
    // treba promijeniti ulaz takoder
    // ne primamo myPlayers vec myStarters i myBench

    $.ajax(
    {
    	url: "index.php?rt=games/saveLineUp",
        data:
        {

          starterPlayers: allStarters,
          benchPlayers: benchPlayers
          // u php-u update tablice project_teams
        },
        method: "POST",
        dataType:"json",
        success: function(data)
        {
        	console.log("lineup successfully saved");
            crtajTablicu(data);
        },
        error: function(xhr,status)
        {
          console.log("error occured :: " + status);
        }
    });


    //crtajTablicu(allStarters,benchPlayers);
    // ovo treba biti u ajaxu
  }

  function crtajTablicu( data )
  {

    $("#bench").html("");
    $("#starteri").html("");


    var trBench = $("<tr></tr>");
    var trStarter = $("<tr></tr>");
    var thBenchPlayers = $("<th></th>");
    var thBenchPos = $("<th></th>");
    var thStarters = $("<th></th>");
    var thStarterPos = $("<th></th>");

    thBenchPlayers.html("Bench Players");
    thBenchPos.html("Position");
    thStarters.html("Name");
    thStarterPos.html("Position");

    trStarter.append(thStarters);
    trStarter.append(thStarterPos);
    trBench.append(thBenchPlayers);
    trBench.append(thBenchPos);

    $("#starteri").append(trStarter);
    $("#bench").append(trBench);

    for(var i = 0; i < data.starterPlayers.length; ++i)
    {
      var tr = $("<tr></tr>");
      var tdPlayer = $("<td></td>");
      var tdPos = $("<td></td>");

      tdPlayer.html(data.starterPlayers[i].name);
      tdPos.html(data.starterPlayers[i].pos);
      tr.append(tdPlayer);
      tr.append(tdPos);

      $("#starteri").append(tr);
    }


    for(var i = 0; i < data.benchPlayers.length; ++i)
    {
      var tr = $("<tr></tr>");
      var tdPlayer = $("<td></td>");
      var tdPos = $("<td></td>");

      tdPlayer.html(data.benchPlayers[i].name);
      tdPos.html(data.benchPlayers[i].pos);
      tr.append(tdPlayer);
      tr.append(tdPos);

      $("#bench").append(tr);
    }

    uredi();



  }












</script>


<?php require_once __DIR__.'/_footer.php'; ?>
