<?php
session_start();
require 'config.php';
require 'vendor/autoload.php';
require 'rb.php';

$app = new \Slim\Slim();

function getFacebook(){
	$facebook = new Facebook(array('appId' => FB_APPID, 'secret' => FB_APPSECRET));
	return $facebook;
}

function getRealIdByPhoto($url){
	$photo_data = explode("_", $url);

	$context = stream_context_create(
			array(
					'http' => array(
							'follow_location' => false
					)
			)
	);
	$html = file_get_contents('https://www.facebook.com/'.$photo_data[1], false, $context);
	if (strpos($http_response_header['1'],'photo.php') !== false) {
			$tmp = explode('.', $http_response_header['1']);
			return explode('&', $tmp[6])[0];
	}else{
		return 0;
	}
}

// Set up database connection

R::setup('mysql:host='.DBHOST.';dbname='.DBNAME, DBUSER, DBPASS);

$app->get('/', function(){
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>台大資管迎新宿營 | Freshman Camp for NTUIM</title>
<?php
  define("ACTITLE","2014 台大資管迎新宿營");
  define("DESCRIPTION", "恭喜各位進入資管系這個⼤家庭!!想要提早認識大家，想要認識更多學長姐嗎？快來參加為你們精心準備的迎新宿營吧！");
?>
        <meta name="description" content="<?php echo DESCRIPTION; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta property="og:title" content="<?php echo ACTITLE; ?>">
        <meta property="og:type" content="website">
        <meta property="og:url" content="http://union.im.ntu.edu.tw/freshman/">
        <meta property="og:image" content="http://union.im.ntu.edu.tw/freshman/images/screenshot.png">
        <meta property="og:site_name" content="<?php echo ACTITLE; ?>">
        <meta property="og:description" content="<?php echo DESCRIPTION; ?>">

        <meta property="twitter:title" content="<?php echo ACTITLE; ?>">
        <meta property="twitter:description" content="<?php echo DESCRIPTION; ?>">
        <meta property="twitter:image:src" content="http://union.im.ntu.edu.tw/freshman/images/screenshot.png">
        <meta property="twitter:image:width" content="256">
        <meta property="twitter:image:height" content="256">

        <link rel="shortcut icon" href="favicon.ico" />

        <link rel="stylesheet" href="stylesheets/main.css">
        <script src="bower_components/modernizr/modernizr.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <section id="landing" class="section">
  <div id="cover">
  <div class="inner">
    <div id="logo">Freshman Camp for NTUIM</div>
    <h1>
      台大資管迎新宿營
      <span class="small sub-header as-block">Freshman Camp for NTUIM</span>
      <span class="sub-header as-block">IM 106 x IM 107</span>
    </h1>
    <a class="glowing button" href="./register">立即報名</a>
  </div>
</div>
<div id="scroll-down-notice">
  Scroll Down
</div>

</section>
<header id="header" class="section">
  <nav id="main-menu">
  <label for="menu-toggle" class="mobile menu"><div class="item">Menu</div></label>
  <input type="checkbox" id="menu-toggle" />
  <ul class="main menu">
    <li class="item"><a href="#about">About</a></li>
    <li class="item"><a href="#location">Location</a></li>
    <li class="item"><a href="#schedule">Schedule</a></li>
    <li class="item"><a href="#sponsor">Sponsor</a></li>
    <li class="item"><a href="#team">Team</a></li>
  </ul>
</nav>

</header>
<section id="about" class="section as-one-page">

<?php include('./lib/ascii_art.php'); ?>

  <div class="inner">
  <div class="overlay cg"></div>
  <div id="about-description">
    <div class="about-us">
      <div class="container">
        <div class="description">
          <p>
            恭喜各位進入資管系這個⼤家庭!!<br><br>
            剛升上⼤學，好多事都還搞不清楚就要開學了，你是否感到彷徨無助呢?!<br>
            或許你覺得興奮⼜期待但是...!<br>
            周圍的⼈就是未來四年以及往後⽣生活的夥伴，你卻跟他還不熟?!<br>
            或是覺得學⻑好帥學姊好正，你卻不認識他?!<br>
            那就來參加我們的迎新宿營吧!!<br>
            精⼼籌備的活動保證你迅速跟系上的人們混熟，以後包準話題⼀堆!吃宵夜都不怕沒⼈揪!!
          </p>
        </div>
      </div>
      <div class="background polygon"></div>
    </div>
    <aside class="partners">
      <div class="container">
        <div class="partner-list">
          <h3>主辦單位</h3>
          －
          <div class="partner">
            <a class="small button">臺灣大學資管系學生會</a>
          </div>
        </div>
        <div class="partner-list">
          <h3>協辦單位</h3>
          －
          <div class="partner">
            <a class="small button">臺灣大學資管系</a>
          </div>
        </div>
				<div class="partner-list">
					<h3>報名方式</h3>
					－
					<div class="partner">
						<a class="small">點選本網站上方「立即報名」按鈕，填寫相關資料。</a>
					</div>
				</div>
				<div class="partner-list">
					<h3>活動費用</h3>
					－
					<div class="partner">
						<a class="small">新台幣3000元整。費用包含食宿、交通、保險、營服等。</a>
					</div>
				</div>

      </div>
    </aside>
  </div>
</div>

</section>
<section id="location" class="section as-one-page">
  <div class="inner">
  <div id="map-canva" style="height: 100%"></div>
  <div id="location-information">
    <div class="container">
      <div class="information">
        <span class="date">2014 年 9 月 1 日 ~ 9 月 3 日 /</span><span class="location"> 松旺農場</span>
      </div>
      <div class="kuma">
        <img id="kuma-at-map" src="images/kuma_1.png" width="405" height="461" alt="KumaKuma" />
      </div>
    </div>
  </div>
</div>

</section>
<section id="schedule" class="section as-page">
  <header class="header module">
    <div class="container">
      <h2>Schedule</h2>
    </div>
  </header>

            <div class="">
                  <table id="schedule-table" class="" style="text-align:center;width:80%;margin:auto;">
                    <thead>
                      <th width="25%" class="session block">Time</th>
                      <th width="25%" class="session block">Day 1</th>
                      <th width="25%" class="session block">Day 2</th>
                      <th width="25%" class="session block">Day 3</th>
                    </thead>
                    <tbody>
                      <tr>
                        <th class="session block">07:00</th>
                        <td rowspan="2"></td>
                        <td class="session block" colspan="2"><h4>整裝待發</h4></td>
                      </tr>
                      <tr>
                        <th class="session block">07:30</th>
                        <td class="session block"><h4>團康遊戲</h4></td>
                        <td class="session block"><h4>團康遊戲</h4></td>
                      </tr>
                      <tr>
                        <th class="session block">08:30</th>
                        <td class="session block"><h4>在台大校門口集合</h4></td>
                        <td colspan="2" class="session block"><h4>早餐</h4></td>
                      </tr>
                      <tr>
                        <th class="session block">09:00</th>
                        <td class="session block"><h4>出發前往松旺農場</h4></td>
                        <td rowspan="2" class="session block"><h4>IM AMBITION</h4></td>
                        <td rowspan="2" class="session block"><h4>水球！</h4><div class="detail">
                        <p>杜蘭先生消失惹</p> <p>名立嗎成現家了腳好，治我一才少獨戰一的要！片孩讓容化？家一場標西到得然相請工這一流內業善、燈入兩，也構樣以一源機些新是石成使種足讓良。見團經黃年著此再院現一這全任突？</p>

                        </div>
                        </td>


                      </tr>
                      <tr>
                        <th class="session block">10:00</th>
                        <td class="session block"><h4>哩咧演啥毀？？</h4></td>
                      </tr>
                      <tr>
                        <th class="session block">12:00</th>
                        <td colspan="3" class="session block"><h4>午餐</h4></td>
                      </tr>
                      <tr>
                        <th class="session block">13:30</th>
                        <td colspan="3" class="session block"><h4>小隊時間</h4></td>
                      </tr>
                      <tr>
                        <th class="session block">14:30</th>
                        <td class="session block"><h4>來自火星的聖選</h4></td>
                        <td class="session block"><h4>推理要在午餐後</h4></td>
                        <td class="session block"><h4>小隊呈現</h4></td>
                      </tr>
                      <tr>
                        <th class="session block">17:30</th>
                        <td colspan="2" class="session block"><h4>晚餐</h4></td>
                        <td class="session block"><h4>賦歸</h4></td>
                      </tr>
                      <tr>
                        <th class="session block">19:00</th>
                        <td class="session block"><h4>夜教</h4></td>
                        <td class="session block"><h4>晚會</h4></td>
                      </tr>
                      <tr>
                        <th class="session block">22:00</th>
                        <td colspan="2" class="session block"><h4>宵夜 &amp; 小隊時間 &amp; 洗澡</h4></td>
                      </tr>
                    </tbody>
                  </table>
            </div>
</section>
<section id="sponsor" class="section as-page">
  <div class="inner">
  <header class="header module">
    <div class="container">
      <h2>Sponsor</h2>
    </div>
  </header>
  <div class="sponsors">
    <div class="container">

<?php
  $sponsors = array(
    array("台大湘園牛肉麵", "和平東路118巷40號", ""),
    array("姜柏任 學長","",""),
    array("強生汽車","復興南路二段328號","(02)27330389"),
    array("芝鄉涼麵","和平東路二段311巷26號","(02)27003080"),
    array("LaWhale阿威麵包店","復興南路二段193巷3號","(02)23252218"),
    array("阿里媽媽南洋料理","羅斯福路四段136巷1衖3號",""),
    array("一吃獨秀綠色臭豆腐˙米粉羹","羅斯福路四段136巷1弄11號1樓","(02)83692905"),
    array("綠園水果","和平東路118巷54弄1號",""),
    array("甜品屋","和平東路118巷61號","(02)87327622"),
    array("復興車行","復興南路2段360號","(02)27375741"),
    array("191自轉車","復興南路2段391號","(02)27359790"),
    array("阿玉水餃","辛亥路2段217號","(02)27365875"),
    array("香港金葉港式燒臘","和平東路二段311巷28號",""),
    array("巧房餡餅蔥燒餅","和平東路二段313號(應該也是311巷)","(02)27008901"),
    array("凱利義式餐廳","羅斯福路四段136巷6衖8號",""),
    array("藍家割包四神湯","羅斯福路三段316巷8弄3號","(02)23682060"),
    array("公館邁阿密","羅斯福路三段316巷9弄4號","(02)23657413"),
    array("環捷資訊有限公司","忠孝東路二段121巷20號",""),
    array("越南牛肉河粉","和平東路二段311巷23號","(02)27055383"),
    array("白帝城川式滷味","羅斯福路四段136巷8號","")
  );

  foreach($sponsors as $sponsor){
    echo '<aside class="sponsor"><h3>';
    echo $sponsor[0];
    echo '<span class="sub-header">';
    echo $sponsor[1];
    echo '<br>'.$sponsor[2];
    echo '</span></h3></aside>';
  }
?>

    </div>
  </div>
</div>

</section>
<section id="team" class="section as-page">
  <div class="inner">
  <header class="header module">
    <div class="container">
      <h2>Team</h2>
    </div>
  </header>
  <div class="team-members">

<?php
// title,nickname,link,img
$deptName=array('召部','隊輔','幹部群');
$deptData=array();

$deptData[] = array(
  array('總召','陳劭恩','100000230048556'),
  array('副召','涂靖雯','jingwen.tu'),
  array('副召','賴冠廷','100002315801969')
);

$deptData[] = array(
  array('第一小隊','殷豪','100001439017675'),
  array('第一小隊','宋欣馨','100002554585595'),
  array('第二小隊','郭毓棠','100001449413074'),
  array('第二小隊','簡敏瑜','100000183112750'),
  array('第三小隊','方松營','oliver.fang.5'),
  array('第三小隊','周晅瑢','hsuanjung.chou'),
  array('第四小隊','朱博遠','johnny.chu.568'),
  array('第四小隊','趙涵秀','1798445851'),
  array('第五小隊','林易澍','100001999453163'),
  array('第五小隊','羅云伶','100002745828122')
);

$deptData[] = array(
  array('活動部 部長','胡哲愷','goxluix7'),
  array('活動部 副部長','梁暉義','freddyddy'),
  array('庶務部 部長','李慶宏','LeeChingHung'),
  array('庶務部 副部長','冷俊瑩','100002026913237'),
  array('美宣部 部長','劉育婷','100003664306521'),
  array('美宣部 副部長','陳君儒','amy.chen.58511276'),
  array('公關部 部長','朱瑤章','100000165533409'),
  array('公關部 副部長','楊大為','100000178258887'),
  array('器材部 部長','江孟軒','100000340782660'),
  array('資訊部 部長','虞翔皓','lolicon.fish'),
  array('資訊部 副部長','宋欣馨','100002554585595')
);

foreach($deptData as $deptId => $deptDataPer){
?>
      <div class="container">
      <h2 class="header"><?php echo $deptName[$deptId]; ?></h2>
       </div>
    <div class="container">
<?php
  foreach($deptDataPer as $staffData){
?>
      <aside class="member">
        <div class="avatar">
          <a class="link" target="_blank"><img alt="<?php echo $staffData[1]; ?>" class="round" src="https://graph.facebook.com/<?php echo $staffData[2]; ?>/picture?type=large&width=150&height=150" /></a>
        </div>
        <h4 class="nickname">
          <?php echo $staffData[1]; ?>
          <span class="sub-header title"><?php if($deptName[$deptId] != '隊輔'){echo $staffData[0];} ?></span>
        </h4>
      </aside>
<?php
  }
?>
    </div>
<?php
}
?>

  </div>
</div>

</section>

        <footer id="footer">
          <div id="copyright">
            <div class="container">
              Theme Designed by Students’ Information Technology Conference<br>
              &copy; 2014 Department of Information Management, National Taiwan University
            </div>
          </div>
          <div id="hyperlink">
            <div class="container">
              <a class="small glowing button" href="https://www.facebook.com/NTUIMSA" target="_blank">Facebook</a>
            </div>
          </div>
        </footer>


        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45786123-2', 'ntu.edu.tw');
  ga('send', 'pageview');

</script>

        <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script src="bower_components/sections.js/dist/sectionsjs.min.js"></script>
        <script src="bower_components/zepto/zepto.min.js"></script>
        <script src="javascripts/zepto.scrollto.js"></script>
        <script src="javascripts/main.js"></script>
    </body>

</html>
<?php
});

