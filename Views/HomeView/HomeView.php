<?php 



?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>HTML Template</title>
	<script type="text/javascript" src="./Assets/js/jquery.min.js"></script>
	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CVarela+Round" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="<?php echo $model["assets_path"] ?>/css/bootstrap.min.css" />

	<!-- Owl Carousel -->
	<link type="text/css" rel="stylesheet" href="<?php echo $model["assets_path"] ?>/css/owl.carousel.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo $model["assets_path"] ?>/css/owl.theme.default.css" />

	<!-- Magnific Popup -->
	<link type="text/css" rel="stylesheet" href="<?php echo $model["assets_path"] ?>/css/magnific-popup.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="<?php echo $model["assets_path"] ?>/css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="<?php echo $model["assets_path"] ?>/css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<!-- Header -->
	<header id="home">
		<!-- Background Image -->
		<div class="bg-img" style="background-image: url('<?php echo $model["assets_path"] ?>/img/background1.jpg');">
			<div class="overlay"></div>
		</div>
		<!-- /Background Image -->

		<!-- Nav -->
		<nav id="nav" class="navbar nav-transparent">
			<div class="container">

				<div class="navbar-header">
					<!-- Logo -->
					<div class="navbar-brand">
						<a href="index.html">
							<img class="logo" src="<?php echo $model["assets_path"] ?>/img/logo.png" alt="logo">
							<img class="logo-alt" src="<?php echo $model["assets_path"] ?>/img/logo-alt.png" alt="logo">
						</a>
					</div>
					<!-- /Logo -->

					<!-- Collapse nav button -->
					<div class="nav-collapse">
						<span></span>
					</div>
					<!-- /Collapse nav button -->
				</div>

				<!--  Main navigation  -->
				<ul class="main-nav nav navbar-nav navbar-right">
					<li><a href="#home">Home</a></li>
					<li><a href="#about">About</a></li>
					<li><a href="#portfolio">Portfolio</a></li>
					<li><a href="#service">Services</a></li>
					<li><a href="#pricing">Prices</a></li>
					<li><a href="#team">Team</a></li>
					<li class="has-dropdown"><a href="#blog">Blog</a>
						<ul class="dropdown">
							<li><a href="blog-single.html">blog post</a></li>
						</ul>
					</li>
					<li><a href="#contact">Contact</a></li>
				</ul>
				<!-- /Main navigation -->

			</div>
		</nav>
		<!-- /Nav -->

		<!-- home wrapper -->
		<div class="home-wrapper">
			<div class="container">
				<div class="row">

					<!-- home content -->
					<div class="col-md-10 col-md-offset-1">
						<div class="home-content">
							<h1 class="white-text">Your Digital Bridge Everyday</h1>
							<p class="white-text">For an enhanced experience we suggest using an account
							</p>
							<a  href="#about" ><button class="white-btn">Anonymous Session</button></a>
							<button class="main-btn">Use Account</button>
						</div>
					</div>
					<!-- /home content -->

				</div>
			</div>
		</div>
		<!-- /home wrapper -->

	</header>
	<!-- /Header -->

	<!-- About -->
	<div id="about" class="section md-padding">

		<!-- Container -->
		<div class="container">

			<!-- Row -->
			<div class="row">

				<!-- Section header -->
				<div class="section-header text-center">
					<h2 class="title">Anonymous Session</h2>
				</div>
				<!-- /Section header -->

				<!-- about -->
				<div class="col-md-4 flip-card" style="">
					<div class="about flip-card-inner">
						<div class="flip-card-front">
						<i class="fa fa-link"></i>
						<h3>Use Code</h3>
						<p>Join a transfer session using an access code.</p>
					
						<div class="inputs" id="inputs">
								<input maxlength="2" placeholder="" value=""/>
								<input maxlength="2" placeholder="" value=""/>
								<input maxlength="2" placeholder="" value=""/>
								<input maxlength="1" placeholder="" value=""/>
						</div>
						<a href="javascript:void(0)" >Enter</a>
						</div>
						<div class="flip-card-back" style="display: none;">
								<i class="fa fa-link"></i>
								<h3>Enter Code</h3>
								
						</div>
					</div>
				</div>
				<!-- /about -->
				<script>
					function flip(elm){
						$(elm).focusout()
						$(elm).closest('.flip-card-front').fadeOut(300,function(){
							$(elm).closest('.flip-card').find('.flip-card-back').fadeIn(300);
							$(elm).closest('.flip-card').addClass('flipped-card');
						})
						
					}
					function unflip(elm){
						$(elm).focusout()
						$(elm).closest('.flip-card-back').fadeOut(300,function(){
							$(elm).closest('.flip-card').find('.flip-card-front').fadeIn(300);
							$(elm).closest('.flip-card').removeClass('flipped-card');
						})
					}
					function processInput(holder){
						
	var elements = holder.children(), //taking the "kids" of the parent
			str = ""; //unnecesary || added for some future mods
			console.log(elements[0].value)
	elements.each(function(e){ //iterates through each element
		var val = $(this).val().toUpperCase()//.replace(/\D/,""), //taking the value and parsing it. Returns string without changing the value.
				focused = $(this).is(":focus"), //checks if the current element in the iteration is focused
				parseGate = false;
		console.log(val);
		val.length==1?parseGate=false:parseGate=true; 
			/*a fix that doesn't allow the cursor to jump 
			to another field even if input was parsed 
			and nothing was added to the input*/
		
		$(this).val(val); //applying parsed value.
		
		if(parseGate&&val.length>1){ //Takes you to another input
			var	exist = elements[e+1]?true:false; //checks if there is input ahead
			exist&&val[1]?( //if so then
				elements[e+1].disabled=false,
				elements[e+1].value=val[1], //sends the last character to the next input
				elements[e].value=val[0], //clears the last character of this input
				elements[e+1].focus() //sends the focus to the next input
			):void 0;
		} else if(parseGate&&focused&&val.length==0){ //if the input was REMOVING the character, then
			var exist = elements[e-1]?true:false; //checks if there is an input before
			if(exist) elements[e-1].focus(); //sends the focus back to the previous input
		}
		
		val==""?str+=" ":str+=val;
	});
}

