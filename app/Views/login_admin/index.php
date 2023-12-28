<!-- app/Views/login_admin/index.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Admins</title>
</head>
<body>
    <h1>List of Admins</h1>

    <?php if ($admins): ?>
        <ul>
            <?php foreach ($admins as $admin): ?>
                <li><?= $admin['username']; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No admins found.</p>
    <?php endif; ?>

    <p><a href="<?= site_url('loginadmin/create'); ?>">Create Admin</a></p>
</body>
</html>
