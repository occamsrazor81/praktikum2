<?php require_once __DIR__.'/_header_endDraft.php'; ?>

<hr>
<form  action="index.php?rt=teams/changeTeamNameResults" method="post">

<span>New team name:</span> <br><input type="text" name="team_name" placeholder="Choose new name">
<br>

<input type="submit" name="change" value="Apply changes" id="ac">

</form>


<script>
$(document).ready(function()
{
      $("body").css("background-color", "orange");
      $("span").css("font-weight","700").css("word-spacing","5px");
      $("input").width("83%").css("padding","8px").css("margin","5px");


     $("#ac").css("font-weight","700").css("width","20%")
     .css("margin","5px");

     $("#ac").css('background', '#4CAF50')
   	.css('color', '#000')
   	.css('padding', '14px 20px')
   	.css('margin', '8px 0')
   	.css('border', 'none')
   	.css('cursor', 'pointer')
   	.css('width', '10%')
   	.css('position', 'relative')
   	.mouseenter(function(){
   	$(this).css('opacity', '0.7');
   	})
   	.mouseleave(function(){
   	$(this).css('opacity', '1.0');
   	});


});
</script>
<?php require_once __DIR__.'/_footer.php'; ?>
