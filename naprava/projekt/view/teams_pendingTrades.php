<?php require_once __DIR__.'/_header_endDraft.php'; ?>


<hr>

<form  action="index.php?rt=teams/acceptOrRejectTrade" method="post">


<ul class="outerUL">


<?php

//zelimo imena svih mojih i svih suparnikovih igraca
foreach($allMyTrades as $trades)
{
  echo '<li class="inUL"><ul class="innerUL">';

  echo '<li class="ininUL">Recieve -> <span class="opn">'.$trades['player1_name'].'</span>';
  if($trades['id_player11'] !== null)
  echo ', <span class="opn">'.$trades['player11_name'].'</span>';
  if($trades['id_player12'] !== null)
  echo ', <span class="opn">'.$trades['player22_name'].'</span></li>';


  echo '<li class="ininUL">Give away -> <span class="mpn">'.$trades['player2_name'].'</span>';
  if($trades['id_player21'] !== null)
  echo ', <span class="mpn">'.$trades['player21_name'].'</span>';
  if($trades['id_player22'] !== null)
  echo ', <span class="mpn">'.$trades['player22_name'].'</span></li>';


  echo '<li class="ininUL"><button class="acc" type="submit" name="accept_trade_id"'.
  ' value="'.$trades['id_trade'].'">Accept Trade</button>';

  echo ' <button class="rej" type="submit" name="reject_trade_id"'.
  ' value="'.$trades['id_trade'].'">Reject Trade</button></li><br>';


  echo '</ul></li>';

}





 ?>
</ul>

</form>



<script>

$(document).ready(function(){

        $(".outerUL").css('list-style', 'upper-roman')
        			.css('margin', '10px')
              .css("padding", '16px')
        			.css('display', 'box')
              .css("overflow", "hidden")
              .css("border" , "1px dotted black");

        $(".inUL").css("padding","7px").css("margin","3px");

        $(".innerUL").css('list-style', 'square')
        			.css('margin', '10px')
              .css("padding", '16px')
        			.css('display', 'box')
              .css("overflow", "hidden")
              .css("border" , "1px dashed black");

        $(".ininUL").css("padding","7px").css("margin","3px");

        $(".acc") .css("width", "15%")
                  .css('background-color', '#3CB371')
                  .css("padding", '7px').css("margin","3px")
                   .css("border","none")
                   .css("font-weight", "800")
                   .css("letter-spacing", "1.1")
                   .on("mouseenter", function(){
                    $(this).css("opacity", "0.7");

                   })
                   .on("mouseleave", function(){
                    $(this).css("opacity", "1");
                  });
        $(".rej") .css("width", "15%")
                  .css('background-color', '#FF6347')
                  .css("padding", '7px').css("margin","3px")
                  .css("border","none")
                  .css("font-weight", "800")
                  .css("letter-spacing", "1.1")
                  .on("mouseenter", function(){
                    $(this).css("opacity", "0.7");
                             })
                  .on("mouseleave", function(){
                    $(this).css("opacity", "1");
                            });

        $(".mpn").css("color","#FF6347");
        $(".mtn").css("color","#4682B4");

        $(".opn").css("color","#3CB371");
        $(".otn").css("color","#FF00FF");

        $(".accep").css("color", "#228B22");
        $(".pend").css("color", "#9370DB");


});




</script>

<?php require_once __DIR__.'/_footer.php'; ?>
