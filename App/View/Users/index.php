<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Akun</title>
    <link rel="stylesheet" href="App/Components/css-index.css">
</head>
<body>
    <?php include 'App/Components/feedback.php'?>
    <h3> List Akun User</h3>
    <a href="<?= href('/library') ?>">Kembali ke list buku</a>
    <p class="inline">|</p>
    <a href="<?= href('/register')?>">Tambah akun </a>
    <br>
    <br>

    <table class="br">
        <tr>
            <th>No. </th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        <?php $j = 1; foreach($rows as $row) : ?>
            <tr>
                <td class="ct"><?= $j?></td>
                <td><?= $row['username']?></td>
                <td><?= $row['email']?></td>
                <td class="ct"><?= $row['role']?></td>
                <td class="ct">
                    <a href=" <?= href("/user-edit?ID={$row['ID']}")?>">Edit</a>
                    <p class="inline">|</p>
                    <a href="<?= href('user-delete?ID='.$row['ID'])?>" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</a>
                </td>
            </tr>
        <?php $j++; endforeach ?>
    </table>
</body>
</html>