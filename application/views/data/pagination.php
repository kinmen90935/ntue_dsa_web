<ul>
    <li class="direct" data-direct="backward"><a href="#">&#60;</a></li>
    <?php
    for ($i=$start_page; $i <= $total_pages; $i++) {
    ?>
        <li class="page <?php if ($i == 1) {
            echo "active";
        }?>" style="cursor: pointer;" data-pg="<?= $i;?>">
            <a><?= $i;?></a>
        </li>
    <?php
    }
    ?>
    <li class="direct" data-direct="forward"><a href="#">&#62;</a></li>
</ul>