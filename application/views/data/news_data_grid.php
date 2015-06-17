<ul>
<?php
  foreach ($news as $key => $new) {
?>
  <li class="news">
      <div>
        <span class="title">【<?= $new['nc_title']?>】</span>&nbsp;&nbsp;
        <span class="category"><?= $new['c_title']?>於&nbsp;<?= date("Y-m-d", $new['post_date']);?>&nbsp;發布
        </span>
      </div>
      <a rel="nofollow" target="_blank" href="per_news.php?n_id=<?= $new['n_id']?>"><?= $new['title']?></a>
  </li>
<?php
}
?>
</ul>