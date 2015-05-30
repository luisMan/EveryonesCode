// JavaScript Document
/*inner nav script*/
!function()
{
	$(window).scroll(function()
	{  
	    
	     if($(window).scrollTop()>$('.slide').height())
		 {
			    $(".inner-nav").show();
		 }else if($(window).scrollTop()<=$('.slide').height())
		 {
			 $(".inner-nav").hide();
		 }
		 
	});
	
	
	    var count = $('.imgs:first-child');
       var countdown = ["number/zero.png","number/one.png","number/two.png","number/three.png","number/four.png","number/five.png","number/six.png","number/seven.png","number/eight.png","number/nine.png"];
        var index=0, j=0;
		for(var i=0; i<10; i++)
		{
		   count.attr("src",countdown[0]);
		   console.log(count);
		   count = count.next();
		}
		
		count = $('.imgs:last-child');
	  var time= setInterval(function()
	   {    
	       if(index>10&&index<=11){j=0;count.prev().attr('src',countdown[1]);}
		   if(index>20&&index<=21){j=0;count.prev().attr('src',countdown[2]);}
		   if(index>30&&index<=31){j=0;count.prev().attr('src',countdown[3]);}
		   if(index>40&&index<=41){j=0;count.prev().attr('src',countdown[4]);}
		   if(index>50&&index<=51){j=0;count.prev().attr('src',countdown[5]);}
		   if(index>60&&index<=61){j=0;count.prev().attr('src',countdown[6]);}
		   if(index>70&&index<=71){j=0;count.prev().attr('src',countdown[7]);}
		   if(index>80&&index<=81){j=0;count.prev().attr('src',countdown[8]);}
		   if(index>90&&index<=91){j=0;count.prev().attr('src',countdown[9]);}
		   
		   //100
		     if(index>100&&index<=101){j=0;count.prev().prev().attr('src',countdown[1]);}
		   if(index>110&&index<=111){j=0;count.prev().attr('src',countdown[2]);}
		   if(index>120&&index<=121){j=0;count.prev().attr('src',countdown[2]);}
		   if(index>130&&index<=131){j=0;count.prev().attr('src',countdown[3]);}
		   if(index>140&&index<=141){j=0;count.prev().attr('src',countdown[4]);}
		   if(index>150&&index<=151){j=0;count.prev().attr('src',countdown[5]);}
		   if(index>160&&index<=161){j=0;count.prev().attr('src',countdown[6]);}
		   if(index>170&&index<=171){j=0;count.prev().attr('src',countdown[7]);}
		   if(index>180&&index<=181){j=0;count.prev().attr('src',countdown[8]);}
		   if(index>190&&index<=191){j=0;count.prev().attr('src',countdown[9]);}
		   
	       count.attr("src",countdown[j++]);
		   index++;
	   }, 100);
	  
	
}();

!function(){}();