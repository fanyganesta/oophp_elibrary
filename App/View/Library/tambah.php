<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah buku</title>
    <link rel="stylesheet" href="App/Components/css-index.css">
</head>
<body>
    <?php include 'App/Components/feedback.php'?>
    <h3>Masukkan data buku baru</h3>
    <form method="POST" action="<?= href('/library-tambah')?>" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="judul">Judul</label></td>
                <td>: <input type="text" name="judul" id="judul" required></td>
            </tr>
            <tr>
                <td><label for="penerbit">Penerbit</label></td>
                <td>: <input type="text" name="penerbit" id="penerbit" required></td>
            </tr>
            <tr>
                <td><label for="tahunTerbit">Tahun Terbit</label></td>
                <td>: <input type="text" name="tahunTerbit" id="tahunTerbit" required></td>
            </tr>
            <tr>
                <td><label for="rating">Rating</label></td>
                <td>: <input type="text" name="rating" id="rating" required></td>
            </tr>
            <tr>
                <td><label for="cover">Upload Cover</label></td>
                <td>: <input type="file" name="cover" id="cover" required></td>
            </tr>
            <tr>
                <td colspan="2" class="ct">
                    <button type="submit">Tambah</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>