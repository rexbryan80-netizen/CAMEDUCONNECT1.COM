<?php
include '../model/db.php';

// Fetch all students
$query = "SELECT * FROM students ORDER BY id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Manage Students | Cameroon Pro</title>

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

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

    /* Table Card */
    .table-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .table-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        background: var(--gray-50);
    }

    .table-header h3 {
        font-size: 1rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--gray-700);
    }

    .table-container {
        overflow-x: auto;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table th {
        text-align: left;
        padding: 14px 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-500);
        background: var(--gray-50);
        border-bottom: 1px solid var(--gray-200);
    }

    .data-table td {
        padding: 16px 20px;
        font-size: 0.85rem;
        border-bottom: 1px solid var(--gray-100);
        vertical-align: middle;
    }

    .data-table tr:hover {
        background: var(--gray-50);
    }

    /* Profile Image */
    .student-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--white);
        box-shadow: var(--shadow-sm);
        background: var(--gray-200);
    }

    .student-avatar-placeholder {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-light), var(--primary));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 1rem;
    }

    /* Action Buttons */
    .action-btns {
        display: flex;
        gap: 8px;
    }

    .action-icon {
        width: 32px;
        height: 32px;
        border-radius: var(--radius-sm);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        text-decoration: none;
        cursor: pointer;
    }

    .action-icon.edit {
        background: var(--warning-bg);
        color: var(--warning);
    }

    .action-icon.edit:hover {
        background: var(--warning);
        color: white;
        transform: scale(1.05);
    }

    .action-icon.delete {
        background: var(--danger-bg);
        color: var(--danger);
    }

    .action-icon.delete:hover {
        background: var(--danger);
        color: white;
        transform: scale(1.05);
    }

    .action-icon.view {
        background: var(--primary-bg);
        color: var(--primary);
    }

    .action-icon.view:hover {
        background: var(--primary);
        color: white;
        transform: scale(1.05);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
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

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        padding: 20px 24px;
        border-top: 1px solid var(--gray-200);
        background: var(--gray-50);
    }

    .page-item {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius-sm);
        background: var(--white);
        border: 1px solid var(--gray-200);
        color: var(--gray-600);
        text-decoration: none;
        transition: var(--transition);
    }

    .page-item:hover, .page-item.active {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
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
        
        .btn-group-custom {
            justify-content: center;
        }
        
        .data-table th, .data-table td {
            padding: 12px 16px;
        }
        
        .stats-cards {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .stats-cards {
            grid-template-columns: 1fr;
        }
        
        .action-btns {
            flex-direction: column;
            gap: 4px;
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

    .table-card, .stats-cards {
        animation: fadeInUp 0.4s ease;
    }
</style>
</head>
<body>

<?php include('sidebar.php'); ?>

<div class="main-content">
    <!-- Page Header -->
    <div class="page-header">
        <h1>
            <i class="bi bi-people"></i>
            Manage Students
        </h1>
        <p>View, add, edit, and manage all student records in one centralized dashboard</p>
    </div>


    <!-- Action Bar -->
    <div class="action-bar">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" placeholder="Search by name, email, or region...">
        </div>
        <div class="btn-group-custom">
            <a href="../view/student/add-student.php" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Add New Student
            </a>
            <a href="../view/student/students.php" class="btn btn-outline">
                <i class="bi bi-grid-3x3-gap-fill"></i> View All
            </a>
            <button class="btn btn-outline" onclick="window.print()">
                <i class="bi bi-printer"></i> Export
            </button>
        </div>
    </div>

    <!-- Students Table Card -->
    <div class="table-card">
        <div class="table-header">
            <h3>
                <i class="bi bi-person-vcard"></i>
                Student Directory
                <span style="font-size: 0.7rem; background: var(--gray-200); padding: 2px 8px; border-radius: 30px;"><?= $totalStudents ?> records</span>
            </h3>
            <div>
                <i class="bi bi-funnel" style="color: var(--gray-400); cursor: pointer;"></i>
            </div>
        </div>
        
        <div class="table-container">
            <table class="data-table" id="studentTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Profile</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Region</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                // Reset result pointer
                $result->data_seek(0);
                if ($result->num_rows > 0): 
                    $counter = 1;
                    while ($row = $result->fetch_assoc()): 
                        $profileImage = !empty($row['profile_image']) ? "../../uploads/students/" . $row['profile_image'] : null;
                        $initial = strtoupper(substr($row['full_name'], 0, 1));
                ?>
                    <tr>
                        <td style="font-weight: 600;">#<?= $counter++; ?></td>
                        <td>
                            <?php if ($profileImage && file_exists($profileImage)): ?>
                                <img src="<?= $profileImage ?>" alt="<?= htmlspecialchars($row['full_name']); ?>" class="student-avatar">
                            <?php else: ?>
                                <div class="student-avatar-placeholder">
                                    <?= $initial ?>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <strong><?= htmlspecialchars($row['full_name']); ?></strong>
                        </td>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                        <td><?= htmlspecialchars($row['phone']); ?></td>
                        <td>
                            <?php if ($row['gender'] == 'Male'): ?>
                                <i class="bi bi-gender-male" style="color: var(--primary);"></i>
                            <?php elseif ($row['gender'] == 'Female'): ?>
                                <i class="bi bi-gender-female" style="color: var(--danger);"></i>
                            <?php else: ?>
                                <i class="bi bi-gender-ambiguous"></i>
                            <?php endif; ?>
                            <?= htmlspecialchars($row['gender']); ?>
                        </td>
                        <td>
                            <i class="bi bi-geo-alt-fill" style="font-size: 0.7rem; color: var(--gray-500);"></i>
                            <?= htmlspecialchars($row['region']); ?>
                        </td>
                        <td>
                            <div class="action-btns">
                                <a href="edit_student.php?id=<?= $row['id']; ?>" class="action-icon edit" title="Edit Student">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="../view/student/studentcontroller.php?delete_student=<?= $row['id']; ?>" 
                                   onclick="return confirm('⚠️ Are you sure you want to delete this student? This action cannot be undone.');" 
                                   class="action-icon delete" title="Delete Student">
                                    <i class="bi bi-trash"></i>
                                </a>
                                <a href="view_student.php?id=<?= $row['id']; ?>" class="action-icon view" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <i class="bi bi-people"></i>
                                <p>No students found in the database.</p>
                                <a href="../view/student/add-student.php" class="btn btn-primary">
                                    <i class="bi bi-plus-lg"></i> Add Your First Student
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <?php if ($result->num_rows > 10): ?>
        <div class="pagination">
            <a href="#" class="page-item"><i class="bi bi-chevron-left"></i></a>
            <a href="#" class="page-item active">1</a>
            <a href="#" class="page-item">2</a>
            <a href="#" class="page-item">3</a>
            <a href="#" class="page-item"><i class="bi bi-chevron-right"></i></a>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let searchValue = this.value.toLowerCase();
        let table = document.getElementById('studentTable');
        let rows = table.getElementsByTagName('tr');
        
        for (let i = 1; i < rows.length; i++) {
            let row = rows[i];
            let text = row.textContent.toLowerCase();
            if (text.indexOf(searchValue) > -1) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
    
    // Row hover effect enhancement
    const rows = document.querySelectorAll('.data-table tr');
    rows.forEach(row => {
        row.addEventListener('mouseenter', () => {
            row.style.backgroundColor = 'var(--gray-50)';
        });
        row.addEventListener('mouseleave', () => {
            row.style.backgroundColor = '';
        });
    });
    
    // Add keyboard shortcut for search (Ctrl+F)
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
            e.preventDefault();
            document.getElementById('searchInput').focus();
        }
    });
    
    // Tooltip functionality for action buttons
    const actionButtons = document.querySelectorAll('.action-icon');
    actionButtons.forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            const title = this.getAttribute('title');
            if (title) {
                const tooltip = document.createElement('span');
                tooltip.textContent = title;
                tooltip.style.position = 'absolute';
                tooltip.style.background = 'var(--gray-800)';
                tooltip.style.color = 'white';
                tooltip.style.padding = '4px 8px';
                tooltip.style.borderRadius = '6px';
                tooltip.style.fontSize = '0.7rem';
                tooltip.style.zIndex = '1000';
                tooltip.style.whiteSpace = 'nowrap';
                const rect = this.getBoundingClientRect();
                tooltip.style.top = (rect.top - 30) + 'px';
                tooltip.style.left = (rect.left - 20) + 'px';
                tooltip.className = 'custom-tooltip';
                document.body.appendChild(tooltip);
                
                this.addEventListener('mouseleave', function() {
                    const tooltipEl = document.querySelector('.custom-tooltip');
                    if (tooltipEl) tooltipEl.remove();
                });
            }
        });
    });
</script>

</body>
</html>