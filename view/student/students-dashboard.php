<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'student'){
    header("Location: ../login.php?error=Please login first");
    exit();
}

include '../../model/db.php';

$student_id = $_SESSION['user_id'];

/* =========================
   FETCH STUDENT DATA
========================= */
$stmt = $conn->prepare("SELECT full_name, region, profile_image FROM students WHERE id=?");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

$studentName = $student['full_name'] ?? 'Student';
$studentRegion = $student['region'] ?? 'Cameroon';

// ✅ FIXED IMAGE PATH: generate URL from web root
if(!empty($student['profile_image']) && file_exists(__DIR__ . "/../../uploads/" . $student['profile_image'])){
    $studentImage = "/uploads/" . $student['profile_image'];
} else {
    $studentImage = "https://via.placeholder.com/40";
}

/* =========================
   DASHBOARD STATS
========================= */
$coursesActive = $conn->query("SELECT COUNT(*) as total FROM institutes")->fetch_assoc()['total'] ?? 0;
$mentorSessions = $conn->query("SELECT COUNT(*) as total FROM experts")->fetch_assoc()['total'] ?? 0;
$peerNetwork = $conn->query("SELECT COUNT(*) as total FROM students")->fetch_assoc()['total'] ?? 0;

/* =========================
   NOTIFICATIONS SYSTEM
========================= */
$notifications = $conn->query("
    SELECT * FROM notifications 
    WHERE user_id = $student_id 
    ORDER BY created_at DESC 
    LIMIT 5
");

$notifCount = $conn->query("
    SELECT COUNT(*) as total 
    FROM notifications 
    WHERE user_id = $student_id AND seen = 0
")->fetch_assoc()['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Dashboard</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    margin:0;
    font-family:'Segoe UI', sans-serif;
    background:#f4f6f9;
}
/* SIDEBAR SPACE FIX */
.main{
    margin-left:250px;
    padding:20px;
}
@media(max-width:768px){
    .main{margin-left:0;}
}
/* TOPBAR */
.topbar{
    background:#fff;
    padding:12px 20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
    position:sticky;
    top:0;
    z-index:1000;
}
/* PROFILE */
.profile{
    display:flex;
    align-items:center;
    gap:10px;
}
.profile img{
    width:40px;
    height:40px;
    border-radius:50%;
    object-fit:cover;
}
/* NOTIFICATION */
.notif{
    position:relative;
    cursor:pointer;
}
.notif-count{
    position:absolute;
    top:-5px;
    right:-5px;
    background:red;
    color:white;
    font-size:10px;
    padding:2px 6px;
    border-radius:50%;
}
.notif-box{
    display:none;
    position:absolute;
    right:0;
    top:40px;
    width:250px;
    background:#fff;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    border-radius:10px;
    max-height:300px;
    overflow:auto;
    z-index:100;
}
/* CARDS */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:15px;
    margin-top:20px;
}
.card{
    background:#fff;
    padding:20px;
    border-radius:12px;
    text-align:center;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
}
.card i{
    font-size:25px;
    margin-bottom:10px;
}
/* BUTTONS */
.btn{
    display:inline-block;
    padding:8px 15px;
    background:#2a9d6e;
    color:white;
    border-radius:20px;
    text-decoration:none;
    margin-top:10px;
}
.btn:hover{
    background:#1e7a53;
}
/* SECTIONS */
.section{
    background:#fff;
    padding:20px;
    border-radius:12px;
    margin-top:20px;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<?php include 'sidebar.php'; ?>

<div class="main">

<!-- TOPBAR -->
<div class="topbar">

    <h4>Welcome, <?= htmlspecialchars($studentName) ?> </h4>

    <div style="display:flex; align-items:center; gap:20px;">

        <!-- NOTIFICATION -->
        <div class="notif" onclick="toggleNotif()">
            <i class="fa fa-bell fa-lg"></i>
            <?php if($notifCount > 0): ?>
                <span class="notif-count"><?= $notifCount ?></span>
            <?php endif; ?>

            <div class="notif-box" id="notifBox">
                <?php while($row = $notifications->fetch_assoc()): ?>
                    <p style="padding:10px; border-bottom:1px solid #eee;">
                        <?= htmlspecialchars($row['message']) ?>
                    </p>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- PROFILE -->
        <div class="profile">
            
            <span><?= htmlspecialchars($studentRegion) ?></span>
        </div>

    </div>
</div>

<!-- STATS -->
<div class="cards">
    <div class="card">
        <i class="fa fa-school text-success"></i>
        <h4><?= $coursesActive ?></h4>
        <p>Institutes</p>
        <a href="institutes.php" class="btn">View</a>
    </div>

    <div class="card">
        <i class="fa fa-user-tie text-primary"></i>
        <h4><?= $mentorSessions ?></h4>
        <p>Experts</p>
        <a href="experts.php" class="btn">Connect</a>
    </div>

    <div class="card">
        <i class="fa fa-users text-warning"></i>
        <h4><?= $peerNetwork ?></h4>
        <p>Students</p>
        <a href="students.php" class="btn">Network</a>
    </div>

    <div class="card">
        <i class="fa fa-chart-line text-danger"></i>
        <h4>+32%</h4>
        <p>Growth</p>
        <a href="#" class="btn">Details</a>
    </div>
</div>

<!-- FEATURES -->
<div class="section">
    <h4> Quick Actions</h4>
    <a href="messages.php" class="btn">Messages</a>
    <a href="profile.php" class="btn">Edit Profile</a>
    <a href="favorites.php" class="btn">Favorites</a>
</div>

<div class="section">
    <h4>AI Assistant</h4>
    <input type="text" placeholder="Ask anything..." style="width:100%; padding:10px; margin-top:10px;">
    <button class="btn" onclick="alert('AI feature coming soon')">Ask AI</button>
</div>

<div class="section">
    <h4>📅 Upcoming Events</h4>
    <p>Hackathon Cameroon</p>
    <p>AI Workshop</p>
</div>

</div>

<script>
function toggleNotif(){
    let box = document.getElementById("notifBox");
    box.style.display = box.style.display === "block" ? "none" : "block";
}
</script>

</body>
</html>