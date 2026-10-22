<?php
session_start();

require_once __DIR__ . '/CRUD/create.php';
require_once __DIR__ . '/CRUD/read.php';
require_once __DIR__ . '/CRUD/readall.php';
require_once __DIR__ . '/CRUD/update.php';
require_once __DIR__ . '/CRUD/delete.php';

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

$errors = [];
$flash = $_SESSION['flash'] ?? '';
unset($_SESSION['flash']);
$isEditing = false;
$form = ['id' => '', 'nama' => '', 'harga' => '', 'stok' => ''];
$products = [];

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';

        if ($action === 'delete') {
            $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
            if (!$id || $id < 1) {
                $errors[] = 'ID produk tidak valid.';
            } else {
                deleteProduct((int) $id);
                $_SESSION['flash'] = 'Produk berhasil dihapus.';
                header('Location: index.php');
                exit;
            }
        } elseif ($action === 'create' || $action === 'update') {
            $form = [
                'id' => trim((string) ($_POST['id'] ?? '')),
                'nama' => trim((string) ($_POST['nama'] ?? '')),
                'harga' => trim((string) ($_POST['harga'] ?? '')),
                'stok' => trim((string) ($_POST['stok'] ?? '')),
            ];
            $isEditing = $action === 'update';

            if ($form['nama'] === '') {
                $errors[] = 'Nama produk wajib diisi.';
            } elseif (strlen($form['nama']) > 150) {
                $errors[] = 'Nama produk maksimal 150 karakter.';
            }

            $harga = filter_var($form['harga'], FILTER_VALIDATE_FLOAT);
            if ($harga === false || $harga < 0) {
                $errors[] = 'Harga harus berupa angka nol atau lebih.';
            }

            $stok = filter_var($form['stok'], FILTER_VALIDATE_INT);
            if ($stok === false || $stok < 0) {
                $errors[] = 'Stok harus berupa bilangan bulat nol atau lebih.';
            }

            $id = null;
            if ($isEditing) {
                $id = filter_var($form['id'], FILTER_VALIDATE_INT);
                if (!$id || $id < 1) {
                    $errors[] = 'ID produk tidak valid.';
                } elseif (readProduct((int) $id) === false) {
                    $errors[] = 'Produk yang akan diedit tidak ditemukan.';
                }
            }

            if (!$errors) {
                $data = ['nama' => $form['nama'], 'harga' => (float) $harga, 'stok' => (int) $stok];

                if ($isEditing) {
                    updateProduct((int) $id, $data);
                    $_SESSION['flash'] = 'Produk berhasil diperbarui.';
                } else {
                    createProduct($data);
                    $_SESSION['flash'] = 'Produk berhasil ditambahkan.';
                }

                header('Location: index.php');
                exit;
            }
        } else {
            $errors[] = 'Aksi tidak dikenal.';
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit'])) {
        $id = filter_var($_GET['edit'], FILTER_VALIDATE_INT);
        if (!$id || $id < 1) {
            $errors[] = 'ID produk tidak valid.';
        } else {
            $data = readProduct((int) $id);
            if ($data === false) {
                $errors[] = 'Produk tidak ditemukan.';
            } else {
                $form = $data;
                $isEditing = true;
            }
        }
    }

    $products = readAllProducts();
} catch (Throwable $error) {
    $errors[] = 'Tidak dapat memproses data. Pastikan database manajemen_produk dan tabel produk sudah dibuat. Detail: ' . $error->getMessage();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 900px; margin: 25px auto; padding: 0 12px; color: #222; }
        h1 { font-size: 25px; }
        form { margin-bottom: 20px; }
        label { display: inline-block; margin: 5px 10px 5px 0; }
        input { padding: 6px; margin-top: 4px; }
        button, .link { padding: 6px 10px; cursor: pointer; }
        table { border-collapse: collapse; width: 100%; margin-top: 12px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
        .message { margin: 12px 0; }
        .error { color: #b00020; }
        .actions { white-space: nowrap; }
    </style>
</head>
<body>
    <h1>Sistem Manajemen Produk</h1>

    <?php if ($flash !== ''): ?>
        <p class="message"><?= e($flash) ?></p>
    <?php endif; ?>

    <?php if ($errors): ?>
        <div class="message error">
            <?php foreach ($errors as $error): ?>
                <p><?= e($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <h2><?= $isEditing ? 'Edit Produk' : 'Tambah Produk' ?></h2>
    <form method="post" action="index.php">
        <input type="hidden" name="action" value="<?= $isEditing ? 'update' : 'create' ?>">
        <?php if ($isEditing): ?>
            <input type="hidden" name="id" value="<?= e($form['id']) ?>">
        <?php endif; ?>

        <label>Nama Produk<br>
            <input type="text" name="nama" maxlength="150" required value="<?= e($form['nama']) ?>">
        </label>
        <label>Harga (Rp)<br>
            <input type="number" name="harga" min="0" step="0.01" required value="<?= e($form['harga']) ?>">
        </label>
        <label>Stok<br>
            <input type="number" name="stok" min="0" step="1" required value="<?= e($form['stok']) ?>">
        </label>
        <button type="submit"><?= $isEditing ? 'Simpan Perubahan' : 'Tambah' ?></button>
        <?php if ($isEditing): ?>
            <a class="link" href="index.php">Batal</a>
        <?php endif; ?>
    </form>

    <h2>Daftar Produk</h2>
    <table>
        <thead>
            <tr><th>ID</th><th>Nama</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            <?php if (!$products): ?>
                <tr><td colspan="5">Belum ada produk.</td></tr>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= e($product['id']) ?></td>
                        <td><?= e($product['nama']) ?></td>
                        <td>Rp <?= number_format((float) $product['harga'], 2, ',', '.') ?></td>
                        <td><?= e($product['stok']) ?></td>
                        <td class="actions">
                            <a href="?edit=<?= (int) $product['id'] ?>">Edit</a>
                            <form method="post" action="index.php" style="display:inline" onsubmit="return confirm('Hapus produk ini?')">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= (int) $product['id'] ?>">
                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
