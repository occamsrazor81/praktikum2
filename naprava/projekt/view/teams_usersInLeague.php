<?php require_once __DIR__.'/_header_timova.php'; ?>

<ul class="apps">

  <li class="inUL"><b> <?php echo $_SESSION['league_title'].' ('.
            $leagueUsers[0]['league_type'].')'; ?>
          </b>
        </li>

  <?php

  foreach($leagueUsers as $lUser)
  {
      $league_type = $lUser['league_type'];
      echo '<li class="inUL"><em>'.$lUser['username'].'</em></li>';
  }

    ?>


</ul>

<script type="text/javascript">

$(document).ready(function()
{
  $(".apps").css('list-style', 'none')
			.css('margin', '10px')
      .css("padding", '16px')
			.css('display', 'box')
      .css("overflow", "hidden")
      .css("border" , "1px dotted black");

      $(".inUL").css("padding","7px").css("margin","3px").css("float","none");

      $("b").css("text-transform","capitalize").css("color","green")
            .css("font-weight","900");

      $("em").css("text-transform","capitalize");
    });
</script>



<?php require_once __DIR__.'/_footer.php'; ?>
