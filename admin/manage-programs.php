<?php
session_start();
include("../model/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin'){
    header("Location: ../view/login.php?error=Please login first");
    exit();
}

// Fetch institutes for dropdown
$institutes = $conn->query("SELECT id, name FROM institutes ORDER BY name ASC");

// Handle form submission
if(isset($_POST['add_program'])){
    $institute_id = $_POST['institute_id'] ?? '';
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $fees = $_POST['fees'] ?? 0;
    $duration = $_POST['duration'] ?? 0;
    $qualification = $_POST['qualification_required'] ?? '';

    if($institute_id && $name && $description){
        $stmt = $conn->prepare("INSERT INTO programs (institute_id, name, description, fees, duration, qualification_required) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("issdis", $institute_id, $name, $description, $fees, $duration, $qualification);
        $stmt->execute();
        $stmt->close();
        $success = "Program added successfully!";
    }else{
        $error = "Please fill in all required fields.";
    }
}

// Handle update
if(isset($_POST['update_program'])){
    $edit_id = $_POST['edit_id'];
    $edit_name = $_POST['edit_name'];
    $edit_description = $_POST['edit_description'];
    $edit_fees = $_POST['edit_fees'];
    $edit_duration = $_POST['edit_duration'];
    $edit_qualification = $_POST['edit_qualification'];

    $stmt = $conn->prepare("UPDATE programs SET name=?, description=?, fees=?, duration=?, qualification_required=? WHERE id=?");
    $stmt->bind_param("ssdiss", $edit_name, $edit_description, $edit_fees, $edit_duration, $edit_qualification, $edit_id);
    $stmt->execute();
    $stmt->close();
    $success = "Program updated successfully!";
}

// Handle delete
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM programs WHERE id='$id'");
    $success = "Program deleted successfully!";
    header("Location: manage-programs.php?success=1");
    exit();
}

