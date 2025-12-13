<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit data</title>
    <link rel="stylesheet" href="App/Components/css-index.css">
</head>
<body>
    <?php include 'App/Components/feedback.php' ?>
    <h3>Ubah data buku: <?=$row['judul']?></h3>
    <a href="<?= href('/library')?>">Kembali ke library</a>
    <br>
    <br>

    <form action="<?= href('/library-edit')?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="ID" value="<?=$row['ID']?>">
        <input type="hidden" name="oldImage" value="<?= $row['foto']?>">
        <table>
            <tr>
                <td colspan="2" class="ct">
                    <?php if(!empty($row['foto'])) : ?>
                        <img src="App/Components/img/<?= $row['foto']?>" width="150" style="margin-left: -40px">
                    <?php else : ?>
                        <p style="margin-left: -70px"><i>(Belum ada cover)</i></p>
                    <?php endif ?>
                </td>
            </tr>
            <tr>
                <td><label for="judul">Judul</label></td>
                <td>: <input type="text" name="judul" id="judul" value="<?= $row['judul']?>" required></td>
            </tr>
            <tr>
                <td><label for="penerbit">Penerbit</label></td>
                <td>: <input type="text" name="penerbit" id="penerbit" value="<?= $row['penerbit']?>" required></td>
            </tr>
            <tr>
                <td><label for="tahunTerbit">Tahun Terbit</label></td>
                <td>: <input type="text" name="tahunTerbit" id="tahunTerbit" value="<?= $row['tahunTerbit']?>" required></td>
            </tr>
            <tr>
                <td><label for="rating">Rating</label></td>
                <td>: <input type="text" name="rating" id="rating" value="<?= $row['rating']?>" required></td>
            </tr>
            <tr>
                <td><label for="cover">Upload Cover</label></td>
                <td>: <input type="file" name="cover" id="cover">
            </tr>
            <tr>
                <td class="ct" colspan="2">
                    <button type="submit">Tambahkan</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>