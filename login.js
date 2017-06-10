function submitForm1(){
	var frm = arguments[0];
	for(var i = 1; i < arguments.length; i++){
		$password = $("#"+arguments[i].id).val();
		$("#"+arguments[i].id).val(sha256_digest($password));
	}
	frm.submit();
}