$(function() {
	$("#posts").submit(function() {
		var firstname = $("#firstname").val();
		var lastname = $("#lastname").val();
		var number = $("#number").val();
		var phone = $("#phone").val();
		var depart = $("#depart").val();
		var date = $("#date").val();
		var address = $("#address").val();
		var checkSMS = $("#checkSMS").is(":checked") ? '1' : '0';
		var checkTransport = $("#checkTransport").is(":checked") ? '1' : '0';
		var dataString = 'firstname=' + firstname + '&lastname=' + lastname +'&number=' + number + '&phone=' 
							+ phone + '&depart=' + depart + '&date=' + date + '&address=' + address
							+ '&checkSMS=' + checkSMS + '&checkTransport=' + checkTransport;
		$.ajax({
			type: "POST",
			url: "action.php",
			data: dataString,
			cache: true,
	        success: function (msg) {                    
	           alert("פרטי העובד נשלחו בהצלחה!");
	        },
	        error: function (msg) {
	            alert("Error " + msg.d.toString());
	        }
			});
		return false;
	});
});