<?php //session_start(); ?>
<?php require_once __DIR__.'/_header_ulogiranog.php'; ?>

<!-- ovo promijeniti -->
<form  action="index.php?rt=leagues/findLeagueDetails" method="post">

<table>
	<tr><th>Admin</th><th>Title</th><th>Type</th><th>Status</th></tr>
	<?php
		foreach( $leagueList as $league )
		{

      echo '<tr>';

      echo '<td>'.$league['admin'].'</td>';
      echo '<td><button class="league" type="submit" name="league_id" value="'.
			$league['id'].'">'.$league['title'].'</button></td>';
      echo '<td>'.$league['league_type'].'</td>';
      echo '<td>'.$league['status'].'</td>';


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

      $(".league").css("background-color", 'gold')
                 .css("width", "100%")
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

      var reg_open = /open/;
      var reg_closed = /closed/;

      var reg_private = /private|private_paid/;
      var reg_public = /public|public_paid/;

      var tdovi = $("td");

      for(var i = 0; i < tdovi.length; ++i)
      {
      var td = tdovi.eq(i);

        if(reg_open.test(td.html()))
        td.css("color","green").css("font-weight","800");



        else if(reg_closed.test(td.html()))
        td.css("color","red").css("font-weight","800");

        else if(reg_private.test(td.html()))
        td.css("color","red").css("font-weight","800");

        else if(reg_public.test(td.html()))
        td.css("color","green").css("font-weight","800");

				else td.css("text-transform", "capitalize").css("font-weight","600");
      }



});






</script>



<?php require_once __DIR__.'/_footer.php'; ?>
