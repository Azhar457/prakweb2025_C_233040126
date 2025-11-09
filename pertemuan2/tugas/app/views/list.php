<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna</title>
<body>
    <div class="container">
        <h1>Daftar Pengguna</h1>
        <table class="user-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['name']); ?></td>
                        <td><?= htmlspecialchars($user['email']); ?></td>
                        <td>
                            <a href="<?= BASEURL; ?>/user/detail/<?= $user['id']; ?>" class="btn-small">Detail</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="text-align: center;">Tidak ada data pengguna.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    </body>
</html>