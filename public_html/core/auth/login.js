
	var date = new Date();
	console.log (date);

function TryLogin() {
	var username = document.getElementById("input_username").value;	
	document.getElementById("send_username").value = username;
	
	var password = document.getElementById("input_password").value;	
	if (username.length < 3 || password.length < 3) return;
	document.getElementById("input_password").value = "";
	
	var cookiesign = getCookie("cookiesign");
	if (username.length < 3 || password.length < 3) return;
	if (cookiesign == undefined) {
		document.getElementById("send_action").value = "user_request_auth";
		document.getElementById("loginForm").submit();
		return;
	} else {
		document.getElementById("send_action").value = "user_login";
	}
	
	var options = {
		message: openpgp.message.fromBinary(new Uint8Array([0x01, 0x01, 0x01])), // input as Message object
		passwords: [cookiesign, password],                               // multiple passwords possible
		armor: false                                                     // don't ASCII armor (for Uint8Array output)
	};
	var encrypted;
	openpgp.encrypt(options).then(function(ciphertext) {
		encrypted = ciphertext.message.packets.write(); // get raw encrypted packets as Uint8Array
		document.getElementById("send_passwordHash").value = encrypted;
		document.getElementById("send_passwordHash").value = password;			// REMOVE ME
		document.getElementById("loginForm").submit();
	});
}


function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}