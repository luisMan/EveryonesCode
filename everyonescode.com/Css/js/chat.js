!function()
{
	 var chatButtons = $('.Echat');
	 var chatWindow = $('.chatDiv');


     chatButtons.each(function()
     {
     	$(this).click(function(evt)
     	{    
     		  evt.preventDefault();
              chatWindow.slideToggle(1000);
     	});
     });


}();

!function(){}();