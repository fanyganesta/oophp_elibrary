<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="App/Components/css-index.css">
</head>
<body>
    <?php include 'App/Components/feedback.php'?>
    <h3>Selamat Datang</h3>
    <form method="POST" action="<?= href('/login')?>">
        <table>
            <tr>
                <td><label for="username">Username</td>
                <td>: <input type="text" name="username" id="ID"></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td>: <input type="password" name="password" id="password"></td>
            </tr>
            <tr>
                <td colspan="2" class="ct">
                    <input type="checkbox" name="rememberme" id="rememberme">
                    <label for="rememberme">Remember Me</label>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="ct">
                    <button type="submit">Login</button>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="ct">
                    <p>Belum punya akun? <a href="<?= href('/register')?>">Daftar di sini</a></p>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>