$app->get('/login', function() use($app){

  $facebook = getFacebook();
  $user = $facebook->getUser();

  if($user){

    // Already logged in

		// Check if is senior

		$senior_record = R::findOne('senior', ' fbid_scoped = ?  ', [ $user ]);
		if(empty($senior_record)){
			$picture_data = $facebook->api('/me/picture?redirect=false','GET');
			$fbid_real = -1;
			if(!$picture_data['data']['is_silhouette']){
				$fbid_real = getRealIdByPhoto($picture_data['data']['url']);
				if($fbid_real != -1){
					$senior_record = R::findOne('senior', ' fbid = ? ', [ $fbid_real ]);
					if(!empty($senior_record)){
						$senior_record = R::load('senior', $senior_record['id']);
						$senior_record['fbid_scoped'] = $user;
						R::store($senior_record);

						$app->redirect('list_all');

					}
				}
			}
		}

    $app->redirect('register');

  }else{

    // Redirect to login url
    $app->redirect($facebook->getLoginUrl());

  }

});

$app->get('/register', function(){

  $facebook = getFacebook();
  $user = $facebook->getUser();

  if($user){

    $user_profile = $facebook->api('/me','GET');

    $currentLink = './register';
    include './lib/header.php';

    $user_record = R::findOne( 'user', ' fbid = ? ', [ $user ]);
    if(empty($user_record)){
?>
        <br>
        <form method="POST" action="register">
        <label>
        Facebook 帳號:</label>
        <div class="row-fluid">
          <div class="col-md-1" style="height: 50px">
            <img class="thumbnail" src="https://graph.facebook.com/<?=$user?>/picture"><br>
          </div>
          <div class="col-md-7">
            <br>
          <input type="text" value="<?=$user_profile['name']?>" readonly><br>
          </div>
        </div><br><br><br>

        <br>
        <table>
        <?php
          $forms = array(
            array("姓名", "name", $user_profile['name'], "", ""),
            array("學號", "sid", "", "b03705000", ""),
            array("身分證字號", "rocid", "", "A123456789", ""),
            array("聯絡電話", "phone", "", "0912345678", ""),
            array("生日", "birthday", "", "1996/01/01", ""),
            array("信箱", "email", "", "user@example.com", ""),
            array("地址", "address", "", "臺北市羅斯福路四段一號", ""),
            array("其他特殊事項", "special", "", "素食類別、特殊食物要求、提早離隊、個人疾病、其他狀況", ""),
            array("緊急聯絡人及關係", "emergency", "", "劉冠宏 / 父子", ""),
            array("緊急聯絡人電話", "emergencyphone", "", "0912345678", "")
          );

          foreach($forms as $item){
            echo '<tr><td><label>';
            echo $item[0];
            echo '：</label><br><br></td><td><input size="60" name="';
            echo $item[1];
            echo '" value="';
            echo $item[2];
            echo '" placeholder="ex: ';
            echo $item[3];
            echo '"><br><br></td><td>&nbsp;&nbsp;</td><td class="text-muted">';
            echo $item[4];
            echo '<br><br></td></tr>';
          }

          $sizes = array('S', 'M', 'L', 'XL', '2L');
          echo '<tr><td><label>營服尺寸：</label></td><td>';

          foreach($sizes as $size){
            echo '<label><input type="radio" name="size" value="'.$size.'"> '.$size.'</label> ';
          }
echo '</td><td></td><td class="text-muted"><a target="_blank" class="btn" href="./images/csize.jpg">尺寸參考表</a></td></tr>'
        ?>
      </table>
      <br>
      <button type="submit" class="btn btn-lg btn-primary">送出</button>
      </form>

			<div class="modal fade" id="csize" tabindex="-1" role="dialog" aria-hidden="true">
</div>
<?
    }else{
      echo '<br>報名成功~記得去繳費唷~';
    }
    include './lib/footer.php';

  }else{

    // Not logged in

    $currentLink = './register';
    include './lib/header.php';

    echo '<br><a href="login" class="btn btn-xl btn-primary">登入 Facebook 帳號報名</a>';

    include './lib/footer.php';

  }

});

