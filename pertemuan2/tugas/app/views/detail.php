<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
</head>
<body>
    <div class="container">
        <h1>Selamat Datang, <?= htmlspecialchars($user['name']) ?></h1>
        <p>Email : <?= htmlspecialchars($user['email']) ?></p>
        <a href="<?= BASEURL; ?>" class="btn"> Kembali Ke Daftar</a>
    </div>
</body>
</html>