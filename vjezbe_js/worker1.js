var name = null;

sendMsg = function()
{
  var msg =
  {
    name: name,
    x: Math.floor(Math.random() * 600),
    y: Math.floor(Math.random() * 600),
    kut: 2*Math.PI * Math.random()

  };

  postMessage(msg);

  var sleep = 1000 * (1 + Math.random() * 3);
  setTimeout(sendMsg, sleep);

}


onmessage = function(e)
{

  var name = e.data;

  var sleep = 1000 * (1 + Math.random() * 3);
  setTimeout(sendMsg, sleep);

}
