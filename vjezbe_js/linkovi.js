
$(document).ready(function()
{
  $('a.fileLink').on("mouseenter", getFileData);
  $('a.fileLink').on("mouseleave", deletePravokutnik);


});


function deletePravokutnik( e )
{
  var div = $("#pravokutnik").remove();
}

function getFileData( e )
{
  var a = $(this);
  var filename = a.prop("href");

  $.ajax({

    url: "linkovi.php",
    data:
    {
      filename: filename
    },
    dataType:"json",
    success: function(data)
    {
      var div = $("<div>")
                .html(data.filename)
                .append("<br>")
                .append("File size: " + data.size)
                .append("<br>")
                .append("Last modified: " + data.lastChange)
                .css("position", "absolute")
                .css("left", e.clientX + 30)
                .css("top", e.clientY + 30)
                .css("background-color", "red")
                .css("border", "solid 1px black")
                .prop("id", "pravokutnik")

      $("body").append(div);
    }


  });

}
