<?php
session_start();
if(!isset($_SESSION['member'])||trim($_SESSION['member']['us'])=='')
		header("Location: login.php?id=logout");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>jQuery+php实现ajax文件上传</title>
<link rel="stylesheet" type="text/css" href="../css/main.css" />
<style type="text/css">
.demo{width:620px; margin:30px auto}
.demo p{line-height:32px}
.btn{position: relative;overflow: hidden;margin-right: 4px;display:inline-block;*display:inline;padding:4px 10px 4px;font-size:14px;line-height:18px;*line-height:20px;color:#fff;text-align:center;vertical-align:middle;cursor:pointer;background-color:#5bb75b;border:1px solid #cccccc;border-color:#e6e6e6 #e6e6e6 #bfbfbf;border-bottom-color:#b3b3b3;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;}
.btn input {position: absolute;top: 0; right: 0;margin: 0;border: solid transparent;opacity: 0;filter:alpha(opacity=0); cursor: pointer;}
.progress { position:relative; margin-left:100px; margin-top:-24px; width:200px;padding: 1px; border-radius:3px; display:none}
.bar {background-color: green; display:block; width:0%; height:20px; border-radius: 3px; }
.percent { position:absolute; height:20px; display:inline-block; top:3px; left:2%; color:#fff }
.files{height:22px; line-height:22px; margin:10px 0}
.delimg{margin-left:20px; color:#090; cursor:pointer}
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>
</head>

<body>
<div id="header">
   <div id="logo"><h1><a href="../edit_index.php" title="返回新增页">修改結束</a></h1></div>
</div>

<div id="main">
   <h2 class="top_title"><a href="http://www.helloweba.com/view-blog-189.html">jQuery+php实现ajax文件上传</a></h2>
   <div class="demo">
   <input type="file"><br/>
   		<p>说明：示例中只允许上传gif/jpg格式的图片，图片大小不能超过500k。</p>
   		<div class="btn">
            <span>添加附件</span>
            <input id="fileupload" type="file" name="mypic">
        </div>
        <div class="progress">
    		<span class="bar"></span><span class="percent">0%</span >
		</div>
        <div class="files"></div>
        <div id="showimg"></div>
   </div>
</div>

<script type="text/javascript">
$(function () {
	var bar = $('.bar');
	var percent = $('.percent');
	var showimg = $('#showimg');
	var progress = $(".progress");
	var files = $(".files");
	var btn = $(".btn span");
	$("#fileupload").wrap("<form id='myupload' action='action.php?aid="+ <?php echo $_GET['aid'];?> +"' method='post' enctype='multipart/form-data'></form>");
    $("#fileupload").change(function(){
		$("#myupload").ajaxSubmit({
			dataType:  'json',
			beforeSend: function() {
        		showimg.empty();
				progress.show();
        		var percentVal = '0%';
        		bar.width(percentVal);
        		percent.html(percentVal);
				btn.html("上传中...");
    		},
    		uploadProgress: function(event, position, total, percentComplete) {
        		var percentVal = percentComplete + '%';
        		bar.width(percentVal);
        		percent.html(percentVal);
    		},
			success: function(data) {
				if(data!=null){			//若有上傳的資料就執行
					files.html("<b>上傳成功-"+data.name+"("+data.size+"k)</b> <span class='delimg' rel='"+data.pic+"'>删除</span>");
					var img = data.pic;
					showimg.html("<img src='../img/"+img+"'>");
				}else{
					files.html("<b></b> <span class='delimg' rel=''></span>");
					var img = '';
					showimg.html("<img src=''>");
					progress.hide();
				}
				btn.html("添加附件");
			},
			error:function(xhr){
				btn.html("上传失败");
				bar.width('0')
				files.html(xhr.responseText);
			}
		});
	});
	
	$(".delimg").live('click',function(){
		var pic = $(this).attr("rel");
		$.post("action.php?act=delimg",{imagename:pic},function(msg){
			if(msg==1){
				files.html("删除成功.");
				showimg.empty();
				progress.hide();
			}else{
				alert(msg);
			}
		});
	});
});
</script>

<br><br><br><br><br><br><br><br><br><br><br><br>

<div id="footer">
    <p>Powered by helloweba.com  允许转载、修改和使用本站的DEMO，但请注明出处：<a href="http://www.helloweba.com">www.helloweba.com</a></p>
</div>
<p id="stat"><script type="text/javascript" src="http://js.tongji.linezing.com/1870888/tongji.js"></script></p>
</body>
</html>