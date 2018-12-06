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

	$getId=$_GET['id'];
	$getId=strip_tags($getId);
	$getId=($getId=='')?1:trim($getId);
	$aid=$getId;
	
	
		if(isset($_POST['title'])&&isset($_POST['address'])&&isset($_POST['content'])){
			$title=strip_tags($_POST['title']);
			$address=strip_tags($_POST['address']);
			$content=strip_tags($_POST['content']);
			$_SESSION['member']['mid'];
			
			$db=new DB();//UPDATE MyGuests SET lastname='Doe' WHERE id=2
			$result=$db->query("UPDATE  article SET  
						aTitle='".$title."',
						aSubtitle='".$address."',
						aContent='".$content."',
						amemberId='".$_SESSION['member']['mid']."' WHERE aId=".$aid);	
			header("Location: upload/index.php?aid=".$aid);	
		}
	
	$db=new DB();
	$result=$db->query("SELECT * FROM article JOIN member ON amemberId=mId 
											LEFT JOIN comment ON aId=carticleId  WHERE aId=".$getId);
	$article=$db->get_fetch($result);	
	$a=$article;
	
	
	$result=$db->query("SELECT iName FROM article LEFT JOIN image ON aId=iarticleId WHERE aId=".$getId);
	$image=$db->get_array($result);	
	
	
	
	$result=$db->query("SELECT * FROM comment JOIN member ON cmemberId=mId 											
											  WHERE carticleId=".$getId);
	$comment=$db->get_array($result);	

/*$img=array("iName"=>"900x300.png");
$article=array(
array("aId"=>"1","aTitle"=>"Man must explore, and this is exploration at its greatest","aContent"=>"<p class='lead'>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>","aAuthor"=>"Ronghong","aDate"=>"2014-9-24 13:40:25")
	);*/

/*$comment=array(array(
"cAuthor"=>"Start Bootstrap",
"cContent"=>"Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.",
"cDate"=>"2014-8-25 21:30:00",
"artId"=>"1"),array(
"cAuthor"=>"Start Bootstrap",
"cContent"=>"Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.",
"cDate"=>"2014-8-25 21:30:00",
"artId"=>"1")); */
?>

<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keyword" content="中午'午飯'吃飯'小吃攤'店家'<?php echo $a['aTitle'];?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $a['aTitle'];?>-後台</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    
    <link href="css/imageChange.css" rel="stylesheet">
    <style >
	div#map-canvas {
	height: 320px;
	width: 70%;
	margin: 0 auto;
	padding: 0px
	}
	</style>
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    
    <script type="text/javascript"  src="js/imageChange.js"></script>
    
    <script type="text/javascript"  src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript">
$().ready(function(){
	$('#address').click(function(){
		$('#map-canvas').toggle();
	});	
});


function send_comment(aid,mid){
	var comment=$("#comment_text").val();
	
	$.ajax({
					 url: 'jq_ajax.php',
					 cache: false,
					 dataType: 'html',
					 type:'POST',
					 data: {comment: comment,
					 		aid: aid,
							mid: mid },
					 error: function(xhr) {
					   //alert('您好');
					 },
					 success: function(response) {
						 //alert('您好'+response);
							   location.reload();
							   
							   //$("#commentdiv").load(location.href + " #commentdiv");
					 }
		});
}



function initialize() {		
	var addr=$('#address').text();
	//loc=addressToLatLng(addr);
	
	 var geocoder = new google.maps.Geocoder();
		geocoder.geocode({
			"address": addr
		}, function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				//var content = $("#target").val();
			   // $("#target").val(content + addr + results[0].geometry.location.lat() + "," + results[0].geometry.location.lng() + "\n");
			   
			   
			   $("#lat").text(results[0].geometry.location.lat());
			   $("#lng").text(results[0].geometry.location.lng());
			   test1(results[0].geometry.location.lat(),results[0].geometry.location.lng());
			   
			} else {
				$("#lat").text("查無經緯度");
				loc="查無經緯度";
				
				//var content = $("#target").val();
				//$("#target").val(content + addr + "查無經緯度" + "\n");
			}
		});
	
	
	
}

google.maps.event.addDomListener(window, 'load', initialize);

