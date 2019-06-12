<?php //session_start(); ?>
<?php require_once __DIR__.'/_header_ulogiranog.php'; ?>


<ul class="apps">
<form  action="index.php?rt=leagues/applyForLeague" method="post">


	<?php

			 echo '<li class="inUL">Admin: <b>'.$leagueInformationList['admin'].'</b></li>'.
					'<li class="inUL">Title: <b>'.$leagueInformationList['title'].'</b></li>';


				echo '<li class="inUL">( ';

			$provjera = 0;
			$cnt = 1;
			foreach ($leagueInformationList['members'] as $members)
			{
				if($cnt < count($leagueInformationList['members']))
				echo '<b>'.$members.'</b>, ';

				else echo '<b>'.$members.'</b>';
				$cnt++;

				if(strcmp($members, $_SESSION['name']) == 0)
					$provjera = 1;


			}

				echo ') -> target team size: '.$leagueInformationList['targetSize'];
				echo '</li>';

				// echo '<br>';

				//$nm = count($leagueInformationList['members']) + 1;
				//echo '<li>'.$nm .'</li>';

				//treba dodat i da nije member vec
				if((count($leagueInformationList['members']) + 1 < (int)$leagueInformationList['targetSize'])
				&& $_SESSION['name'] != $leagueInformationList['admin'] && $provjera == 0 &&
				$leagueInformationList['status'] != 'closed')
				{
					if(strcmp($leagueInformationList['league_type'], 'private') === 0
					|| strcmp($leagueInformationList['league_type'], 'paid_private') === 0)
						echo '<li class="inUL"><button class="acc" type="submit" name="id_league_apply" value="'.
						$leagueInformationList['id_league'].'">'.
						'Apply for this league!</button></li>';

					elseif (strcmp($leagueInformationList['league_type'], 'public') === 0
					|| strcmp($leagueInformationList['league_type'], 'paid_public') === 0)
						echo '<li class="inUL"><button class="acc" type="submit" name="id_league_enter" value="'.
						$leagueInformationList['id_league'].'">'.
						'Enter this league!</button></li>';

				}





	?>

</ul>
</form>

<script>

$(".apps").css('list-style', 'none')
			.css('margin', '10px')
      .css("padding", '16px')
			.css('display', 'box')
      .css("overflow", "hidden")
      .css("border" , "1px dotted black");

$(".inUL").css("padding","7px").css("margin","3px");
$("#admin").css("text-transform","capitalize").css("color","green").css("font-weight","900");
$("#title").css("text-transform","capitalize").css("color","green").css("font-weight","900");
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

$("b").css("text-transform","capitalize").css("color","green").css("font-weight","900");






</script>

<?php require_once __DIR__.'/_footer.php'; ?>
