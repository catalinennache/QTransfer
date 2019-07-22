<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <title>Transfer - Anonymous Session</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="Template by Colorlib" />
        <meta name="keywords" content="HTML, CSS, JavaScript, PHP" />
        <meta name="author" content="Colorlib" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <link rel="shortcut icon" href="images/favicon.png" />
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700%7CLibre+Baskerville:400,400italic,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css"  href='<?php echo $model["assets_path"] ?>/css/clear.css' />
        <link rel="stylesheet" type="text/css"  href='<?php echo $model["assets_path"] ?>/css/common.css' />
        <link rel="stylesheet" type="text/css"  href='<?php echo $model["assets_path"] ?>/css/font-awesome.min.css' />
        <link rel="stylesheet" type="text/css"  href='<?php echo $model["assets_path"] ?>/css/carouFredSel.css' />
        <link rel="stylesheet" type="text/css"  href='<?php echo $model["assets_path"] ?>/css/sm-clean.css' />
        <link rel="stylesheet" type="text/css"  href='<?php echo $model["assets_path"] ?>/css/style2.css' />
        <link rel="stylesheet" type="text/css"  href='<?php echo $model["assets_path"] ?>/css/style.css' />
        <!--[if lt IE 9]>
                <script src="js/html5.js"></script>
        <![endif]-->

    </head>


    <body class="home blog">

        <!-- Preloader Gif -->
        <table class="doc-loader">
            <tbody>
                <tr>
                    <td>
                        <img src="<?php echo $model["assets_path"] ?>/img/logo_qt.png" alt="Loading...">
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Left Sidebar -->
      

            <div class="menu-right-part">
                <div class="logo-holder">
                    <a href="index.html">
                        <img src="<?php echo $model["assets_path"] ?>/img/logo_qt.png" style="transform:scale(0.65);" alt="Suppablog WP">
                    </a>
                </div>
                <div class="toggle-holder">
                    <div id="toggle">
                        <div class="menu-line"></div>
                    </div>
                </div>
                <div class="social-holder">
                    <div class="social-list">
                        <a href="#"><i class="fa fa-file"></i></a>
                        <a href="#"><i class="fa fa-folder"></i></a>
                        <a href="#"><i class="fa fa-clipboard"></i></a>
                        <a href="#"><i class="fa fa-history"></i></a>
                        <a href="#"><i class="fa fa-share"></i></a>
                  </div>
                </div>
                <div class="fixed countdown" style="position:relative;width:100%; text-align:center;"></div>
            </div>
        </div>

        <!-- Home Content -->
       <div id="content" class="site-content" style="">
       <div class="section-header text-center" >
					<h2 class="title" style="text-align:center;">Anonymous Session</h2>
                </div>
       <style>
           .path,.search,.show-style{
               display:inline-block;
               
           }
           .path{
               margin-left:5vw;
           }
           .search{
               float:right;
               margin-right:80px;
               margin-top:-10px;
           }
           .search input{
               border-radius:7px;
           }
           .show-style{
               margin-left:10px;
           }.show-style span{
                vertical-align:middle;
                cursor:pointer;
           }
           .show-style span:hover{
               color:#6195FF;
           }
           .card-view{
               margin:calc(5vw - 10px);
               width:90%;
               margin-top:50px;
           }
        </style>
        <div class="row">
            <div class="path">
            <a>./</a>
   
            <a>Folder1</a>
            <a>></a>
            <a>Indepth_Folder</a>
            </div>
            <div class="show-style">
                <span style="margin-top:3px;"> <i class="fa fa-list"></i>
                </span>
                <span style="display:none;"> <i class="fa fa-th-large"></i> </span>
            </div>

            <div class="search">
                <input type="text" placeholder="Shearch it here">
            </div>
        </div>       
    <div class="card-view">
        <div class="col-md-4 flip-card" style="">
						<div class=" flip-card-inner" style="padding-bottom:0;">
							<div class="flip-card-front">
							<i class="fa fa-file"></i>
							<h3 style="margin-bottom:0;">Realistic Filename</h3>
							<div class="feature">
									<i class="fa fa-info"></i>
									<p>Text File (TXT)</p>
								</div>
								<div class="feature">
									<i class="fa fa-info"></i>
									<p>3256 Kb Size</p>
								</div>
								<div class="feature">
										<i class="fa fa-info"></i>
										<p>Uploaded 29 min ago.</p>
								</div>
								<div class="feature">
										<i class="fa fa-info"></i>
										<p>23 Downloads</p>
								</div>
								
			
                            <a href="javascript:void(0)" onclick="flip(this)">Download</a>
                            <span>|</span>
                            <a href="javascript:void(0)" onclick="flip(this)">Delete</a>
                            
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
						
                    </div><!-- flip cARD-->

                    <div class="col-md-4 flip-card" style="">
						<div class=" flip-card-inner" style="padding-bottom:0;">
							<div class="flip-card-front">
							<i class="fa fa-file"></i>
							<h3 style="margin-bottom:0;">Realistic Filename</h3>
							<div class="feature">
									<i class="fa fa-info"></i>
									<p>Text File (TXT)</p>
								</div>
								<div class="feature">
									<i class="fa fa-info"></i>
									<p>3256 Kb Size</p>
								</div>
								<div class="feature">
										<i class="fa fa-info"></i>
										<p>Uploaded 29 min ago.</p>
								</div>
								<div class="feature">
										<i class="fa fa-info"></i>
										<p>23 Downloads</p>
								</div>
								
			
                            <a href="javascript:void(0)" onclick="flip(this)">Download</a>
                            <span>|</span>
                            <a href="javascript:void(0)" onclick="flip(this)">Delete</a>
                            
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

        </div><!-- flip card view-->


        
    </div>
    



        <!--Load JavaScript-->
        <script type="text/javascript" src="<?php echo $model["assets_path"] ?>/js/jquery.js"></script>
        <script type='text/javascript' src='<?php echo $model["assets_path"] ?>/js/imagesloaded.pkgd.js'></script>
        <script type='text/javascript' src='<?php echo $model["assets_path"] ?>/js/jquery.nicescroll.min.js'></script>
        <script type='text/javascript' src='<?php echo $model["assets_path"] ?>/js/jquery.smartmenus.min.js'></script>
        <script type='text/javascript' src='<?php echo $model["assets_path"] ?>/js/jquery.carouFredSel-6.0.0-packed.js'></script>
        <script type='text/javascript' src='<?php echo $model["assets_path"] ?>/js/jquery.mousewheel.min.js'></script>
        <script type='text/javascript' src='<?php echo $model["assets_path"] ?>/js/jquery.touchSwipe.min.js'></script>
        <script type='text/javascript' src='<?php echo $model["assets_path"] ?>/js/jquery.easing.1.3.js'></script>
        <script type='text/javascript' src='<?php echo $model["assets_path"] ?>/js/mainsuppa.js'></script>
        <script type='text/javascript' src='<?php echo $model["assets_path"] ?>/js/easytimer.min.js'></script>
        
        
        <script>


var $ = jQuery;
var timer = new easytimer.Timer();
timer.start({countdown: true, startValues: {hours:2,seconds: 30}});
$('.countdown').html(timer.getTimeValues().toString());
timer.addEventListener('secondsUpdated', function (e) {
    $('.countdown').html(timer.getTimeValues().toString());
});
timer.addEventListener('targetAchieved', function (e) {
    $(' .countdown').html('KABOOM!!');
});
          

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


body{
    line-height:35px!important;
}
.flip-card-inner i{
    font-size: 36px;
    color: #6195FF;
    margin-bottom: 20px;
    text-align:center;
}
input::-webkit-input-placeholder {
  color: black !important;
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
    display:block;
    transition:0.15s linear!important;
    padding:20px;
}
.search input{
    background:rgb(235, 236, 240);
    border-bottom:2px solid black;
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
    box-shadow: 0px 0px 10px #6195FF;
	border-color: transparent;
}


.flip-card {
  perspective: 1000px;
  display:inline-block;
  margin:10px;
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
  text-align:center;
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

   
    </body>
</html>