$("#inputs").on('input', function(){processInput($(this))}); //still wonder how it worked out. But we are adding input listener to the parent... (omg, jquery is so smart...);

$("#inputs").on('click', function(e) { //making so that if human focuses on the wrong input (not first) it will move the focus to a first empty one.
	var els = $(this).children();
	console.log(e);
			str = "";
	els.each(function(e){
		var focus = $(this).is(":focus");
		$this = $(this);
		while($this.prev().val()==""){
			$this.prev().focus();
			$this = $this.prev();
		}
	})
});
				</script>
				<style>

					
input::-webkit-input-placeholder {
  color: #6195FF !important;
}

input:-moz-placeholder {
  color: #6195FF ;
}

input::-moz-placeholder {
  color: #6195FF ;
}

input:-ms-input-placeholder {
  color: #6195FF;
}


.inputs input:focus::-webkit-input-placeholder{
	color:transparent!important;
}


input:focus::-moz-placeholder {
color:transparent;
}


input:focus::-ms-input-placeholder{
color: transparent;
}


.about:hover input{
	color:white;
	opacity:1;
	
}
.flip-card-back {
  width: 90%;
  height: 100vh;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.flip-card-back h1 {
  font-size: 32px;
  font-weight: 600;
}
.flip-card-inner{
	border:1px solid #c6c6c6;
	transition: linear 0.3s;
}
.inputs input {
  padding:5px;
  margin:5px;
  border:1px solid black;
  width: 55px;
  height: 55px;
  margin-bottom: 10px;
  line-height: 100%;
  background-color: transparent;
  border: 0;
  outline: 0;
  color: black;
  font-size: 40px;
  word-spacing: 0px;
  overflow: hidden;
  text-align: center;
  border-bottom:1px solid #c6c6c6!important;
  
}
.inputs input:focus {
  outline: none!important;

 
}

.flip-card-inner:hover{

	border-color: transparent;
}


.flip-card {
  perspective: 1000px;
}

.flip-card-inner {
  transition: transform 0.6s;
  transform-style: preserve-3d;
  height: 337px;
  max-height: 337px;
  min-height: 337px;
}

.flipped-card .flip-card-inner {
  transform: rotateY(-180.5deg);
}

.flip-card-front, .flip-card-back {
  backface-visibility: hidden;
}

.flip-card-back {
  transform: rotateY(180deg);
}

.feature{
	
	display: flex;
	text-align: left;
	font-size:18px;
	width: 100%;
	margin:5px 0!important;

}
.feature i{
	font-size: 20px;
	border: none;
	margin-bottom: 0;
}
.feature p{
	margin-bottom: 0;
}
				</style>

				<!-- about -->
				<div class="col-md-4 flip-card" style="">
						<div class="about flip-card-inner">
							<div class="flip-card-front">
							<i class="fa fa-info"></i>
							<h3>Anonymous Usage</h3>
							<div class="feature">
									<i class="fa fa-check"></i>
									<p>Store up to 1GB of information.</p>
								</div>
								<div class="feature">
									<i class="fa fa-check"></i>
									<p>3 times extendable session.</p>
								</div>
								<div class="feature">
										<i class="fa fa-check"></i>
										<p>High speed transfer.</p>
									</div>
									<div class="feature">
										<i class="fa fa-check"></i>
										<p>Password protected session.</p>
									</div>
								
			
							<a href="javascript:void(0)" onclick="flip(this)">Cons</a>
							</div>
							<div class="flip-card-back" style="display: none; height: auto;">
									<i class="fa fa-info"></i>
									<h3>Anonymous Usage</h3>
									<div class="feature">
											<i class="fa fa-times"></i>
											<p>Less secure.</p>
										</div>
										<div class="feature">
											<i class="fa fa-times"></i>
											<p>Storage is not persistent.</p>
										</div>
										<div class="feature">
												<i class="fa fa-times"></i>
												<p>Max file per upload is 150MB.</p>
										</div>
										<a href="javascript:void(0)" onclick="unflip(this)">Pros</a>
							</div>
						</div>
						
					</div>

				<div class="col-md-4 flip-card" style="">
					<div class="about flip-card-inner">
						<div class="flip-card-front">
						<div class="intro">
							<i class="fa fa-server"></i>
							<h3>Create Session</h3>
							<p>Create a new transfer session where you can temporary store anything.</p>
							<a href="javascript:void(0)" onclick="flip(this)">Create</a>
						</div>
						<div class="response bad-response" style="display:none;">
						<i class="fa fa-server"></i>
							<h3>Oops!</h3>
							<p>Looks like something cracked. Refresh and try again? </p>
							<a href="javascript:void(0)" onclick="window.location.reload()">Refresh</a>
						</div>
						</div>
						<div class="flip-card-back" style="display: none; height: auto;">
								<i class="fa fa-server"></i>
								<h3>Create Session</h3>
								<div class="session-create">
										<input type="password" class="input" placeholder="Password" style="margin-bottom:97px;margin-top:0;">
										<a href="javascript:void(0)" onclick="flip(this)" style="margin-top:15px;">Create</a>
								</div>
						</div>
						<style>
							.session-create input{
								margin:13px 0;
								color: black!important;
							}
						</style>
					</div>
					
				</div>
				<!-- /about -->
				
				
				</div>
			</div>
			<!-- /Row -->

		</div>
		<!-- /Container -->

	</div>
	<!-- /About -->


	<!-- Back to top -->
	<div id="back-to-top"></div>
	<!-- /Back to top -->

	<!-- Preloader -->
	<div id="preloader">
		<div class="preloader">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
	<!-- /Preloader -->
	

	<!-- jQuery Plugins -->

	<script type="text/javascript" src="<?php echo $model["assets_path"] ?>/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $model["assets_path"] ?>/js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="<?php echo $model["assets_path"] ?>/js/jquery.magnific-popup.js"></script>
	<script type="text/javascript" src="<?php echo $model["assets_path"] ?>/js/main.js"></script>
	<script>
	$(".home-content a").on('click', function(e) {
		e.preventDefault();
		var hash = this.hash;
		$('html, body').animate({
			scrollTop: $(this.hash).offset().top
		}, 600);
	});
	</script>
</body>

</html>
