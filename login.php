<?php
/*<!--************************************************************-->
<!--*******Start Bootstrap Free Bootstrap Themes & Templates******-->
<!--********參考程式至http://startbootstrap.com/******************-->
<!--************./template-overviews/blog-post/*****************-->
<!--*****************2015/7/17******************************-->
<!--**********************************************************-->*/

	session_start();
	ob_start();
	if(isset($_SESSION['member'])&&trim($_SESSION['member']['us'])!='')
			header("Location: add_article.php");

	
	if(isset($_POST['us'])&&isset($_POST['pw'])&&trim($_POST['pw'])!=''&&trim($_POST['pw'])!=''){		
		
		$us=strip_tags($_POST['us']);
		$us=trim($us);
		$pw=strip_tags($_POST['pw']);
		$pw=trim($pw);
		$pw=md5($pw);
		
		$message="-hello";
		require_once("models/dbModel.php");
		$db=new DB();
		$result=$db->query("SELECT * FROM member WHERE 1");	
		$mem=$db->get_array($result);	
		if(!empty($us)&&!empty($pw)){		
		
			foreach($mem as $v){
				if($v['mUsername']==$us)
					if($v['mPassword']==$pw){
						$_SESSION['member']['us']=$us;
						$_SESSION['member']['pw']=$pw;
						$_SESSION['member']['mid']=$v['mId'];
						header("Location: ./edit_index.php");
					}
			}
			$message="Username or password error!!";
		}else{			
			$message="There are field nulls!!";
		}
		$message="Your are login,now";
	}
	if(isset($_GET['id'])&&trim($_GET['id'])=='logout'){
		session_destroy();
		header("Location: index.php");
		$message="Your are logout,now";
	}
	ob_flush();
	
	
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

    <title>後臺管理</title>

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
                <a class="navbar-brand" href="#">午食行部落NoonFood<?php echo $message;?></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.php">首頁</a>
                    </li>
                    <li>
                        <a href="article.php">吃文章</a>
                    </li>
                    <li>
                        <a href="">POST</a>
                    </li>
                    <li>
                        <a href="">Sample Post</a>
                    </li>
                    <li>
                        <a href="">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/contact-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1><a  id='a_rand' >登入?</a></h1>
                        <hr class="small">
                        <span class="subheading">
                        </span>
                    </div>
                    		
                </div>
            </div>
        </div>
        					
    </header>
							<form method="post" action="#">
                            	<a  id='a_rand' >Username</a><input type="text" name="us"/>
                                <a  id='a_rand' >Password</a><input type="password" name="pw"/>   
                                <input type="submit" value="OKOK"/>                             
                        	</form>
   

    
</body>

</html>
