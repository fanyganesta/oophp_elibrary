<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Library</title>
    <link rel="stylesheet" href="App/Components/css-index.css">
</head>
<body>
    <?php include 'App/Components/feedback.php'?>
    <h3> List Buku-Buku</h3>
    <p class="inline">
    <a href="<?=href('/library-tambah')?>">Tambah Buku</a> |
    <a href="<?=href('/user-list')?>">List Akun</a> |
    <a href="<?=href('/logout')?>">Keluar</a>
    </p>

    <form action="<?=href('/library')?>" method="GET">
        <label for="cari">Cari Buku: </label>
        <input type="text" name="cari" id="cari" value="<?= (isset($_GET['cari']) ? $_GET['cari'] : null)?>">
        <button type="submit">Cari</button>
    </form>
    <br>

    <table class="br">
        <?php if(!empty($rows)) : ?>
        <tr>
            <th>No.</th>
            <th>Cover</th>
            <th>Judul</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>Rating</th>
            <th>Action</th>
        </tr>
        <?php $i=1; foreach($rows as $row) : ?>
            <tr>
                <td class="ct"><?=$i?></td>
                <td class="ct">
                    <?php if(!empty($row['foto'])) : ?>
                        <img src="App/Components/img/<?= $row['foto']?>" width="150px">
                    <?php else :  ?>
                        <p><i>(Belum ada cover)</i></p>
                    <?php endif ?>
                </td>
                <td > <?=$row['judul']?></td>
                <td > <?=$row['penerbit']?></td>
                <td class="ct"><?=$row['tahunTerbit']?></td>
                <td class="ct"><?=$row['rating']?></td>
                <td class="ct">
                    <p class="inline">
                        <a href="<?= href("/library-edit?ID={$row['ID']}")?>">Edit</a> |
                        <a href="<?= href("/delete-book?ID={$row['ID']}")?>">Hapus</a>
                    </p>
                </td>
            </tr>
        <?php $i++; endforeach ?>
            <?php if($jumlahHalaman > 1) : ?>
                <tr>
                    <td colspan="6" class="ct">
                        <?php include 'App/Components/pagination.php'?>
                    </td>
                </tr>
            <?php endif ?>
        <?php else : ?>
            <tr>
                <th>Tidak ada data ditemukan</th>
            </tr>
        <?php endif ?>
    </table>
</body>
</html>