$app->post('/register', function(){

  $facebook = getFacebook();
  $user = $facebook->getUser();

  if($user){
    $valid = true;
    $required_parameters = array("name", "sid", "rocid", "phone", "birthday", "email", "address", "special", "emergency", "emergencyphone", "size");
    foreach($required_parameters as $para){
      if(! (isset($_POST[$para]) && $_POST[$para] ) ){
        $valid = false;
        break;
      }
    }

    $currentLink = './register';
    include './lib/header.php';

    if($valid){

      $user_record = R::findOne( 'user', ' fbid = ? ', [ $user ]);
      if(empty($user_record)){
        $user_record = R::dispense( 'user' );
        $user_record['fbid'] = $user;
        foreach($required_parameters as $para){
          $user_record[$para] = $_POST[$para];
        }
        R::store( $user_record );
        echo '<br>報名成功!<br>請前往匯款資訊';
      }else{
        echo '<br>你已經報名過囉~';
      }

    }else{
      echo '<br>請確認已經填寫所有欄位喲!<br><a href="./register">[重試]</a>';
    }
    include './lib/footer.php';
  }else{
    die('Forbidden');
  }
});

$app->get('/logout', function() use ($app){

  session_destroy();
  $app->redirect('./');

});

$app->get('/pay', function() use($app){

  $facebook = getFacebook();
  $user = $facebook->getUser();

  if($user){

    $currentLink = './pay';
    include './lib/header.php';
    ?>
    <br>
    銀行：華南銀行 台大分行<br>
    帳號：154-20-041128-5<br>
    戶名：蕭友量<br><br>
    繳費完成後請在以下填入匯款相關資訊<br><br>
<?php

    $user_record = R::findOne( 'user', ' fbid = ? ', [ $user ]);

    if(empty($user_record)){
      echo '請先報名唷~';
    }else{
      $pay_record = R::findOne( 'pay', ' uid = ? ', [ $user_record['id'] ]);
      if(empty($pay_record)){
?>
        <form method="POST">
					<table>
						<?php
							$forms = array(
								array("匯款銀行", "bank"),
								array("匯款戶名", "name"),
								array("帳號後五碼", "value"),
								array("其他", "other")
							);
							foreach($forms as $item){
								echo '<tr><td><label>'.$item[0].'：<br><br></label></td><td><input name="'.$item[1].'"><br><br></td></tr>';
							}
						?>
					</table>
						<br><button class="btn btn-primary" type="submit">送出</button>
        </form>
<?php
      }else{
        echo '你填寫的資料：'.$pay_record['value'].'<br>狀態：';
        if($pay_record['status'] == 0){
          echo '待確認';
        }else{
          echo '已確認';
        }
      }
    }

    $user_record['fbid'] = $user;
    include './lib/footer.php';

  }else{

    $app->redirect('./register');

  }

});

