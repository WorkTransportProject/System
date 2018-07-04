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
			
			var dataString = 'action=add' + '&firstname=' + firstname + '&lastname=' + lastname +'&number=' + number + '&phone=' 
								+ phone + '&depart=' + depart + '&date=' + date + '&address=' + address
								+ '&checkSMS=' + checkSMS + '&checkTransport=' + checkTransport;
			var sendMsg = 	"פרטי העובד נשלחו בהצלחה!";		
		}		
		else if(document.activeElement.getAttribute("name") == "delete"){
			var dataString = 'action=delete' + '&number=' + number;
			var sendMsg = "עובד נמחק בהצלחה!";
		}
		
		$.ajax({
			type: "POST",
			url: "action.php",
			data: dataString,
			cache: true,
	        success: function (msg) {                    
	           alert(sendMsg);
	        },
	        error: function (msg) {
	            alert("Error " + msg.d.toString());
	        }
			});
		return false;
	});
});
