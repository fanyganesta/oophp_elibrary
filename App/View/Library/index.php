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
        <input type="text" name="cari" id="cari">
        <button type="submit">Cari</button>
    </form>
    <br>

    <table class="br">
        <tr>
            <th>No.</th>
            <th>Judul</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>Rating</th>
            <th>Action</th>
        </tr>
        <?php $i=1; foreach($rows as $row) : ?>
            <tr>
                <td class="ct"><?=$i?></td>
                <td > <?=$row['judul']?></td>
                <td > <?=$row['penerbit']?></td>
                <td class="ct"><?=$row['tahunTerbit']?></td>
                <td class="ct"><?=$row['rating']?></td>
                <td class="ct"></td>
            </tr>
        <?php $i++; endforeach ?>
    </table>
</body>
</html>