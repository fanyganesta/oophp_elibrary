<?php if($jumlahHalaman > 1) : ?>
    <?php for($j = 1; $j <= $jumlahHalaman; $j++) : ?>
        <?php if($j == $halamanAktif) : ?>
            <p class="inline-bold"><?= $j ?></p>
        <?php else : ?>
            <a href="<?= href("/library?halaman=$j")?><?php if(isset($_GET['cari'])){echo '&cari=' . $_GET['cari'];}?>"><?=$j?></a>
        <?php endif ?>
    <?php endfor ?>
<?php endif ?>