function test1(lat,lng){	
	//var lat=$('#lat').text();
	//var lng=$('#lng').text();	

	var mapOptions = {
		 zoom: 14,
		 center: new google.maps.LatLng( $('#lat').text() , $('#lng').text() ),
		 mapTypeId: google.maps.MapTypeId.ROADMAP
	 }
 
 	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	
	
	/*非同步載入（Asynchronously Loading）API

如果想要使用非同步載入的方式，讓 Google 地圖的 API 延後載入，不要讓 API 拖慢整體網頁的速度，可以使用下面這樣的方式：*/
	function loadScript() {
	  var script = document.createElement('script');
	  script.type = 'text/javascript';
	  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp' +
		  '&signed_in=true&callback=initialize';
	  document.body.appendChild(script);
	}	
	window.onload = loadScript;
	
		
	
	var ti=$('.h4_title').text();
		
		var contentString = "<div id='div-pin'><div>" + ti + "</div><div><img src=''></img></div></div>";
				
		var location = new google.maps.LatLng( lat , lng );
					
		var marker = new google.maps.Marker({
			position: location,
			map: map
		});
				//var j = i + 1;
				//marker.setTitle(j.toString());
			
		marker.setTitle( $('.h4_title').text().toString() );	
	
	
	// The five markers show a secret message when clicked
// but that message is not within the marker's instance data.
	var infowindow = new google.maps.InfoWindow(
      { //content: message[number],
		content: contentString,
        size: new google.maps.Size(50,50)
      });
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);	
  });
  				
				//attachSecretMessage(marker, i, contentString);
		
}

function addressToLatLng(addr) {
				//var location = new array("","");
				var loc;
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    "address": addr
                }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        //var content = $("#target").val();
                       // $("#target").val(content + addr + results[0].geometry.location.lat() + "," + results[0].geometry.location.lng() + "\n");
					   $("#lat").text(results[0].geometry.location.lat());
					   $("#lng").text(results[0].geometry.location.lng());
					   loc=results[0].geometry.location;
					   
                    } else {
						$("#lat").text("查無經緯度");
						loc="查無經緯度";
						
                        //var content = $("#target").val();
                        //$("#target").val(content + addr + "查無經緯度" + "\n");
                    }
                });
				
				return loc;
}
			/*function trans() {
                i = 0;
                $("#target").val("");
                var content = $("#source").val();
                split = content.split("\n");
                delayedLoop();
            }

            function delayedLoop() {
                addressToLatLng(split[i]);
                if (++i == split.length) {
                    return;
                }
                window.setTimeout(delayedLoop, 1500);
            }*/

            

</script>		
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
        
        <form action='' id='form_add' method='post'>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">午食行部落NoonFood編輯文</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
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

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>文章標題</h1>
                <div class="input-group">
                        <input type="text" class="form-control" name="title" value="<?php echo $a['aTitle'];?>">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" >
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                </div>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo date_format(new DateTime($a['aDate']),"d F, Y");?> at <?php echo date_format(new DateTime($a['aDate']),"h:i A");?></p>

                <hr>

                <!-- Preview Image --> 
                <!--<h3>上傳圖片</h3>
                <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" >
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                </div>-->
                <div id="abgneBlock">
					<ul class="list">
						<?php foreach($image as $img){ if($img['iName']=='')break; for($i=0;$i<3;$i++){?>
                        <li><a target="_blank" href="img/<?php echo $img['iName'];?>"><img class="img-responsive" src="img/<?php echo $img['iName'];?>" alt=""></a></li>
                        <?php } } ?>
                    </ul>
				</div>

                <hr>
                
                
                
                 <!-- Google Map API and location address -->    
                <h3>地址</h3>              
                 <div class="input-group">
                        <input type="text" class="form-control" name="address" value="<?php echo $a['aSubtitle'];?>">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" >
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                </div>
                <div id="map-canvas">
                			<span id="lat"></span>
        					<span id="lng"></span>
                </div>
                <hr>
                
                
                <!-- Post Content -->
                <?php echo nl2br(str_replace(' ','&nbsp;',$a['aContent']));?>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>內容CONTENT:</h4>
                    
                        <div class="form-group">
                            <textarea class="form-control" rows="3"  id="comment_text"  name="content"><?php echo str_replace(' ','&nbsp;',nl2br($a['aContent']));?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" onClick="">Submit</button>
                    
                </div>
</form>
                <hr>

                
            </div>

            
        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; hellorh 2015 by Ronghong</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
