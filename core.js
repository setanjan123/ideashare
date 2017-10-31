function pull_feed()
{
$('.feed').text('');
var request=
	   {
	     url : "feed.php",
		 type : 'POST',
		 data: '',
		 dataType: "html",
		 async: false,
         success: function(data){
		 $('.feed').append(data);
	     }
        };
       	$.ajax(request);
}

function view_post(id)
{
$('.feed').text('');
var request=
	   {
	     url : "view-post.php",
		 type : 'POST',
		 data: {pid: id},
		 dataType: "html",
		 async: false,
		 success: function(data){
		 $('.feed').append(data);
	     }
        };
       	$.ajax(request);
}

function update_notif()
{ 
var request=
	   {
	     url : "update-notif.php",
		 type : 'POST',
		 data: '',
		 dataType: "html",
		 async: false,
         success: function(data){
		 $('.notbox').prepend(data);
		 if(data!="")
		 {
		 $('.nbutton').css('background-color','#4F8A10');
		 $.notify("You have a notification","success");
		 }
        }
		};
       	$.ajax(request);

}

function load_notif()
{ 
var request=
	   {
	     url : "load-notif.php",
		 type : 'POST',
		 data: '',
		 dataType: "html",
		 async: false,
         success: function(data){
		 $('.notbox').append(data);
		 }
        };
       	$.ajax(request);

}

$(document).ready(function() {
pull_feed();
load_notif();
update_notif();
setInterval(update_notif, 30000);

$('#post').click(function() {
if ($.trim($('#txtbox').val())!="") {
   var message = $('#txtbox').val();
   var request=
	   {
	     url : "post.php",
		 type : 'POST',
		 data: 'post='+message,
		 dataType: "html",
		 async: false,
         success: function(msg){
		 $('#txtbox').val('');
	     }
        };
       	$.ajax(request);
		pull_feed();
}
else
{
 $(this).notify(
  "Post cannot be empty",
  { position:"right" }
);
}
});
});



$(document).on('click','.comm,.comm2', {} ,function comment()
{
var text=$(this).parent().find('input[type="text"]').val();
if (text!="") {
var id= $(this).parent().find('input[type="hidden"]').val();
var request=
	   {
	     url : "comment.php",
		 type : 'POST',
		 data: {pid: id, comment: text},
		 dataType: "html",
		 async: false
        };
       	$.ajax(request);
		if($(this).is('.comm'))
		pull_feed();
        else
        view_post(id);
		}
else
$(this).notify(
  "Comment cant be empty",
  { position:"top" }
);
});

$(document).on('click','.like,.like2', {} ,function()
{
var id=$(this).parent().find('input[type="hidden"]').val();
var request=
	   {
	     url : "like.php",
		 type : 'POST',
		 data: {pid: id},
		 dataType: "html",
		 async: false
	     };
       	$.ajax(request);
        if($(this).is('.like'))
		pull_feed();
        else
        view_post(id);

});


$(document).on('click','.unlike,.unlike2', {} ,function()
{
var id=$(this).parent().find('input[type="hidden"]').val();
var request=
	   {
	     url : "unlike.php",
		 type : 'POST',
		 data: {pid: id},
		 dataType: "html",
		 async: false
	     };
       	$.ajax(request);
		if($(this).is('.unlike'))
		pull_feed();
        else
        view_post(id);
});

$(document).on('input','#sbar', {} ,function()
{
var search=$(this).val();
var request=
	   {
	     url : "search.php",
		 type : 'POST',
		 data: {search: search},
		 dataType: "html",
		 async: true,
		 success: function(result){
		 $('#sbox').text("");
		 $('#sbox').append(result);
	     }
        };
       	$.ajax(request);
});

$(document).on('click','.nbutton',{},function()
{
$('.nbutton').css('background-color','#222');
if ($('.notbox').is(':visible'))
$('.notbox').hide();
else
$('.notbox').show();
});


$(document).on('click','.notbox p',function()
{
$('.notbox').hide();
var toggle = $(".navbar-toggle").is(":visible");
if (toggle)
$(".navbar-collapse").collapse('hide');     
var id=$(this).parent().attr("class");
view_post(id);

});

$(document).on('click','.delpost',function()
{
var id=$(this).parent().attr("id");

var request=
	   {
	     url : "delete-post.php",
		 type : 'POST',
		 data: {pid: id},
		 dataType: "html",
		 async: false,
		 success: function(){
		 pull_feed();
	     }
        };
       	$.ajax(request);

});

$(document).on('click','.followpost',function()
{
var id=$(this).parent().attr("id");

var request=
	   {
	     url : "follow-post.php",
		 type : 'POST',
		 data: {pid: id},
		 dataType: "html",
		 async: false,
		 success: function(){
		 pull_feed();
	     }
        };
       	$.ajax(request);

});

$(document).on('click','.followpost2',function()
{
var id=$(this).parent().attr("id");

var request=
	   {
	     url : "follow-post.php",
		 type : 'POST',
		 data: {pid: id},
		 dataType: "html",
		 async: false,
		 success: function(){
         view_post(id);
	     }
        };
       	$.ajax(request);

});

$(document).on('click','.unfollowpost',function()
{
var id=$(this).parent().attr("id");

var request=
	   {
	     url : "unfollow-post.php",
		 type : 'POST',
		 data: {pid: id},
		 dataType: "html",
		 async: false,
		 success: function(){
		 pull_feed();
	     }
        };
       	$.ajax(request);

});


$(document).on('click','.unfollowpost2',function()
{
var id=$(this).parent().attr("id");

var request=
	   {
	     url : "unfollow-post.php",
		 type : 'POST',
		 data: {pid: id},
		 dataType: "html",
		 async: false,
		 success: function(){
         view_post(id);
	     }
        };
       	$.ajax(request);

});


$(document).on('click','.delcomm',function()
{
var id=$(this).parent().attr("id");
var pid=$(this).parent().parent().attr("id");
var request=
	   {
	     url : "delete-comment.php",
		 type : 'POST',
		 data: {cid: id},
		 dataType: "html",
		 async: false,
		 success: function(){
		 pull_feed();
	     }
        };
       	$.ajax(request);

});

$(document).on('click','.delcomm2',function()
{
var id=$(this).parent().attr("id");
var pid=$(this).parent().parent().attr("id");
var request=
	   {
	     url : "delete-comment.php",
		 type : 'POST',
		 data: {cid: id},
		 dataType: "html",
		 async: false,
		 success: function(){
         view_post(pid);
	     }
        };
       	$.ajax(request);

});




