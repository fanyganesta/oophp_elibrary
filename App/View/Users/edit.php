<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="App/Components/css-index.css">
</head>
<body>
    <?php require 'App/Components/feedback.php' ?>
    <h3>Edit user: <?= $row['username']?></h3>
    <a href="<?= href('/user-list')?>">Kembali ke list akun</a>
    <br><br>

    <form method="POST" enctype="multipart/form-data" action="<?= href('/user-edit');?>">
        <input type="hidden" name="ID" value="<?= $row['ID']?>">
        <input type="hidden" name="oldPassword" value="<?= $row['password']?>">
        <table>
            <tr>
                <td><label for="username">Username</label></td>
                <td>: <input type="text" name="username" id="username" value="<?=$row['username']?>"></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td>: <input type="email" name="email" id="email" value="<?=$row['email']?>"></td>
            </tr>
            <tr>
                <td><label for="role">Role</label></td>
                <td>: 
                    <input name="role" type="radio" value="admin" id="admin" <?php echo ($row['role'] == 'admin') ? 'checked' : null?>>
                    <label for="admin">Admin</label>
                    <input name="role" type="radio" value="guest" id="guest" <?php echo ($row['role'] == 'guest') ? 'checked' : null?>>
                    <label for="guest">Guest</label>
                </td>
            </tr>
            <tr>
                <td><label for="newPassword">New Password</label></td>
                <td>: <input type="password" name="newPassword" id="newPassword">
            </tr>
            <tr>
                <td><label for="confirmPassword">Konfirmasi Password</label></td>
                <td>: <input type="password" name="confirmPassword" id="confirmPassword"></td>
            </tr>
            <tr>
                <td class="ct" colspan="2">
                    <button type="submit">Update Data</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>