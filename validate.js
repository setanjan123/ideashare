$(document).on("submit","#loginform",function(e)
{
var data=$(this).serialize();
var request=
	   {
	     url : "login.php",
		 type : 'POST',
		 data: data,
		 dataType: "html",
		 async: false,
         success: function(data){
		 if(data!="1")
		 $.notify(data);
		 else
		 $(location).attr('href', 'home.php');
								}
	  };
$.ajax(request);
e.preventDefault();
});