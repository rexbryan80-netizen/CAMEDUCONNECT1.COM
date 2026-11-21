<?php
// admindashboard.php - Standalone Admin Dashboard
// This dashboard is designed to work with the modern sidebar
// Include the sidebar separately - DO NOT COMBINE
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Cameroon Pro</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        /* ============================================
           MAIN DASHBOARD STYLES - MODERN ADMIN PANEL
           ============================================ */
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
            --gray-900: #0f172a;
            --white: #ffffff;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            --radius-sm: 0.5rem;
            --radius: 0.75rem;
            --radius-lg: 1rem;
            --radius-xl: 1.5rem;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gray-100);
            color: var(--gray-800);
            line-height: 1.5;
            overflow-x: hidden;
        }

        /* Main Content Area - Account for sidebar */
        .main-content {
            margin-left: 280px;
            padding: 24px 32px;
            min-height: 100vh;
            transition: var(--transition);
        }

        /* ========== TOP NAVBAR ========== */
        .top-navbar {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 16px 28px;
            margin-bottom: 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
        }

        .page-title h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-800);
        }

        .page-title p {
            font-size: 0.85rem;
            color: var(--gray-500);
            margin-top: 4px;
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notification-icon {
            position: relative;
            cursor: pointer;
        }

        .notification-icon i {
            font-size: 1.3rem;
            color: var(--gray-600);
            transition: var(--transition);
        }

        .notification-icon:hover i {
            color: var(--primary);
        }

        .notification-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--danger);
            color: white;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 20px;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 6px 12px;
            border-radius: var(--radius);
            transition: var(--transition);
        }

        .admin-info:hover {
            background: var(--gray-100);
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .admin-avatar i {
            font-size: 1.2rem;
            color: white;
        }

        .admin-details {
            display: none;
        }

        @media (min-width: 768px) {
            .admin-details {
                display: block;
            }
            .admin-details h4 {
                font-size: 0.9rem;
                font-weight: 600;
            }
            .admin-details p {
                font-size: 0.7rem;
                color: var(--gray-500);
            }
        }

        /* ========== STATS CARDS ========== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: var(--transition);
            border: 1px solid var(--gray-200);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--primary);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .stat-info h3 {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--gray-500);
            margin-bottom: 8px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: var(--gray-800);
        }

        .stat-trend {
            font-size: 0.7rem;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .stat-trend.up {
            color: var(--success);
        }

        .stat-trend.down {
            color: var(--danger);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            background: var(--primary-bg);
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon i {
            font-size: 1.5rem;
            color: var(--primary);
        }

        /* ========== CHARTS SECTION ========== */
        .charts-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        .chart-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 20px;
            border: 1px solid var(--gray-200);
            transition: var(--transition);
        }

        .chart-card:hover {
            box-shadow: var(--shadow-sm);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-header h3 {
            font-size: 1rem;
            font-weight: 600;
        }

        .chart-header select {
            padding: 6px 12px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--gray-200);
            background: var(--white);
            font-size: 0.8rem;
            color: var(--gray-600);
        }

        canvas {
            max-height: 280px;
            width: 100%;
        }

        /* ========== TABLES SECTION ========== */
        .recent-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 32px;
        }

        .data-table-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .table-header {
            padding: 18px 20px;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h3 {
            font-size: 1rem;
            font-weight: 600;
        }

        .table-header a {
            font-size: 0.8rem;
            color: var(--primary);
            text-decoration: none;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            text-align: left;
            padding: 12px 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--gray-500);
            background: var(--gray-50);
        }

        .data-table td {
            padding: 12px 20px;
            font-size: 0.85rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .status-badge.active {
            background: var(--success-bg);
            color: var(--success);
        }

        .status-badge.pending {
            background: var(--warning-bg);
            color: var(--warning);
        }

        .status-badge.inactive {
            background: var(--danger-bg);
            color: var(--danger);
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            width: 28px;
            height: 28px;
            border-radius: var(--radius-sm);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            background: var(--gray-100);
            color: var(--gray-600);
        }

        .action-btn:hover {
            background: var(--primary);
            color: white;
        }

        /* ========== QUICK ACTIONS SECTION ========== */
        .quick-actions {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: var(--radius-lg);
            padding: 24px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 32px;
        }

        .quick-actions h3 {
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .quick-actions p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.85rem;
            margin-top: 4px;
        }

        .action-buttons-group {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .quick-btn {
            padding: 10px 20px;
            border-radius: var(--radius);
            background: rgba(255, 255, 255, 0.2);
            color: white;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .quick-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 1200px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
            
            .charts-grid {
                grid-template-columns: 1fr;
            }
            
            .recent-section {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .quick-actions {
                flex-direction: column;
                text-align: center;
            }
            
            .top-navbar {
                flex-direction: column;
                gap: 16px;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .main-content {
                padding: 16px;
            }
        }

        /* Animation for cards */
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

        .stat-card, .chart-card, .data-table-card {
            animation: fadeInUp 0.5s ease backwards;
        }

        .stat-card:nth-child(1) { animation-delay: 0.05s; }
        .stat-card:nth-child(2) { animation-delay: 0.1s; }
        .stat-card:nth-child(3) { animation-delay: 0.15s; }
        .stat-card:nth-child(4) { animation-delay: 0.2s; }
    </style>
</head>
<body>
<?php include('sidebar.php'); ?>
<!-- MAIN CONTENT - Standalone Dashboard -->
<div class="main-content">
    <!-- Top Navbar -->
    <div class="top-navbar">
        <div class="page-title">
            <h1>Admin Dashboard</h1>
            <p>Welcome back! Here's what's happening with your platform today.</p>
        </div>
        <div class="navbar-actions">
            <div class="notification-icon">
                <i class="bi bi-bell"></i>
                <span class="notification-badge">5</span>
            </div>
            <div class="admin-info">
                <div class="admin-avatar">
                    <i class="bi bi-person-circle"></i>
                </div>
                <div class="admin-details">
                    <h4>BRYAN</h4>
                    <p>Admin</p>
                </div>
                <i class="bi bi-chevron-down" style="font-size: 0.8rem; color: var(--gray-500);"></i>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <h3>Total Students</h3>
                <div class="stat-number">5</div>
                <div class="stat-trend up">
                    <i class="bi bi-arrow-up-short"></i> +12.4% from last month
                </div>
            </div>
            <div class="stat-icon">
                <i class="bi bi-people"></i>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-info">
                <h3>Verified Experts</h3>
                <div class="stat-number">4</div>
                <div class="stat-trend up">
                    <i class="bi bi-arrow-up-short"></i> +1 new this month
                </div>
            </div>
            <div class="stat-icon">
                <i class="bi bi-person-badge"></i>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-info">
                <h3>Partner Institutes</h3>
                <div class="stat-number">2</div>
                <div class="stat-trend">
                    <i class="bi bi-building"></i> Across  regions
                </div>
            </div>
            <div class="stat-icon">
                <i class="bi bi-building"></i>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-info">
                <h3>Active Sessions</h3>
                <div class="stat-number">14</div>
                <div class="stat-trend up">
                    <i class="bi bi-arrow-up-short"></i> +5 this week
                </div>
            </div>
            <div class="stat-icon">
                <i class="bi bi-calendar-check"></i>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="charts-grid">
        <div class="chart-card">
            <div class="chart-header">
                <h3>Students</h3>
                <select id="yearSelect">
                    <option>2025</option>
                    <option>2026</option>
                </select>
            </div>
            <canvas id="enrollmentChart"></canvas>
        </div>
        <div class="chart-card">
            <div class="chart-header">
                <h3>Student Distribution by Region</h3>
                <select id="regionSelect">
                    <option>All Regions</option>
                </select>
            </div>
            <canvas id="regionChart"></canvas>
        </div>
    </div>

    <!-- Recent Data Tables -->
    <div class="recent-section">
        <!-- Recent Students -->
        <div class="data-table-card">
            <div class="table-header">
                <h3><i class="bi bi-people"></i> Recent Students</h3>
                <a href="#">View All <i class="bi bi-arrow-right"></i></a>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Region</th>
                        <th>Institute</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Amara Nkosi</td>
                        <td>Yaoundé</td>
                        <td>NANFAH Institute</td>
                        <td><span class="status-badge active">Active</span></td>
                    </tr>
                    <tr>
                        <td>James K.</td>
                        <td>Adamawa</td>
                        <td>Garoua Tech</td>
                        <td><span class="status-badge active">Active</span></td>
                    </tr>
                    <tr>
                        <td>BONGKISHE</td>
                        <td>South</td>
                        <td>Ebolowa CS</td>
                        <td><span class="status-badge pending">Pending</span></td>
                    </tr>
                    <tr>
                        <td>Marie Mbarga</td>
                        <td>Douala</td>
                        <td>Douala Tech Hub</td>
                        <td><span class="status-badge active">Active</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Recent Experts -->
        <div class="data-table-card">
            <div class="table-header">
                <h3><i class="bi bi-person-badge"></i> Recent Experts</h3>
                <a href="#">View All <i class="bi bi-arrow-right"></i></a>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Specialization</th>
                        <th>Mentees</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Bryan T.</td>
                        <td>Computer Science</td>
                        <td>12</td>
                        <td><span class="status-badge active">Active</span></td>
                    </tr>
                    <tr>
                        <td>Dr. Peterson</td>
                        <td>Algorithms</td>
                        <td>8</td>
                        <td><span class="status-badge active">Active</span></td>
                    </tr>
                    <tr>
                        <td>Prof. Chen</td>
                        <td>Database Systems</td>
                        <td>10</td>
                        <td><span class="status-badge active">Active</span></td>
                    </tr>
                    <tr>
                        <td>Mrs. Atanga</td>
                        <td>AI Ethics</td>
                        <td>5</td>
                        <td><span class="status-badge pending">Pending</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="quick-actions">
        <div>
            <h3><i class="bi bi-lightning-charge"></i> Quick Actions</h3>
            <p>Manage your platform efficiently with these shortcuts</p>
        </div>
        <div class="action-buttons-group">
            <a href="#" class="quick-btn"><i class="bi bi-person-plus"></i> Add Student</a>
            <a href="#" class="quick-btn"><i class="bi bi-person-badge-plus"></i> Add Expert</a>
            <a href="#" class="quick-btn"><i class="bi bi-building-add"></i> Add Institute</a>
            <a href="#" class="quick-btn"><i class="bi bi-file-earmark-text"></i> Generate Report</a>
        </div>
    </div>

    <!-- Pending Verifications Section -->
    <div class="data-table-card" style="margin-bottom: 32px;">
        <div class="table-header">
            <h3><i class="bi bi-shield-check"></i> Pending Verifications</h3>
            <a href="#">Process All</a>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Region</th>
                    <th>Submitted</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="status-badge warning">Institute</span></td>
                    <td>Coastal IT School</td>
                    <td>Littoral</td>
                    <td>2 days ago</td>
                    <td>
                        <div class="action-buttons">
                            <span class="action-btn"><i class="bi bi-check-lg"></i></span>
                            <span class="action-btn"><i class="bi bi-x-lg"></i></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><span class="status-badge warning">Expert</span></td>
                    <td>Mr. Njoya C.</td>
                    <td>West</td>
                    <td>5 days ago</td>
                    <td>
                        <div class="action-buttons">
                            <span class="action-btn"><i class="bi bi-check-lg"></i></span>
                            <span class="action-btn"><i class="bi bi-x-lg"></i></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><span class="status-badge warning">Institute</span></td>
                    <td>Adamawa Tech Hub</td>
                    <td>Adamawa</td>
                    <td>1 day ago</td>
                    <td>
                        <div class="action-buttons">
                            <span class="action-btn"><i class="bi bi-check-lg"></i></span>
                            <span class="action-btn"><i class="bi bi-x-lg"></i></span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Enrollment Chart
    const enrollmentCtx = document.getElementById('enrollmentChart').getContext('2d');
    new Chart(enrollmentCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'New Students',
                data: [65, 72, 88, 95, 112, 128, 145, 138, 156, 178, 195, 201],
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.05)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#3b82f6',
                pointBorderColor: 'white',
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });

    // Region Distribution Chart
    const regionCtx = document.getElementById('regionChart').getContext('2d');
    new Chart(regionCtx, {
        type: 'doughnut',
        data: {
            labels: ['Centre', 'Littoral', 'West', 'Adamawa', 'South', 'North', 'Far North', 'East'],
            datasets: [{
                data: [420, 310, 280, 150, 124, 98, 76, 52],
                backgroundColor: [
                    '#3b82f6',
                    '#60a5fa',
                    '#8b5cf6',
                    '#10b981',
                    '#f59e0b',
                    '#ef4444',
                    '#ec489a',
                    '#06b6d4'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        font: { size: 10 }
                    }
                }
            }
        }
    });

    // Animation for cards
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.stat-card, .chart-card, .data-table-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 50);
        });
    });
</script>

</body>
</html>