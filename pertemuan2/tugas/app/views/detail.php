<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link href="<?= BASEURL; ?>/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


<div class="container mt-4">
    <div class="card" style="width: 25rem;">
        <div class="card-header">
            <h3>Profil Pengguna</h3>
        </div>
        <div class="card-body">
            <h4 class="card-title"><?= htmlspecialchars($user['name']); ?></h4>
            <p class="card-text">Email : <?= htmlspecialchars($user['email']) ?></p>
            <a href="<?= BASEURL; ?>/user" class="btn btn-primary">Kembali Ke Daftar</a>
        </div>
    </div>
</div>

<script src="<?= BASEURL; ?>/js/bootstrap.bundle.min.js"></script>
</body>
</html>