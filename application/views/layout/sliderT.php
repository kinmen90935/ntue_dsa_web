<link rel="stylesheet" href="<?= base_url()?>assets/css/bjqs.css" type="text/css" />
<script src="<?= base_url()?>assets/js/bjqs-1.3.min.js"></script>
<div id="banner-fade" style="margin:0 auto;">

  <!-- start Basic Jquery Slider -->
  <ul class="bjqs">
    <li><img src="<?= base_url()?>assets/images/slider01.jpg" title="歡迎來到國立臺北教育大學學生事務處網頁，上次更新日期為2014/07/27"></li>
    <li><img src="<?= base_url()?>assets/images/slider03.jpg" title="學生事務處執掌多項業務，詳情請參詳各組業務資訊"></li>
    <li><img src="<?= base_url()?>assets/images/slider05.jpg" title="師生互動交流之<a href='message.php'>留言板</a>已正式上線，歡迎學生使用!"></li>
  </ul>
  <!-- end Basic jQuery Slider -->

</div>
<script class="secret-source">
  jQuery(document).ready(function($) {

  	$('#banner-fade').bjqs({
  	  height      : 500,
  	  width       : 1000,
  	  responsive  : true
  	});

  });
</script>