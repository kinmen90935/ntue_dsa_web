<div id="sidebar">
<h1 class="title"><i class="fa fa-bars"></i>&nbsp;處室項目</h1>
<ul id="mainItem">
	<li><a href="index.php"><img width="145" src="<?= base_url()?>assets/images/sidebar05.jpg"></a></li>
	<li><a href="laws.php"><img width="145" src="<?= base_url()?>assets/images/sidebar05.png"></a></li>
  	<li><a href="sop.php"><img width="145" src="<?= base_url()?>assets/images/sidebar03.png"></a></li>
	<li><a href="message.php"><img width="145" src="<?= base_url()?>assets/images/sidebar02.png"></a></li>
	<li><a href="contact_us.php"><img width="145" src="<?= base_url()?>assets/images/sidebar04.jpg"></a></li>
</ul>
  <h1 class="title"><i class="fa fa-external-link"></i>&nbsp;熱門連結專區</h1>
  <ul id="adRotate">
    <{foreach from=$left_sidebar_items key=k item=item}>
      <li><a target="_blank" href="<{$item.url}>"><{$item.title}></a></li>
    <{/foreach}>
  </ul>
  <h1 class="title"><i class="fa fa-weixin"></i>&nbsp;最新留言</h1>
  <style>
  .msg_list li{
    border-bottom: 1px solid #ddd;
  }
  .msg_list a{
    text-decoration: none;
    color: #202020;
    font-size: 12px;
  }
  </style>
  <ul class="msg_list">
    <{foreach $latest_msgs as $msg}>
      <li><a target="_blank" href="reply_message.php?msg_id=<{$msg.msg_id}>">Q：<{$msg.title}></a></li>
    <{/foreach}>
  </ul>
</div>