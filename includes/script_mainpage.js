
$(window).on('load',function() {
	Pizza.init();
});

$(document).ready(function(){
	$.getJSON("data/messages.json", function(data){
		$("#messages").append("<ul id='msgList' class='msgList'>");
		$.each(data.messages, function (){
			$("#msgList").append("<li>" + this.name + "</li>");
		});
		$("#messages").append("</ul>");
		$("#messages").append("<ul id='msgTimeList' class='msgTimeList'>");
		$.each(data.messages, function (){
			$("#msgTimeList").append("<li>" + this.date +" " + this.time + "</li>");
		});					
		$("#messages").append("</ul>");
	});
});