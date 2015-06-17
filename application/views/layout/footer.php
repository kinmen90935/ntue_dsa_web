<div id="footer">
    校址：10671臺北市大安區和平東路二段134號 總機電話：+886-2-2732-1104 +886-2-6639-6688<br>
    本站最佳瀏覽解析度為   1024*768建議使用IE8以上版本瀏覽器
    <a href="#checkBroser" id="browsers">版本檢驗</a>
    <a class="various" title="後臺管理" rel="後臺管理" href="#login_form" style="background: url(images/Admin-icon.png) no-repeat 6px center;padding-left: 40px;">後臺管理</a><br>
CopyRight 2014 National Taipei University of Education. All Rights Reserved. | Powered By Yong Huang</p>
</div>
</div>
<div id="checkBroser" style="width:500px; display:none;">
    <ul>您的瀏覽器版本過舊，為了最佳瀏覽建議下載其他瀏覽器，若作業系統為XP建議下載google Chrome 或者 FireFox
        <li><a href="http://windows.microsoft.com/zh-tw/internet-explorer/download-ie" target="_blank">IE10+</a></li>
        <li><a href="http://www.google.com/intl/zh-TW/chrome/" target="_blank">google chrome</a></li>
        <li><a href="http://moztw.org/firefox/" target="_blank">火狐firefox</a></li>
    </ul>
</div>
<div style="display:none">
  <form id="login_form" method="post" action="">
    <p id="login_error">歡迎登入管理後台</p>
    <p>
      <label for="login_name">帳號: </label>
      <input type="text" id="login_name" name="login_name" size="30" />
    </p>
    <p>
      <label for="login_pass">密碼: </label>
      <input type="password" id="login_pass" name="login_pass" size="30" />
    </p>
    <p>
      <input type="submit" value="登入" />
    </p>
    <p> <em>Leave empty so see resizing</em> </p>
  </form>
</div>

<script type="text/javascript">
	function checkBroser() {
		if (navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion.split(";")[1].replace(/[ ]/g, "") == "MSIE6.0") {
			$('#browsers').trigger('click');
		}
		else if (navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion.split(";")[1].replace(/[ ]/g, "") == "MSIE7.0") {
			$('#browsers').trigger('click');
		}
		else if (navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion.split(";")[1].replace(/[ ]/g, "") == "MSIE8.0") {
			$('#browsers').trigger('click');
		}
	}

	$(document).ready(function(e) {
        $("#browsers").fancybox();
		checkBroser();
    });
	$(window).load(function() {
		$(".various").fancybox({
			'scrolling'		: 'no',
			'showCloseButton': false,
			'titleShow'		: false,
			'onClosed'		: function() {
				$("#login_error").hide();
			}
		});

		$("#login_form").bind("submit", function() {
			$.ajax({
				type : "POST",
				cache : false,
				url : "login.php",
				data : $(this).serializeArray(),
				success: function(rtn) {
					if (!rtn.error) {
						window.location.href = "../admin/index.php";
					} else {
						$.fancybox(rtn.msg);
					}
				},
				beforeSend:function(){
					$.fancybox('<div id="loadingIMG"><img src="images/ajax-loader.gif"/>驗證身分中，請稍後。</div>');
				}
			});
			return false;
		});
	});

</script>
</body>
</html>