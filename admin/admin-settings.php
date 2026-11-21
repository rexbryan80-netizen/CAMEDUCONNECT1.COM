<?php

$settingsFile = 'admin_settings.json';
$settings = json_decode(file_get_contents($settingsFile), true);
$message = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $settings['adminName'] = $_POST['adminName'];
    $settings['adminEmail'] = $_POST['adminEmail'];

    if(!empty($_POST['password'])){
        $settings['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }

    file_put_contents($settingsFile, json_encode($settings, JSON_PRETTY_PRINT));
    $message = "Settings updated successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Settings - Cameroon Education Connect</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background: #f0f4f8;
}
.settings-container {
    max-width: 600px;
    margin: 60px auto;
    padding: 30px;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}
.settings-container h1 {
    text-align: center;
    margin-bottom: 25px;
    font-weight: 700;
}
</style>
</head>
<body>
<div class="settings-container">
    <h1>Admin Settings</h1>
    <?php if($message): ?>
    <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Admin Name</label>
            <input type="text" class="form-control" name="adminName" value="<?php echo htmlspecialchars($settings['adminName']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="adminEmail" value="<?php echo htmlspecialchars($settings['adminEmail']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter new password if you want to change it">
        </div>
        <button type="submit" class="btn btn-primary w-100">Save Changes</button>
    </form>
    <a href="../view/logout.php" class="btn btn-outline-secondary mt-3 w-100">Logout</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
