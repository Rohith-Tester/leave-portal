<?php
session_start();

if(!isset($_SESSION['user'])){
header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Profile</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="page-wrap">

<div class="page-header">
<h2>My Profile</h2>
<a href="dashboard.php" class="back-btn">Dashboard</a>
</div>

<div class="profile-card">

<div class="avatar">
<?php echo strtoupper(substr($_SESSION['user'],0,1)); ?>
</div>

<h3><?php echo $_SESSION['user']; ?></h3>

<p><strong>Department:</strong> IT</p>
<p><strong>Role:</strong> Employee</p>
<p><strong>Status:</strong> Active</p>
<p><strong>Email:</strong> <?php echo $_SESSION['user']; ?>@company.com</p>

</div>

</div>

</body>
</html>