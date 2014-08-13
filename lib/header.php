<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>2014 台大資管迎新宿營</title>
	<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />
	<style type="text/css">
		body{
			padding-top:20px;padding-bottom:40px;
		}
		.container-narrow{
			margin:0 auto;max-width:800px;
		}
		.container-narrow>hr{
			margin:30px 0;
		}
		.hero-unit{
			margin:60px 0;text-align:center;color:white;font-weight:bold;text-shadow:2px 2px 2px black;background:url(../img/israel-bus.jpg);background-size:800px auto;
		}
		.hero-unit h1{font-size:72px;line-height:1;}
		.hero-unit .btn{font-size:21px;padding:14px 24px;}
		.marketing{margin:60px 0;}
		.marketing p+h4{margin-top:28px;}
	</style>
	<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
	 <div class="container-narrow">

        <div class="masthead">
            <ul class="nav nav-pills pull-right">
							<li><a href="./">首頁</a></li>
							<li class="active"><a href="#">報名系統</a></li>
							<li><?php
								if($user){
									echo '<a href="./logout">登出</a></li>';
								}else{
									echo '<a href="./login">登入</a></li>';
								}
							?>
            </ul>
            <h3 class="text-muted">2014 台大資管迎新宿營</h3>
        </div>

        <hr>
				<ul class="nav nav-tabs">
					<?php
						$navbar = array(
							array("./register", "報名"),
							array("./pay", "繳費"),
							array("./notice", "注意事項")
						);

						if(isset($adminInterface)){
							$navbar = array(
								array("./list_all", "新生列表"),
								array("./list_register", "報名名單")
							)
						};

						foreach($navbar as $link){
							echo '<li';
							if($link[0] == $currentLink){
								echo ' class="active"';
							}
							echo '><a href="'.$link[0].'">'.$link[1].'</a></li>';
						}
					?>
				</ul>
				<div class="tab-pane" id="all">
