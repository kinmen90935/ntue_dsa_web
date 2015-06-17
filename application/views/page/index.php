<?php
    $this->load->view('layout/include_header');
?>
<script type="text/javascript">
jQuery(document).ready(function($) {
	load_news(1);
	$('#news').on("click", ".pagination li.page", function(e) {
		$('.pagination li.page').removeClass('active');
		$(this).addClass('active');

		var nc_id = $('.themeSort a.c').data('ncid');
		load_news($(this).data('pg'), nc_id);
	});

	$('body').on("click", ".themeSort a", function(e) {
		e.preventDefault();
		$('.themeSort a').removeClass('c');
		$(this).addClass('c');

		var nc_id = $(this).data('ncid');
		var pg = $('.pagination li.active').data('pg');
		load_news(pg, nc_id);
	});
	
	var tp = 1;
	$('body').on("click", ".direct", function(e) {
		e.preventDefault();
		var $this = $(this);
		var direct = $(this).data('direct');
		if (direct == 'forward') {
			tp ++;
		} else {
			if (tp > 1) {
				tp --;
			}
		}

		$.get('<?= base_url()?>sa/ajax_change_pagination', {'direct' : direct, 'tp' : tp}, function(rtn) {
			if (rtn.status) {
				$('.pagination').html(rtn.pg_html);
			}
		}, 'json');
	});
});

function load_news(page, nc_id) {
	$.ajax({
		url: '<?= base_url()?>sa/ajax_get_news',
        data: {'page': page, 'nc_id': nc_id},
        type: "GET",
		dataType:'json',
		success: function(rtn){
			if (rtn.status) {
			  $('#news_data').html(rtn.data_html);
			  // $('.pagination').html(rtn.pagination_html);
			}
		},
		beforeSend:function(){
			$('#news_data').html('<i class="fa fa-spinner fa-spin" style="font-size:100px;margin:100px 0 0 200px;"></i>' + '<br>' + '載入資料中...');
		},
		error:function(xhr, ajaxOptions, thrownError){
			alert(xhr.status);
			alert(thrownError);
		}
	});
}

</script>
</head><body>
<div id="top" class="wrap" style="position: absolute;right: 10px;top: 10px;">
      <ul style="margin: 0;padding: 0;display: block;">
          <li><a href="http://www.ntue.edu.tw" target="_blank"><i class="fa fa-chevron-left"></i>  回北教大</a></li>
          <li><a href="index.php"><i class="fa fa-chevron-left"></i>  首頁</a></li>
      </ul>
</div>
<div id="header_container">
<?php
    $this->load->view('layout/header');
?>
    <map name="map">
    <area shape=circle coords="20,20,25" href="https://http://dsa.ntue.edu.tw/">
    </map>
</div>
<?php
    $this->load->view('layout/menu');
?>

<div class="wrapper" id="slide_wrapper">
<?php
    $this->load->view('layout/sliderT');
?>

</div>
<div class="wrapper" id="main_wrapper">
	<div id="main" class="wrap">
        <div class="section group">
        	<div class="col span_2_of_12">
			<?php
			    $this->load->view('layout/sidebar');
			?>
			</div>
        	<div class="col span_6_of_12">
				<h1 class="title"><i class="fa fa-rss"></i>&nbsp;最新消息</h1>
				<div class="themeSort" data-ncid="<{$nc_id}>">
	                <ul>
	                    <li class="themeSortL"><a href="#" class="c" data-ncid="0"><i></i><span title="最新">最新</span></a></li>
	                    <li class="themeSortC"><a href="#" data-ncid="1"><i></i><span title="一般">一般</span></a></li>
	                    <li class="themeSortC"><a href="#" data-ncid="2"><i></i><span title="緊急">緊急</span></a></li>
	                    <li class="themeSortC"><a href="#" data-ncid="3"><i></i><span title="公告">公告</span></a></li>
	                    <li class="themeSortC"><a href="#" data-ncid="4"><i></i><span title="失物招領">失物招領</span></a></li>
	                    <li class="themeSortC"><a href="#" data-ncid="5"><i></i><span title="活動">活動</span></a></li>
	                    <li class="themeSortC"><a href="#" data-ncid="6"><i></i><span title="徵才">徵才</span></a></li>
	                    <li class="themeSortR"><a href="#" data-ncid="7"><span title="其他">其他</span><i></i></a></li>
	                </ul>
	            </div>
				<div style="clear:both;"></div>
				<div id="msg"></div>
				<div id="loading" style="display: none;"></div>
				<div id="news">
				  	<div id="news_data">
					</div>
					<div style="clear:both;"></div>
				  	<div class="pagination">
					<?php
					    $this->load->view('data/pagination');
					?>
				  	</div>
				</div>
			</div>
        	<div class="col span_4_of_12">
			</div>
		</div>
	</div>
	</div>
</div>
<?php
    $this->load->view('layout/footer');
?>