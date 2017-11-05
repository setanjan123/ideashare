$(document).on("submit","#register",function(e)
{
var data= new FormData(this);
var request=
	   {
	     url : "register.php",
		 type : 'POST',
		 data: data,
		 processData: false,
         contentType: false,
		 dataType: "html",
		 async: false,
         success: function(data){
		 if(data!="1")
		 $.notify(data);
		 else
		 {
		 $('#register').trigger("reset");
		 $.notify("New account created successfully. Please Verify your mail before logging in.","success");
		 }
								}
	  };
$.ajax(request);
e.preventDefault();
});