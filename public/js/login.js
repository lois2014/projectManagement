$(function(){
	$('#email').focus().blur(checkName);
	$('#password').blur(checkPassword);
});

function checkName(){
	var name = $('#email').val();
	if(name == null || name == ""){
		//提示错误
		$('#count-msg').html("邮箱不能为空");
		return false;
	}
	var reg = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,}$/;
	if(!reg.test(name)){
		$('#count-msg').html("请输入正确的邮箱");
		return false;
	}
	$('#count-msg').empty();
	return true;
}

function checkPassword(){
	var password = $('#password').val();
	if(password == null || password == ""){
		//提示错误
		$('#password-msg').html("密码不能为空");
		return false;
	}
	var reg = /^\w{3,10}$/;
	if(!reg.test(password)){
		$('#password-msg').html("输入3-10个字母或数字或下划线");
		return false;
	}
	$('#password-msg').empty();
	return true;
}