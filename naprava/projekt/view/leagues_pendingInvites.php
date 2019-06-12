<?php require_once __DIR__.'/_header_ulogiranog.php'; ?>


<form  action="index.php?rt=leagues/acceptOrRejectInvitations" method="post">


<ul id="apps">


<?php

foreach($leagueInvites as $invites)
{
  echo '<div class="inUL">';
  echo '<li>Admin: <span class="admin">'.$invites['admin'].'</span> (status: <span>'.$invites['status'].'</span>)</li>'.
      '<li><h4>'.$invites['title'].'</h4></li>'.

     '<li><button class="acc" type="submit" name="id_league_accept" value="'.$invites['id_league'].'">'.
      'Accept Invitation!</button></li>'.
      '<li><button class="rej" type="submit" name="id_league_reject" value="'.$invites['id_league'].'">'.
       'Reject Invitation!</button></li>';

echo '</div>';

}


 ?>
</ul>
</form>


<script type="text/javascript">

$("#apps").css('list-style', 'none')
			.css('margin', '10px')
      .css("padding", '16px')
			.css('display', 'box')
      .css("overflow", "hidden")
      .css("border" , "1px dotted black");

$(".admin").css("text-transform","capitalize").css("color","green").css("font-weight","900");
$("h4").css("text-transform","capitalize")

$(".inUL").css("padding","10px").css("margin","6px")
          .css("border-bottom","1px solid")
          .css("border-top","1px solid");

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


           var reg_open = /open/;
           var reg_closed = /closed/;

           var spanovi = $("span");

           for(var i = 0; i < spanovi.length; ++i)
           {
             var span = spanovi.eq(i);

             if(reg_open.test(span.html()))
               span.css("color","green");

             else if (reg_closed.test(span.html()))
               span.css("color","red");


           }



</script>

<?php require_once __DIR__.'/_footer.php'; ?>
