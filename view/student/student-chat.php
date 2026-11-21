<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Student Chat | Connect with Experts</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family: 'Inter', sans-serif; background:#f0f2f5; height:100vh; overflow:hidden; }
        .chat-app { display:flex; height:100vh; width:100%; background:#fff; }
        /* Sidebar */
        .experts-sidebar { width:320px; background:linear-gradient(180deg,#1a2a3a 0%,#0f1a24 100%); color:#fff; display:flex; flex-direction:column; box-shadow:4px 0 20px rgba(0,0,0,0.08); transition:all 0.3s ease; z-index:100; }
        .sidebar-header { padding:24px 20px; border-bottom:1px solid rgba(255,255,255,0.1); background:rgba(0,0,0,0.2); }
        .sidebar-header h4 { font-weight:600; font-size:1.3rem; display:flex; align-items:center; gap:10px; margin:0; }
        .sidebar-header h4 i { color:#4ade80; font-size:1.5rem; }
        .expert-count { font-size:0.75rem; color:#9ca3af; margin-top:6px; }
        .expert-search { padding:16px 20px; border-bottom:1px solid rgba(255,255,255,0.08); }
        .expert-search input { background:rgba(255,255,255,0.12); border:none; border-radius:30px; padding:10px 16px; color:white; width:100%; font-size:0.9rem; transition:all 0.2s; }
        .expert-search input::placeholder { color:rgba(255,255,255,0.5); }
        .expert-search input:focus { outline:none; background:rgba(255,255,255,0.2); box-shadow:0 0 0 2px rgba(74,222,128,0.3); }
        .experts-list { flex:1; overflow-y:auto; padding:12px 0; }
        .expert-item { display:flex; align-items:center; justify-content:space-between; padding:14px 20px; margin:4px 12px; border-radius:16px; cursor:pointer; transition:all 0.2s ease; background:transparent; }
        .expert-item:hover { background:rgba(74,222,128,0.15); transform:translateX(4px); }
        .expert-item.active { background:linear-gradient(95deg,#4ade80,#22c55e); box-shadow:0 4px 12px rgba(74,222,128,0.3); }
        .expert-info { display:flex; align-items:center; gap:12px; flex:1; }
        .expert-avatar { width:44px; height:44px; background:linear-gradient(135deg,#3b82f6,#06b6d4); border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:600; font-size:1rem; color:white; position:relative; }
        .status-dot { position:absolute; bottom:2px; right:2px; width:12px; height:12px; border-radius:50%; border:2px solid #1a2a3a; }
        .status-dot.online { background:#4ade80; box-shadow:0 0 0 2px rgba(74,222,128,0.5); }
        .status-dot.offline { background:#6b7280; }
        .expert-details { flex:1; }
        .expert-name { font-weight:600; font-size:0.95rem; margin-bottom:2px; }
        .expert-specialty { font-size:0.7rem; opacity:0.7; }
        .unread-badge { background:#ef4444; color:white; font-size:0.7rem; font-weight:bold; padding:2px 8px; border-radius:30px; min-width:24px; text-align:center; }
        /* Chat area */
        .chat-main { flex:1; display:flex; flex-direction:column; background:#f9fafb; }
        .chat-header { background:white; padding:16px 28px; border-bottom:1px solid #e5e7eb; display:flex; align-items:center; gap:16px; box-shadow:0 2px 8px rgba(0,0,0,0.02); }
        .chat-header-avatar { width:48px; height:48px; background:linear-gradient(135deg,#4ade80,#22c55e); border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:1.2rem; color:white; }
        .chat-header-info h5 { margin:0; font-weight:700; font-size:1.1rem; }
        .chat-header-info p { margin:0; font-size:0.75rem; color:#6b7280; }
        .messages-container { flex:1; overflow-y:auto; padding:24px 28px; display:flex; flex-direction:column; gap:16px; background:#f9fafb; }
        .message { display:flex; animation:fadeInUp 0.3s ease; }
        @keyframes fadeInUp { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }
        .message.me { justify-content:flex-end; }
        .message.other { justify-content:flex-start; }
        .message-bubble { max-width:70%; padding:12px 18px; border-radius:24px; position:relative; word-wrap:break-word; }
        .message.me .message-bubble { background:linear-gradient(135deg,#4ade80,#22c55e); color:white; border-bottom-right-radius:6px; box-shadow:0 2px 8px rgba(34,197,94,0.2); }
        .message.other .message-bubble { background:white; color:#1f2937; border-bottom-left-radius:6px; box-shadow:0 2px 6px rgba(0,0,0,0.05); border:1px solid #e5e7eb; }
        .message-sender { font-size:0.7rem; font-weight:600; margin-bottom:4px; opacity:0.8; }
        .message-text { font-size:0.9rem; line-height:1.4; }
        .message-time { font-size:0.65rem; opacity:0.7; margin-top:4px; text-align:right; }
        .file-attachment { display:inline-flex; align-items:center; gap:8px; background:rgba(0,0,0,0.08); padding:8px 12px; border-radius:12px; margin-top:6px; text-decoration:none; font-size:0.8rem; }
        .message.me .file-attachment { background:rgba(255,255,255,0.2); color:white; }
        .message.other .file-attachment { background:#f3f4f6; color:#3b82f6; }
        audio { max-width:220px; border-radius:20px; margin-top:6px; }
        .input-area { background:white; padding:18px 24px; border-top:1px solid #e5e7eb; display:flex; gap:12px; align-items:center; }
        .input-area .form-control { border-radius:30px; padding:12px 20px; border:1px solid #e5e7eb; font-size:0.9rem; transition:all 0.2s; }
        .input-area .form-control:focus { border-color:#4ade80; box-shadow:0 0 0 3px rgba(74,222,128,0.1); }
        .action-btn { width:44px; height:44px; border-radius:50%; border:none; background:#f3f4f6; color:#4b5563; display:inline-flex; align-items:center; justify-content:center; transition:all 0.2s; }
        .action-btn:hover { background:#e5e7eb; transform:scale(1.05); }
        .send-btn { background:#4ade80; color:white; padding:0 24px; border-radius:30px; font-weight:600; border:none; transition:all 0.2s; }
        .send-btn:hover { background:#22c55e; transform:scale(1.02); }
        .empty-chat { display:flex; flex-direction:column; align-items:center; justify-content:center; height:100%; color:#9ca3af; text-align:center; }
        .empty-chat i { font-size:4rem; margin-bottom:16px; opacity:0.5; }
        .experts-list::-webkit-scrollbar, .messages-container::-webkit-scrollbar { width:5px; }
        .experts-list::-webkit-scrollbar-track { background:rgba(255,255,255,0.05); }
        .experts-list::-webkit-scrollbar-thumb { background:#4ade80; border-radius:10px; }
        .messages-container::-webkit-scrollbar-track { background:#e5e7eb; }
        .messages-container::-webkit-scrollbar-thumb { background:#9ca3af; border-radius:10px; }
        .recording-indicator { position:fixed; bottom:100px; left:50%; transform:translateX(-50%); background:#ef4444; color:white; padding:8px 20px; border-radius:40px; font-size:0.8rem; z-index:1000; display:none; gap:8px; align-items:center; }
        @media(max-width:768px){ .experts-sidebar{position:fixed;left:-320px;top:0;height:100vh;z-index:1000;transition:left 0.3s ease;} .experts-sidebar.open{left:0;} .chat-main{width:100%;} .message-bubble{max-width:85%;} }
    </style>
</head>
<body>

<div class="chat-app">
    <div class="experts-sidebar" id="expertSidebar">
        <div class="sidebar-header">
            <h4><i class="fas fa-chalkboard-user"></i> Expert Connect</h4>
            <div class="expert-count" id="expertCount">Loading experts...</div>
        </div>
        <div class="expert-search">
            <input type="text" id="searchExpert" placeholder="🔍 Search experts..." autocomplete="off">
        </div>
        <div class="experts-list" id="expertsList"></div>
    </div>
    <div class="chat-main">
        <div class="chat-header" id="chatHeader" style="display:none;">
            <div class="chat-header-avatar" id="chatAvatar">?</div>
            <div class="chat-header-info">
                <h5 id="chatExpertName">Select an Expert</h5>
                <p id="chatExpertStatus">Click on any expert to start chatting</p>
            </div>
        </div>
        <div class="messages-container" id="messagesContainer">
            <div class="empty-chat">
                <i class="fas fa-comments"></i>
                <p>Select an expert from the sidebar to start messaging</p>
            </div>
        </div>
        <div class="input-area" id="inputArea" style="display:none;">
            <input type="file" id="fileInput" hidden accept="image/*,.pdf,.doc,.docx,.txt">
            <button class="action-btn" onclick="document.getElementById('fileInput').click()" title="Attach file"><i class="fas fa-paperclip"></i></button>
            <button class="action-btn" id="voiceBtn" title="Voice message (5 sec)"><i class="fas fa-microphone"></i></button>
            <input type="text" id="messageInput" class="form-control" placeholder="Type your message..." autocomplete="off">
            <button class="send-btn" id="sendBtn"><i class="fas fa-paper-plane"></i> Send</button>
        </div>
    </div>
</div>

<div class="recording-indicator" id="recordingIndicator"><i class="fas fa-microphone-alt fa-beat"></i> Recording... 5s</div>
<button id="mobileToggleBtn" style="position:fixed;bottom:20px;left:20px;width:50px;height:50px;border-radius:50%;background:#4ade80;border:none;color:white;display:none;z-index:1001;box-shadow:0 4px 12px rgba(0,0,0,0.2);"><i class="fas fa-bars"></i></button>

<script>
/* Initialize experts list and chat functionality (same as previous script) */
const studentId = 1; 
let currentExpertId = null;
let experts = [
    { id:1, full_name:"Dr. Sarah Johnson", specialty:"Computer Science", online:true },
    { id:2, full_name:"Prof. Michael Chen", specialty:"Data Science", online:false },
    { id:3, full_name:"Dr. Emily Rodriguez", specialty:"AI & Machine Learning", online:true },
    { id:4, full_name:"Prof. James Wilson", specialty:"Cybersecurity", online:true },
    { id:5, full_name:"Dr. Lisa Anderson", specialty:"Web Development", online:false }
];

function getInitials(name){return name.split(' ').map(n=>n[0]).join('').toUpperCase().slice(0,2);}
function escapeHtml(str){if(!str)return '';return str.replace(/[&<>]/g,m=>m==='&'?'&amp;':m==='<'?'&lt;':m==='>'?'&gt;':'');}
function renderExperts(searchTerm=''){ const filtered=experts.filter(e=>e.full_name.toLowerCase().includes(searchTerm.toLowerCase())); const container=document.getElementById('expertsList'); document.getElementById('expertCount').textContent=`${filtered.length} expert${filtered.length!==1?'s':''}`; if(filtered.length===0){container.innerHTML='<div style="text-align:center;padding:40px;color:rgba(255,255,255,0.6);">No experts found</div>'; return;} container.innerHTML=filtered.map(exp=>`<div class="expert-item ${currentExpertId===exp.id?'active':''}" onclick="openChat(${exp.id})"><div class="expert-info"><div class="expert-avatar">${getInitials(exp.full_name)}<span class="status-dot ${exp.online?'online':'offline'}"></span></div><div class="expert-details"><div class="expert-name">${escapeHtml(exp.full_name)}</div><div class="expert-specialty">${exp.specialty||'Expert'}</div></div></div><div class="unread-badge" id="unread-${exp.id}" style="display:none;">0</div></div>`).join(''); updateUnreadBadges(); }
renderExperts();
</script>

</body>
</html>