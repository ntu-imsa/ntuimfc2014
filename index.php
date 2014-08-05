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
  define("ACTITLE","台大資管迎新宿營");
  define("DESCRIPTION", "所以想要參加宿營，想要提早認識大家，想要認識更多學長姐的不要再猶豫，快去報名吧！");
?>
        <meta name="description" content="<?php echo DESCRIPTION; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta property="og:title" content="<?php echo ACTITLE; ?>">
        <meta property="og:type" content="website">
        <meta property="og:url" content="index.html">
        <meta property="og:image" content="icon-2014-special.jpg">
        <meta property="og:site_name" content="<?php echo ACTITLE; ?>">
        <meta property="og:description" content="<?php echo DESCRIPTION; ?>">

        <meta property="twitter:title" content="<?php echo ACTITLE; ?>">
        <meta property="twitter:description" content="<?php echo DESCRIPTION; ?>">
        <meta property="twitter:image:src" content="icon-2014-special.jpg">
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
            比的時資益道性為資，止決關印機：利隨勢來見事半作長、成早確機會中作言走成國？
            紅路費受這情具時孩麼來把他向提國去灣歌科？以出著機面到小少養感！
            業型決世分，的間她只我金政止師，轉實轉隨道見金經兒令組，有往把大連業員，友代說黃興好經且起統地拿速候著告懷口旅變部，兒都亞了日，滿了大……他到我思我具光！
            帶什實星說被眼北良心年上東慢王。的能難區花失基打權感思產腦友國輕。
          </p>

          <p>
            易看紙。城元此；界開史的，國然兒作樹即現許、我富和心得答檢候仍最導國年到散注星車種出？
            麼真業之士參面，小方大驗……對係人金；標紅比下作爸稱。
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
        <span class="date">2014 年 8 月 X 日 /</span><span class="location"> 台灣大學</span>
      </div>
      <div class="sitcon-jiang">
        <img id="sitcon-jiang-at-map" src="images/sitcon_at_map.png" width="177" height="463" alt="SITCON 醬 Q 版" />
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
                        <td rowspan="2" class="session block"><h4>早餐</h4></td>
                        <td rowspan="2" class="session block"><h4>早餐加菜</h4></td>
                      </tr>
                      <tr>
                        <th class="session block">08:30</th>
                        <td rowspan="2" class="session block"><h4>在台大集合<br>前往營地</h4></td>
                      </tr>
                      <tr>
                        <th class="session block">09:00</th>
                        <td rowspan="3" class="session block"><h4>王者之爭</h4></td>
                        <td rowspan="3" class="session block"><h4>消失的杜蘭先生</h4><div class="detail">
    <p>杜蘭先生消失惹</p> <p>名立嗎成現家了腳好，治我一才少獨戰一的要！片孩讓容化？家一場標西到得然相請工這一流內業善、燈入兩，也構樣以一源機些新是石成使種足讓良。見團經黃年著此再院現一這全任突？</p>

  </div>
