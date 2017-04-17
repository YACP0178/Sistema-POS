

$(document).ready(function(){
	$("form#loginform").submit(auth);
});

function auth(){
	var username = $('input#username').val();
    var password = $('input#password').val();

    var arrData = {
    	username:username,
    	password:password
    }

    $.post('auth/login', 
		{ 
			arrData: arrData
		},
		function(data) { 
			var login =$.parseJSON(data).login;

			if(login == "true"){
				window.location.href = 'home';
			}else{
				alert('usuario Incorrecto');
			}
		}
	);

	return false;

}