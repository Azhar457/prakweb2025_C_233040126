<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna</title>
    <link href="<?= BASEURL; ?>/css/bootstrap.min.css" rel="stylesheet"></head>
<body>



<div class="container mt-4">

    <div class="row">
        <div class="col-lg-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-lg-6">
            <h1 class="h3">Daftar Pengguna</h1>
        </div>
        <div class="col-lg-6 text-end">
            <a href="<?= BASEURL; ?>/user/tambah" class="btn btn-primary">
                Tambah Data User
            </a>
        </div>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
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
                        <a href="<?= BASEURL; ?>/user/detail/<?= $user['id']; ?>" class="btn btn-success btn-sm">Detail</a>
                        
                        <a href="<?= BASEURL; ?>/user/edit/<?= $user['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        
                        <a href="<?= BASEURL; ?>/user/hapus/<?= $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">Tidak ada data pengguna.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="<?= BASEURL; ?>/js/bootstrap.bundle.min.js"></script>
</body>
</html>