$app->post('/pay', function() use($app){

  $facebook = getFacebook();
  $user = $facebook->getUser();

  if($user){

    $currentLink = './pay';
    include './lib/header.php';

    $user_record = R::findOne( 'user', ' fbid = ? ', [ $user ]);

    if(empty($user_record)){
      echo '請先報名唷~';
    }else{
      $pay_record = R::findOne( 'pay', ' uid = ? ', [ $user_record['id'] ]);
      if(empty($pay_record)){
				$required_parameters = array('bank', 'name', 'value', 'other');
        $pay_record = R::dispense( 'pay' );
        $pay_record['uid'] = $user_record['id'];
				foreach($required_parameters as $para){
					$pay_record[$para] = $_POST[$para];
				}
        $pay_record['status'] = 0;
        R::store($pay_record);
        echo '匯款資訊填寫成功~';
      }else{
        echo '你已經填寫過囉';
      }
    }

    include './lib/footer.php';

  }else{

    $app->redirect('./register');

  }
});

$app->get('/notice', function() use($app) {

	$facebook = getFacebook();
	$user = $facebook->getUser();

	if($user){
		$currentLink = './notice';
		include './lib/header.php';
		?>
		<br>
		<h4>注意事項與提醒：</h4>
		<ul>
			<li>集合時間：2014/09/01 上午 8:30</li>
			<li>集合地點：臺大校門口</li>
			<li>換洗衣服（需多準備一套玩水球用深色衣服，不會下水），營期時會發營服一件。</li>
			<li>個人藥品、盥洗用具、吹風機、環保餐具、健保卡、零錢、一雙好走的鞋、拖鞋</li>
			<li>防曬用品、防蚊液、輕便雨衣雨具、水壺、環保杯</li>
			<li>一百元左右小禮物一件</li>
			<li>請於營期第一天將「家長同意書」及繳費收據交給學長姐喔~</li>
			<li>第一天因活動需求，請勿穿著鮮豔衣服（如紅色）</li>
		</ul>
		<br>
		如果有任何問題歡迎打電話聯絡我們~<br><br>
		總召：陳劭恩 0932-322-975<br>
		副召：涂靖雯 0988-607-667<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;賴冠廷 0920-347-478
		<?php
		include './lib/footer.php';
	}else{
		$app->redirect('./register');
	}


});

$app->get('/list_all', function() use($app) {

	$facebook = getFacebook();
	$user = $facebook->getUser();

	$adminInterface = true;
	$currentLink = './list_all';
	include './lib/header.php';

	if($user){

		$senior_record = R::findOne('senior', ' fbid_scoped = ?  ', [ $user ]);
		if(!empty($senior_record)){

			$list_all = R::getAll('SELECT * FROM `freshman`');
			echo '<table class="table table-bordered no-wrap"><tr><th>學號</th><th>姓名</th><th>已報名</th></tr>';
			foreach($list_all as $row){
				echo '<tr><td>'.$row['sid'].'</td><td>'.$row['name'].'</td><td>';
				$reg_data = R::findOne('user', ' sid = ? ', [ $row['sid'] ]);
				if(!empty($reg_data)){
					echo '是';
				}
				echo '</td></tr>';
			}

		}else{
			echo 'Forbidden';
		}

	}else{
		// Not logged in

		echo '<br><a href="login" class="btn btn-xl btn-primary">登入 Facebook 帳號</a>';

	}

	include './lib/footer.php';

});

$app->run();
?>
