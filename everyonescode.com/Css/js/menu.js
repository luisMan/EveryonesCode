var Menu = function(id){return document.getElementById(id);}




var doSomething = function()
{

     var menu = Menu('menuBox');
     if(menu.style.display == "block")
      {
        console.log("true section");
        menu.style.display = "none";
         
      }else
      {
        console.log("false section");
         menu.style.display = "block";
      }   
}

var showFeeds = function()
{
  
   var feed = Menu('feed-post');
   console.log(feed);
     if(feed.style.display == "block")
      {
        console.log("true section");
        feed.style.display = "none";
         
      }else
      {
        console.log("false section");
         feed.style.display = "block";
      }   
}

Menu('feeds').onclick = showFeeds;

Menu('Settings').onclick = doSomething;