// Fetch programs with institute name
$programs = $conn->query("
    SELECT programs.*, institutes.name AS institute_name 
    FROM programs
    JOIN institutes ON programs.institute_id = institutes.id
    ORDER BY programs.id DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Manage Programs | Cameroon Pro</title>

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        --primary: #3b82f6;
        --primary-dark: #2563eb;
        --primary-light: #60a5fa;
        --primary-bg: #eff6ff;
        --success: #10b981;
        --success-bg: #d1fae5;
        --warning: #f59e0b;
        --warning-bg: #fef3c7;
        --danger: #ef4444;
        --danger-bg: #fee2e2;
        --info: #8b5cf6;
        --info-bg: #ede9fe;
        --dark: #1e293b;
        --gray-50: #f8fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --gray-700: #334155;
        --gray-800: #1e293b;
        --white: #ffffff;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        --radius-sm: 0.5rem;
        --radius: 0.75rem;
        --radius-lg: 1rem;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
        font-family: 'Inter', 'Segoe UI', sans-serif;
        background: var(--gray-100);
        color: var(--gray-800);
        line-height: 1.5;
        min-height: 100vh;
    }

    /* Main Content Area */
    .main-content {
        margin-left: 280px;
        padding: 28px 32px;
        min-height: 100vh;
        transition: var(--transition);
    }

    /* Page Header */
    .page-header {
        margin-bottom: 28px;
    }

    .page-header h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-header h1 i {
        color: var(--primary);
        font-size: 2rem;
    }

    .page-header p {
        color: var(--gray-500);
        font-size: 0.9rem;
    }

    /* Action Bar */
    .action-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 24px;
        background: var(--white);
        padding: 16px 24px;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
    }

    .search-box {
        position: relative;
        min-width: 280px;
    }

    .search-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-400);
        font-size: 1rem;
    }

    .search-box input {
        width: 100%;
        padding: 10px 16px 10px 40px;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius);
        font-size: 0.85rem;
        font-family: inherit;
        transition: var(--transition);
    }

    .search-box input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .btn-group-custom {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: var(--radius);
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        transition: var(--transition);
        cursor: pointer;
        border: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: var(--white);
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.25);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.35);
    }

    .btn-outline {
        background: transparent;
        border: 1px solid var(--gray-200);
        color: var(--gray-700);
    }

    .btn-outline:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: var(--primary-bg);
    }

    /* Stats Cards */
    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 28px;
    }

    .stat-card-sm {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 16px 20px;
        border: 1px solid var(--gray-200);
        transition: var(--transition);
    }

    .stat-card-sm:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .stat-card-sm .stat-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        font-weight: 600;
        color: var(--gray-500);
        letter-spacing: 0.5px;
    }

    .stat-card-sm .stat-value {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--gray-800);
        margin-top: 8px;
    }

    /* Program Cards Grid */
    .programs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 24px;
    }

    .program-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        transition: var(--transition);
        position: relative;
    }

    .program-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .program-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        background: var(--primary-bg);
        color: var(--primary);
        padding: 4px 10px;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .program-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--gray-200);
        background: var(--gray-50);
    }

    .program-header h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 4px;
    }

    .program-institute {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.75rem;
        color: var(--gray-500);
    }

    .program-institute i {
        font-size: 0.8rem;
    }

    .program-body {
        padding: 20px 24px;
    }

    .program-description {
        color: var(--gray-600);
        font-size: 0.85rem;
        line-height: 1.5;
        margin-bottom: 16px;
    }

    .program-details {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-bottom: 20px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.8rem;
    }

    .detail-item i {
        width: 24px;
        color: var(--primary);
        font-size: 1rem;
    }

    .detail-item strong {
        color: var(--gray-700);
    }

    .program-footer {
        padding: 16px 24px;
        border-top: 1px solid var(--gray-200);
        background: var(--gray-50);
        display: flex;
        gap: 12px;
    }

    .btn-sm {
        flex: 1;
        padding: 8px 16px;
        font-size: 0.75rem;
    }

    .btn-warning {
        background: var(--warning-bg);
        color: var(--warning);
        border: none;
    }

    .btn-warning:hover {
        background: var(--warning);
        color: white;
    }

    .btn-danger {
        background: var(--danger-bg);
        color: var(--danger);
        border: none;
    }

    .btn-danger:hover {
        background: var(--danger);
        color: white;
    }

    /* Modal Styles */
    .modal-content {
        border-radius: var(--radius-lg);
        border: none;
        overflow: hidden;
    }

    .modal-header {
        padding: 20px 24px;
        border: none;
    }

    .modal-header.bg-primary {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark)) !important;
    }

    .modal-header.bg-warning {
        background: linear-gradient(135deg, var(--warning), #d97706) !important;
    }

    .modal-body {
        padding: 24px;
    }

    .modal-footer {
        padding: 16px 24px;
        border-top: 1px solid var(--gray-200);
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--gray-700);
        margin-bottom: 6px;
    }

    .form-control, .form-select {
        width: 100%;
        padding: 10px 14px;
        font-size: 0.85rem;
        font-family: inherit;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-sm);
        transition: var(--transition);
    }

    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 80px;
    }

    /* Toast Notifications */
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1100;
    }

    .toast {
        border-radius: var(--radius);
        border: none;
        box-shadow: var(--shadow-lg);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: var(--white);
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-200);
    }

    .empty-state i {
        font-size: 4rem;
        color: var(--gray-300);
        margin-bottom: 16px;
    }

    .empty-state p {
        color: var(--gray-500);
        margin-bottom: 20px;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .main-content {
            margin-left: 0;
            padding: 20px;
        }
    }

    @media (max-width: 768px) {
        .main-content {
            padding: 16px;
        }
        
        .action-bar {
            flex-direction: column;
            align-items: stretch;
        }
        
        .search-box {
            width: 100%;
        }
        
        .programs-grid {
            grid-template-columns: 1fr;
        }
        
        .stats-cards {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .stats-cards {
            grid-template-columns: 1fr;
        }
        
        .program-details {
            grid-template-columns: 1fr;
        }
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .program-card {
        animation: fadeInUp 0.4s ease backwards;
    }

    .program-card:nth-child(1) { animation-delay: 0.05s; }
    .program-card:nth-child(2) { animation-delay: 0.1s; }
    .program-card:nth-child(3) { animation-delay: 0.15s; }
    .program-card:nth-child(4) { animation-delay: 0.2s; }
</style>
</head>
<body>

<?php include('sidebar.php'); ?>

<div class="main-content">
    <!-- Page Header -->
    <div class="page-header">
        <h1>
            <i class="bi bi-journal-bookmark-fill"></i>
            Manage Programs
        </h1>
        <p>Create, edit, and manage academic programs across all partner institutes</p>
    </div>

    <!-- Stats Cards -->
    <?php
    $totalPrograms = $programs->num_rows;
    $totalInstitutes = $institutes->num_rows;
    ?>
    <div class="stats-cards">
        <div class="stat-card-sm">
            <div class="stat-label">Total Programs</div>
            <div class="stat-value"><?= $totalPrograms ?></div>
        </div>
        <div class="stat-card-sm">
            <div class="stat-label">Partner Institutes</div>
            <div class="stat-value"><?= $totalInstitutes ?></div>
        </div>
        <div class="stat-card-sm">
            <div class="stat-label">Active Programs</div>
            <div class="stat-value"><?= $totalPrograms ?></div>
        </div>
        <div class="stat-card-sm">
            <div class="stat-label">Avg. Duration</div>
            <div class="stat-value">3<span style="font-size: 1rem;"> yrs</span></div>
        </div>
    </div>

    <!-- Action Bar -->
    <div class="action-bar">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" placeholder="Search programs by name or institute...">
        </div>
        <div class="btn-group-custom">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProgramModal">
                <i class="bi bi-plus-lg"></i> Add New Program
            </button>
            <button class="btn btn-outline" onclick="window.print()">
                <i class="bi bi-printer"></i> Export List
            </button>
        </div>
    </div>

    <!-- Programs Grid -->
    <?php if ($programs->num_rows > 0): ?>
        <div class="programs-grid" id="programsGrid">
            <?php 
            $programs->data_seek(0);
            while($row = $programs->fetch_assoc()): 
                $feesFormatted = number_format($row['fees'], 0);
                $durationText = $row['duration'] . ' ' . ($row['duration'] == 1 ? 'year' : 'years');
            ?>
                <div class="program-card" data-name="<?= strtolower(htmlspecialchars($row['name'])) ?>" data-institute="<?= strtolower(htmlspecialchars($row['institute_name'])) ?>">
                    <div class="program-badge">
                        <i class="bi bi-bookmark-check"></i> Active
                    </div>
                    <div class="program-header">
                        <h3><?= htmlspecialchars($row['name']); ?></h3>
                        <div class="program-institute">
                            <i class="bi bi-building"></i>
                            <?= htmlspecialchars($row['institute_name']); ?>
                        </div>
                    </div>
                    <div class="program-body">
                        <div class="program-description">
                            <?= htmlspecialchars(substr($row['description'], 0, 120)) . (strlen($row['description']) > 120 ? '...' : ''); ?>
                        </div>
                        <div class="program-details">
                            <div class="detail-item">
                                <i class="bi bi-cash-stack"></i>
                                <span><strong>Fees:</strong> <?= $feesFormatted ?> FCFA</span>
                            </div>
                            <div class="detail-item">
                                <i class="bi bi-calendar"></i>
                                <span><strong>Duration:</strong> <?= $durationText ?></span>
                            </div>
                            <div class="detail-item">
                                <i class="bi bi-award"></i>
                                <span><strong>Qualification:</strong> <?= htmlspecialchars($row['qualification_required']) ?: 'Not specified' ?></span>
                            </div>
                            <div class="detail-item">
                                <i class="bi bi-person-graduate"></i>
                                <span><strong>Program ID:</strong> #<?= $row['id'] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="program-footer">
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id']; ?>">
                            <i class="bi bi-pencil"></i> Edit
                        </button>
                        <a href="manage-programs.php?delete=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('⚠️ Are you sure you want to delete this program? This action cannot be undone.');">
                            <i class="bi bi-trash"></i> Delete
                        </a>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?= $row['id']; ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <form method="POST" class="modal-content">
                            <div class="modal-header bg-warning">
                                <h5 class="text-white"><i class="bi bi-pencil-square"></i> Edit Program</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="edit_id" value="<?= $row['id']; ?>">
                                <div class="form-group">
                                    <label><i class="bi bi-tag"></i> Program Name</label>
                                    <input type="text" name="edit_name" class="form-control" required value="<?= htmlspecialchars($row['name']); ?>">
                                </div>
                                <div class="form-group">
                                    <label><i class="bi bi-text-paragraph"></i> Description</label>
                                    <textarea name="edit_description" class="form-control" required><?= htmlspecialchars($row['description']); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label><i class="bi bi-cash-stack"></i> Fees (FCFA)</label>
                                    <input type="number" name="edit_fees" class="form-control" required value="<?= $row['fees']; ?>">
                                </div>
                                <div class="form-group">
                                    <label><i class="bi bi-calendar"></i> Duration (Years)</label>
                                    <input type="number" name="edit_duration" class="form-control" required value="<?= $row['duration']; ?>" step="0.5">
                                </div>
                                <div class="form-group">
                                    <label><i class="bi bi-award"></i> Qualification Required</label>
                                    <input type="text" name="edit_qualification" class="form-control" value="<?= htmlspecialchars($row['qualification_required']); ?>">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" name="update_program" class="btn btn-primary">Update Program</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <i class="bi bi-journal-bookmark"></i>
            <p>No programs found in the database.</p>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProgramModal">
                <i class="bi bi-plus-lg"></i> Add Your First Program
            </button>
        </div>
    <?php endif; ?>
</div>

<!-- Add Program Modal -->
<div class="modal fade" id="addProgramModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="text-white"><i class="bi bi-plus-circle"></i> Add New Program</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label><i class="bi bi-building"></i> Institute <span class="text-danger">*</span></label>
                    <select name="institute_id" class="form-select" required>
                        <option value="">Select Institute</option>
                        <?php 
                        $institutes->data_seek(0);
                        while($inst = $institutes->fetch_assoc()): ?>
                            <option value="<?= $inst['id']; ?>"><?= htmlspecialchars($inst['name']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label><i class="bi bi-tag"></i> Program Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required placeholder="e.g., Bachelor of Science in Computer Science">
                </div>
                <div class="form-group">
                    <label><i class="bi bi-text-paragraph"></i> Description <span class="text-danger">*</span></label>
                    <textarea name="description" class="form-control" required placeholder="Provide a detailed description of the program..."></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="bi bi-cash-stack"></i> Fees (FCFA)</label>
                            <input type="number" name="fees" class="form-control" placeholder="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="bi bi-calendar"></i> Duration (Years)</label>
                            <input type="number" name="duration" class="form-control" placeholder="3" step="0.5">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label><i class="bi bi-award"></i> Qualification Required</label>
                    <input type="text" name="qualification_required" class="form-control" placeholder="e.g., High School Diploma, GCE A/L">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="add_program" class="btn btn-primary">Add Program</button>
            </div>
        </form>
    </div>
</div>

<!-- Toast Notifications -->
<div class="toast-container">
    <?php if(isset($success)): ?>
    <div class="toast align-items-center text-white bg-success border-0 show" role="alert">
        <div class="d-flex">
            <div class="toast-body"><i class="bi bi-check-circle-fill"></i> <?= $success ?></div>
            <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
    <?php endif; ?>
    <?php if(isset($error)): ?>
    <div class="toast align-items-center text-white bg-danger border-0 show" role="alert">
        <div class="d-flex">
            <div class="toast-body"><i class="bi bi-exclamation-triangle-fill"></i> <?= $error ?></div>
            <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Auto-hide toasts after 4 seconds
    setTimeout(() => {
        document.querySelectorAll('.toast').forEach(toast => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        });
    }, 4000);

    // Live Search Functionality
    const searchInput = document.getElementById('searchInput');
    const programsGrid = document.getElementById('programsGrid');
    
    if (searchInput && programsGrid) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('.program-card');
            
            cards.forEach(card => {
                const name = card.getAttribute('data-name') || '';
                const institute = card.getAttribute('data-institute') || '';
                
                if (name.includes(searchTerm) || institute.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
    
    // Keyboard shortcut for search (Ctrl+F)
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
            e.preventDefault();
            if (searchInput) searchInput.focus();
        }
    });
    
    // Program card hover effect for data attributes
    document.querySelectorAll('.program-card').forEach(card => {
        const name = card.querySelector('.program-header h3')?.textContent || '';
        const institute = card.querySelector('.program-institute')?.textContent || '';
        card.setAttribute('data-name', name.toLowerCase());
        card.setAttribute('data-institute', institute.toLowerCase());
    });
</script>

</body>
</html>