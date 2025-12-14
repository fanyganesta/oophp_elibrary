<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="App/Components/css-index.css">
</head>
<body>
    <?php require 'App/Components/feedback.php'?>
    <h3>Masukkan data</h3>
    <?php if(CekLogin('admin')) : ?>
        <a href="<?= href('/user-list')?>">Kembali ke list user</a>
        <br><br>
    <?php endif ?>
    <form action="<?= href('/register')?>" method="POST">
        <table>
            <tr>
                <td><label for="username">Username</label></td>
                <td>: <input type="text" name="username" id="username"></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td>: <input type="email" name="email" id="email"></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td>: <input type="password" name="password" id="password"></td>
            </tr>
            <tr>
                <td><label for="confirmPassword">Konfirmasi Password</label></td>
                <td>: <input type="password" name="confirmPassword" id="confirmPassword"></td>
            </tr>
            <tr>
                <td><label for="role">Role</label></td>
                <td>: <input type="radio" value="admin" id="admin" name="role">
                    <label for="admin">Admin</label>
                    <input type="radio" value="guest" id="guest" name="role">
                    <label for="guest">Guest</label>
                </td>
            </tr>
            <tr>
                <td class="ct" colspan="2">
                    <button type="submit">Daftar</button>
                </td>
            </tr>
            <tr>
                <td class="ct" colspan="2">
                    <p>Sudah punya akun? <a href="<?= href('/login')?>"> Login di sini</a></p>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>