<?php require_once __DIR__.'/_header_ulogiranog.php'; ?>

<hr>
<form  action="index.php?rt=leagues/createNewLeague" method="post">

<span>League title:</span><br> <input type="text" name="leagueName" placeholder="Enter League Name" >
<br>
<span>Target league members:</span><br> <input type="number" name="leagueNumber" placeholder="How many members do you want?">
<br>
<span>League type:</span>
<select  name="leagueSelect" id="selectNew">
  <option value="public">Public</option>
  <option value="private">Private</option>
  <option value="public_paid">Public Paid</option>
  <option value="private_paid">Private Paid</option>

</select>
<hr>

<input type="submit" name="create" value="Create League" id="cr">

</form>

<script>
$(document).ready(function()
{
      $("body").css("background-color", "orange");
      $("span").css("font-weight","700").css("word-spacing","5px");
      $("input").width("100%").css("padding","8px").css("margin","5px");
      $(".container").css("padding", "16px");
      $("#selectNew").css("width", "20%")
      .on("mouseover", function(){

            var n = $(this).children().length;
            $(this).children().slideDown("slow", this.size=n);


                     })
                     .on("mouseout", function(){
            (this).size = 1;
            });

      $("option").css("text-align","left");

     $("#cr").css("font-weight","700").css("background-color", "green").css("width","20%")
     .css("margin","5px");

     $("#cr").css('background', '#4CAF50')
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
