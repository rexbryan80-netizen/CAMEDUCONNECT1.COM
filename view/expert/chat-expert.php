<?php
session_start();
require_once '../../model/db.php';

if(!isset($_SESSION['user_id'], $_SESSION['user_role']) || $_SESSION['user_role'] !== 'expert'){
    header("Location: ../login.php");
    exit();
}

$expert_id = $_SESSION['user_id'];
$students = $conn->query("SELECT id, full_name FROM users WHERE role='student'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Expert Chat</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
body,html{
    height:100%;
    margin:0;
    font-family:'Segoe UI';
    background:#f4f6f9;
}

.wrapper{
    display:flex;
    height:100vh;
}

/* LEFT PANEL */
.user-list{
    width:260px;
    background:#0d6efd;
    color:#fff;
    padding:20px;
    overflow-y:auto;
}

.user-item{
    padding:12px;
    border-radius:8px;
    margin-bottom:8px;
    background:rgba(255,255,255,0.1);
    cursor:pointer;
    transition:0.3s;
}
.user-item:hover{
    background:rgba(255,255,255,0.2);
}

/* RIGHT PANEL */
.chat-area{
    flex:1;
    display:flex;
    flex-direction:column;
    background:#eef2f7;
}

/* EMPTY STATE */
.empty-state{
    flex:1;
    display:flex;
    justify-content:center;
    align-items:center;
    flex-direction:column;
    color:#6c757d;
}

/* CHAT BOX */
.chat-box{
    flex:1;
    padding:20px;
    overflow-y:auto;
    display:none;
}

/* MESSAGES */
.msg{
    max-width:70%;
    padding:10px 15px;
    border-radius:15px;
    margin-bottom:10px;
}
.me{
    background:#0d6efd;
    color:#fff;
    margin-left:auto;
}
.other{
    background:#fff;
}

/* INPUT */
.chat-input{
    display:none;
    padding:10px;
    background:#fff;
    border-top:1px solid #ddd;
}
</style>
</head>

<body>

<div class="wrapper">

    <!-- STUDENTS -->
    <div class="user-list">
        <h5>Students</h5>

        <?php while($s = $students->fetch_assoc()): ?>
            <div class="user-item" onclick="openChat(<?= $s['id'] ?>)">
                <?= htmlspecialchars($s['full_name']) ?>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- CHAT AREA -->
    <div class="chat-area">

        <!-- EMPTY SCREEN -->
        <div id="emptyState" class="empty-state">
            <h4>Select a student</h4>
            <small>Start chatting now</small>
        </div>

        <!-- CHAT -->
        <div id="chat" class="chat-box"></div>

        <!-- INPUT -->
        <div id="chatInput" class="chat-input d-flex gap-2">
            <input type="text" id="msg" class="form-control" placeholder="Type message...">
            <button class="btn btn-primary" onclick="sendMessage()">Send</button>
        </div>

    </div>

</div>

<script>
let other = 0;

// OPEN CHAT
function openChat(id){
    other = id;

    // Hide empty state
    document.getElementById('emptyState').style.display = 'none';

    // Show chat + input
    document.getElementById('chat').style.display = 'block';
    document.getElementById('chatInput').style.display = 'flex';

    loadChat();
}

// LOAD CHAT
function loadChat(){
    if(!other) return;

    $.post('../../chat/chat-api.php',{
        action:'fetch',
        other_id:other
    },function(res){

        let html='';
        try{
            let msgs = JSON.parse(res);

            msgs.forEach(m=>{
                let cls = m.sender_id == <?= $expert_id ?> ? 'me':'other';
                html += `<div class="msg ${cls}">${m.message}</div>`;
            });

        }catch(e){
            html = '<p class="text-danger">Error loading chat</p>';
        }

        $('#chat').html(html);
        $('#chat').scrollTop($('#chat')[0].scrollHeight);
    });
}

// SEND MESSAGE
function sendMessage(){
    let msg = $('#msg').val().trim();
    if(!msg || !other) return;

    $.post('../../chat/chat-api.php',{
        action:'send',
        other_id:other,
        message:msg
    },function(res){
        if(res==='success'){
            $('#msg').val('');
            loadChat();
        }
    });
}

// AUTO REFRESH
setInterval(loadChat,2000);
</script>

</body>
</html>