</td>
                      </tr>
                      <tr>
                        <th class="session block">10:00</th>
                        <td class="session block"><h4>測試實力之<br>轟炸島嶼</h4></td>
                      </tr>
                      <tr>
                        <th class="session block">12:00</th>
                        <td class="session block"><h4>盛宴的準備</h4></td>
                      </tr>
                      <tr>
                        <th class="session block">13:30</th>
                        <td colspan="3" class="session block"><h4>午餐</h4></td>
                      </tr>
                      <tr>
                        <th class="session block">14:30</th>
                        <td class="session block"><h4>訓練中心</h4></td>
                        <td class="session block"><h4>饑餓遊戲</h4></td>
                        <td class="session block"><h4>Show Time!</h4></td>
                      </tr>
                      <tr>
                        <th class="session block">17:30</th>
                        <td class="session block"><h4>晚餐</h4></td>
                        <td rowspan="3" class="session block"><h4>燃燒的螢火</h4></td>
                        <td class="session block"><h4>賦歸</h4></td>
                      </tr>
                      <tr>
                        <th class="session block">19:00</th>
                        <td class="session block"><h4>盛宴嘉年華</h4></td>
                      </tr>
                      <tr>
                        <th class="session block">19:00</th>
                        <td class="session block"><h4>那棟大樓的秘密</h4></td>
                      </tr>
                      <tr>
                        <th class="session block">22:00</th>
                        <td colspan="2" class="session block"><h4>宵夜與小隊時間</h4></td>
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

      <aside class="sponsor">
        <div class="logo">
          <a href="#" target="_blank"><img src="images/sponsors/archilife.png" /></a>
        </div>
        <h3>
          Paul Gomez Hopkins
          <span class="sub-header">險制寶一南子邊在關</span>
        </h3>
      </aside>

      <aside class="sponsor">
        <div class="logo">
          <a href="#" target="_blank"><img src="images/sponsors/kktix.png" /></a>
        </div>
        <h3>
          發源祥
          <span class="sub-header">產生收一土他</span>
        </h3>
      </aside>

      <aside class="sponsor">
        <div class="logo">
          <a href="#" target="_blank"><img src="images/sponsors/justfont.png" /></a>
        </div>
        <h3>
          Curry 義優順
          <span class="sub-header">腦心們中色錢基談預部帶車叫</span>
        </h3>
      </aside>

    </div>
    <div class="container">
      <div class="inline list">
        <h3 class="inline header">特別感謝</h3>
        <span class="inline sponsor">宏浩光和有限公司</span>
      </div>
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
  array('總召','陳劭恩','https://graph.facebook.com/100000230048556/picture?type=large&width=150&height=150'),
  array('副召','涂靖雯','https://graph.facebook.com/jingwen.tu/picture?type=large&width=150&height=150'),
  array('副召','賴冠廷','https://graph.facebook.com/100002315801969/picture?type=large&width=150&height=150')
);

$deptData[] = array(
  array('總召','陳劭恩','https://graph.facebook.com/100000230048556/picture?type=large&width=150&height=150'),
  array('副召','涂靖雯','https://graph.facebook.com/jingwen.tu/picture?type=large&width=150&height=150'),
  array('副召','賴冠廷','https://graph.facebook.com/100002315801969/picture?type=large&width=150&height=150')
);

$deptData[] = array(
  array('活動部 部長','胡哲愷','https://graph.facebook.com/100000230048556/picture?type=large&width=150&height=150'),
  array('活動部 副部長','梁暉義','https://graph.facebook.com/jingwen.tu/picture?type=large&width=150&height=150'),
  array('庶務部 部長','李慶宏','https://graph.facebook.com/100000230048556/picture?type=large&width=150&height=150'),
  array('庶務部 副部長','冷俊瑩','https://graph.facebook.com/jingwen.tu/picture?type=large&width=150&height=150'),
  array('美宣部 部長','劉育婷','https://graph.facebook.com/100000230048556/picture?type=large&width=150&height=150'),
  array('美宣部 副部長','陳君儒','https://graph.facebook.com/jingwen.tu/picture?type=large&width=150&height=150'),
  array('公關部 部長','朱瑤章','https://graph.facebook.com/100000230048556/picture?type=large&width=150&height=150'),
  array('公關部 副部長','楊大為','https://graph.facebook.com/jingwen.tu/picture?type=large&width=150&height=150'),
  array('器材部 部長','江孟軒','https://graph.facebook.com/100000230048556/picture?type=large&width=150&height=150'),
  array('資訊部 部長','虞翔皓','https://graph.facebook.com/lolicon.fish/picture?type=large&width=150&height=150'),
  array('資訊部 副部長','宋欣馨','https://graph.facebook.com/jingwen.tu/picture?type=large&width=150&height=150')
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
          <a class="link" target="_blank"><img alt="<?php echo $staffData[1]; ?>" class="round" src="<?php echo $staffData[2]; ?>" /></a>
        </div>
        <h4 class="nickname">
          <?php echo $staffData[1]; ?>
          <span class="sub-header title"><?php echo $staffData[0]; ?></span>
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

    $app->redirect('register');

  }else{

    // Redirect to login url
    $app->redirect($facebook->getLoginUrl());

  }

});

$app->get('/register', function(){

  $facebook = getFacebook();

});

$app->post('/register', function(){

  //

});

$app->get('/logout', function() use ($app){

  session_destroy();
  $app->redirect('./');

});

$app->run();
?>
