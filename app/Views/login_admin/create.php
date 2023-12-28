<!-- app/Views/login_admin/create.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin</title>
</head>
<body>
    <h1>Create Admin</h1>

    <?php echo form_open('loginadmin/store'); ?>

    <label for="username">Username:</label>
    <input type="text" name="username" required>
    <br>

    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <br>

    <input type="submit" value="Create Admin">

    <?php echo form_close(); ?>
</body>
</html>
