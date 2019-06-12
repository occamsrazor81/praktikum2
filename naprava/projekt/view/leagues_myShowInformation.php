<?php //session_start(); ?>
<?php require_once __DIR__.'/_header_ulogiranog.php'; ?>



<form  action="index.php?rt=leagues/inviteSomeone" method="post">

<ul class="apps">
	<?php

			 echo '<li class="inUL">Admin: <b>'.$leagueInformationList['admin'].'</b></li>'.
					'<li class="inUL">Title: <b>'.$leagueInformationList['title'].'</b></li>';
					//'<li><p>Description: <br>'.$projectDescriptionList['description'].'</p></li>';

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




				// if((count($leagueInformationList['members']) + 1 < (int)$leagueInformationList['targetSize'])
				// && strcmp($_SESSION['name'],$leagueInformationList['admin']) != 0 && $provjera == 0 &&
				// $leagueInformationList['status'] != 'closed')
				// echo '<li><button type="submit" name="id_league_apply" value="'.$leagueInformationList['id_league'].'">'.
				// 'Apply for this league!</button></li>';

				if(strcmp($leagueInformationList['status'],'closed') !== 0 &&
				strcmp($_SESSION['name'], $leagueInformationList['admin']) === 0)
        echo '<li class="inUL">Send invitation to: '.
        '<input type="text" name="invite_name" >'.
        '<button class="acc" type="submit" name="id_league_invite" value="'.$leagueInformationList['id_league'].'">'.
        'Invite</button> </li>';


				if(strcmp($_SESSION['name'],$leagueInformationList['admin']) !== 0
				&&  strcmp($leagueInformationList['status'], 'closed') !== 0)
				echo '<li class="inUL"><button class="rej" type="submit" name="id_league_exit" value="'.
				$leagueInformationList['id_league'].'">'.
				'Leave league!</button></li>';

				if(strcmp($leagueInformationList['status'],'closed') === 0)
				echo '<li><button class="lp" type="submit" name="id_league_start_draft" value="'.
				$leagueInformationList['id_league'].'">'.
				'League Page!</button></li>';






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

$(".rej") .css("width", "10%")
					.css('background-color', '#FF6347')
					.css("border","none")
					.css("padding", '5px')
					.css("font-weight", "800")
					.css("letter-spacing", "1.1")
					.on("mouseenter", function(){
						$(this).css("opacity", "0.7");
					           })
					.on("mouseleave", function(){
						$(this).css("opacity", "1");
					            });

$(".lp") .css("width", "100%")
					.css('background-color', '#3CB371')
					.css("padding", '16px')
					.css("border","none")
					.css("font-weight", "900")
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
