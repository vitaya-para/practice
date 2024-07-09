$(document).ready(function(){
	$('.header div.navigation').click(function(){
		if($(this).hasClass('active')){
			$(this).removeClass('active');
		}
		else{
			$(this).addClass('active');
		}
	})
})