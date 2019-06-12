<?php require_once __DIR__.'/_header_ulogiranog.php'; ?>

<ul id="apps">


<?php

foreach($leagueApps as $apps)
{
  echo '<div class="inUL">';
  echo '<li>Admin: <span class="admin">'.$apps['admin'].'</span> (status: <span>'.$apps['status'].'</span>)</li>'.
      '<li><h4>'.$apps['title'].'</h4></li>';

      if(strcmp($apps['application'],'accepted') == 0)
      echo '<li>Your application has been <span class="acc">accepted</span>.</li>';

      else
      echo '<li>Your application is  still <span class="pen">pending</span>.</li>';
echo '</div>';

}


 ?>
</ul>

<script>
$("#apps").css('list-style', 'none')
			.css('margin', '10px')
      .css("padding", '16px')
			.css('display', 'box')
      .css("overflow", "hidden")
      .css("border" , "1px dotted black");

$(".admin").css("text-transform","capitalize").css("color","green").css("font-weight","900");
$(".acc").css("color","green");
$(".pen").css("color","blue");
$("h4").css("text-transform","capitalize").css("font-weight","900");

$(".inUL").css("padding","10px").css("margin","6px")
          .css("border-bottom","1px solid")
          .css("border-top","1px solid");

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
