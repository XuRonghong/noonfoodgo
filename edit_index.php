<?php
/*<!--************************************************************-->
<!--*******Start Bootstrap Free Bootstrap Themes & Templates******-->
<!--********參考程式至http://startbootstrap.com/******************-->
<!--************./template-overviews/blog-post/*****************-->
<!--*****************2015/7/17******************************-->
<!--**********************************************************-->*/
session_start();
if(!isset($_SESSION['member'])||trim($_SESSION['member']['us'])=='')
		header("Location: login.php?id=logout");
		
		
		
	require_once("models/dbModel.php");
	
	
	$db=new DB();
	$result=$db->query("SELECT * FROM article LEFT JOIN member ON amemberId=mId ");
	$article=$db->get_array($result);	
	
	
	//亂數產生文章編號
	foreach($article as $v){
		if($v['aId']=='')break;
		$aidArray[]=$v['aId'];
	}
	$rand_aid = $aidArray[ rand(0,count($aidArray)-1) ];

/*$img=array("iName"=>"home-bg.jpg");
$article=array(array("aId"=>"1","aTitle"=>"Man must explore, and this is exploration at its greatest","aSubtitle"=>"Problems look mighty small from 150 miles up","aAuthor"=>"Ronghong","aDate"=>"2014-9-24"),
	array("aId"=>"2","aTitle"=>"I believe every human has a finite number of heartbeats. I don't intend to waste any of mine.","aSubtitle"=>"Problems look mighty small from 150 miles up","aAuthor"=>"Ronghong","aDate"=>"2014-9-18"),
	array("aId"=>"3","aTitle"=>"Science has not yet mastered prophecy","aSubtitle"=>"We predict too much for the next year and yet far too little for the next ten.","aAuthor"=>"Ronghong","aDate"=>"2014-8-24"),
	);*/
	
	
?>

<!DOCTYPE html>
<html >
<head>
<!--************************************************************-->
<!--*******Start Bootstrap Free Bootstrap Themes & Templates******-->
<!--********參考程式至http://startbootstrap.com/******************-->
<!--************./template-overviews/blog-post/*****************-->
<!--*****************2015/7/17******************************-->
<!--**********************************************************-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keyword" content="中午'午飯'吃飯'小吃攤'店家">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>午食行部落-後台</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/clean-blog.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <!--<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script type="text/javascript">/*
	
	$('#a_rond').click(function(){
		location.reload();
		alert('haha');
		return false;
	});
	*/
	function relo(){
		document.location.href='article.php?id=<?php echo $rand_aid;?>';
		//alert('haha');
		//return false;
	}
	
	</script>

</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">午食行部落NoonFood後台-全部文章</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="edit_index.php">首頁</a>
                    </li>
                    <li>
                        <a href="add_article.php">新增文章</a>
                    </li>
                    <li>
                        <a href=""></a>
                    </li>
                    <li>
                        <a href=""><?php echo $_SESSION['member']['us'];?></a>
                    </li>
                    <li>
                        <a href="login.php?id=logout">登出管理</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/post-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1><a  id='a_rand' onClick="">要吃甚麼?</a></h1>
                        <hr class="small">
                        <span class="subheading">What to eat for lunch? I refer to a Clean Blog Theme by NFG</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <?php foreach($article as $a){?>
          		<div class="post-preview">
                    <a href="edit_article.php?id=<?php echo $a['aId'];?>">
                        <h2 class="post-title">
                            <?php echo $a['aTitle'];?>
                        </h2>
                        <h3 class="post-subtitle">
                            <?php echo $a['aSubtitle'];?>
                        </h3>
                    </a>
                    <p class="post-meta">Posted by <a href="#"><?php echo $a['mName'];?></a> on <?php echo date_format(new DateTime($a['aDate']),"d F ,Y");?></p>
                </div>
                <hr>
                <?php } ?>                
                
                <!-- Pager -->
                <ul class="pager">
                    <li class="next">
                        <a href="#">Next Page &rarr;</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <hr>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; hellorh 2015 by Ronghong</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/clean-blog.min.js"></script>

</body>

</html>
