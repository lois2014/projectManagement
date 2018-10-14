<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<link rel="stylesheet" href="{{ asset('css/login.css') }}" />
        <script type="text/javascript" src="{{ asset('js/jquery-1.11.2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/login.js') }}"></script>
</head>
<body>
<div class="page">
	<div class="loginwarrp">
		<div class="logo">登陆</div>
        <div class="login_form">
			<form id="Login" name="Login" method="post" onsubmit="" action="{{ route('login') }}">
				@csrf
				@foreach ($errors->all() as $message)
				<span id="count-msg" class="error">{{ $message }}</span>
				@endforeach
				<li class="login-item">
					<span>邮箱：</span>
					<input type="text" id="email" name="email" class="login_input" >
                                        <span id="count-msg" class="error"></span>
				</li>
				<li class="login-item">
					<span>密　码：</span>
					<input type="password" id="password" name="password" class="login_input" >
                                        <span id="password-msg" class="error"></span>
				</li>
				<!--<li class="login-item verify">
					<span>验证码：</span>
					<input type="text" name="CheckCode" class="login_input verify_input">
				</li>
				<img src="images/verify.png" border="0" class="verifyimg" />
				<div class="clearfix"></div> --!>
				<li class="login-sub">
					<input type="submit" name="Submit" value="登录" />
                    
				</li>                      
           </form>
		</div>
	</div>
</div>
<script type="text/javascript">
		window.onload = function() {
			var config = {
				vx : 4,
				vy : 4,
				height : 2,
				width : 2,
				count : 100,
				color : "121, 162, 185",
				stroke : "100, 200, 180",
				dist : 6000,
				e_dist : 20000,
				max_conn : 10
			}
			CanvasParticle(config);
		}
	</script>
	<script type="text/javascript" src="{{ asset('js/canvas-particle.js') }}"></script>
</body>
</html>