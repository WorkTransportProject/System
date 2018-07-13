var ajaxAction = function(dataString, sendMsg){
	$.ajax({
		type: "POST",
		url: "action.php",
		data: dataString,
		cache: true,
        success: function (msg) { 
        	swal({
		  	text: sendMsg,
		  	buttons: "OK",
			});                   
        },
        error: function (msg) {
            alert("Error " + msg.d.toString());
        }
	});		
}

$(function() {
	$("#posts").submit(function() {
		var number = $("#number").val();

		if(document.activeElement.getAttribute("name") == "update"){
			var firstname = $("#firstname").val();
			var lastname = $("#lastname").val();
			var phone = $("#phone").val();
			var depart = $("#depart").val();
			var date = $("#date").val();
			var address = $("#address").val();
			var checkSMS = $("#checkSMS").is(":checked") ? '1' : '0';
			var checkTransport = $("#checkTransport").is(":checked") ? '1' : '0';
			
			var direction = $("#direction").val();
			var arriveFrom = $("#arriveFrom").val();
			var arriveTo = $("#arriveTo").val();
			var leaveFrom = $("#leaveFrom").val();
			var leaveTo = $("#leaveTo").val();
			
			var dataString = 'action=add' + '&firstname=' + firstname + '&lastname=' + lastname +'&number=' + number + '&phone=' 
								+ phone + '&depart=' + depart + '&date=' + date + '&address=' + address
								+ '&checkSMS=' + checkSMS + '&checkTransport=' + checkTransport + '&direction=' + direction
								+ '&arriveFrom=' + arriveFrom + '&arriveTo=' + arriveTo + '&leaveFrom=' + leaveFrom + '&leaveTo=' + leaveTo;
			var sendMsg = 	"!פרטי העובד נשלחו בהצלחה";	
			
			ajaxAction(dataString, sendMsg);	
		}		
		else if(document.activeElement.getAttribute("name") == "delete"){
			
			swal({   
				title: "?האם אתה בטוח",   
			  	text: "!המידע על העובד יימחק ולא יהיה נגיש",     
				dangerMode: true,
				buttons: ["לא", "כן"],
		  	}).then(result => {
				if(result) {		          
		          	var dataString = 'action=delete' + '&number=' + number;
					var sendMsg = "!עובד נמחק בהצלחה";
					
					ajaxAction(dataString, sendMsg);
		        }
	    	})
		}
		return false;
	});
})


var selectChange = function(){
	var select = $("#direction").val();
	
	switch(select){
		case "פיזור ואיסוף":
			$("#arrive").show();
			$("#arriveH").show();
			$("#leave").show();
			$("#leaveH").show();
			break;
		case "פיזור":
			$("#arrive").hide();
			$("#arriveH").hide();
			$("#leave").show();
			$("#leaveH").show();
			break;
		case "אסיפה":
			$("#arrive").show();
			$("#arriveH").show();
			$("#leave").hide();
			$("#leaveH").hide();
			break;
		case "לא זכי להסעות":
			$("#arrive").hide();
			$("#arriveH").hide();
			$("#leave").hide();
			$("#leaveH").hide();
			break;
		default:
			$("#arrive").show();
			$("#arriveH").show();
			$("#leave").show();
			$("#leaveH").show();
	}
}

$("#direction").on('load',selectChange())
$("#direction").on('change',function() {selectChange()})
