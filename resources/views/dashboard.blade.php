<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            padding: 20px 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            padding: 0 24px;
            margin-bottom: 30px;
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-menu a {
            text-decoration: none;
            color: white;

        }

        .nav-item {
            padding: 12px 24px;
            margin: 4px 0;
            transition: all 0.3s;
            cursor: pointer;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            border-left: 3px solid #ff9800;
        }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.15);
            border-left: 3px solid #ff9800;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            padding: 30px;
        }

        /* Header */
        .header {
            background: white;
            border-radius: 10px;
            padding: 20px 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h1 {
            font-size: 28px;
            color: #1e3c72;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .stat-title {
            color: #7f8c8d;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 36px;
            font-weight: bold;
            color: #1e3c72;
            margin-bottom: 10px;
        }

        .stat-change {
            font-size: 13px;
            color: #27ae60;
        }

        /* Recent Activity Table */
        .recent-section {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 20px;
            margin-bottom: 20px;
            color: #1e3c72;
            border-left: 4px solid #ff9800;
            padding-left: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ecf0f1;
        }

        th {
            background: #f8f9fa;
            color: #555;
            font-weight: 600;
            font-size: 14px;
        }

        tr:hover {
            background: #fafafa;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .sidebar .logo span,
            .sidebar .nav-item span {
                display: none;
            }

            .main-content {
                margin-left: 70px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            📊 <span>Dashboard</span>
        </div>
        <ul class="nav-menu">
            <li class="nav-item active"><a href ='#'>🏠<span>Dashboard</span></a></li>
            <li class="nav-item"><a href ='#'><span>📈 Analytics</span></a></li>
            <li class="nav-item"><a href ='#'>👥 <span>Instructors</span></a></li>
            <li class="nav-item"><a href ='#'>⚙️ <span>Settings</span></a></li>
            <li class="nav-item"><a href ='#'>🚪<span>Logout</span></a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h1>Welcome back, John!</h1>
            <div class="user-info">
                <div class="avatar">JD</div>
                <span>John Doe</span>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-title">Total Users</div>
                <div class="stat-number">1,234</div>
                <div class="stat-change">↑ 12% from last month</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Revenue</div>
                <div class="stat-number">$45,678</div>
                <div class="stat-change">↑ 8% from last month</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Active Projects</div>
                <div class="stat-number">27</div>
                <div class="stat-change">3 in review</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Tasks Completed</div>
                <div class="stat-number">89%</div>
                <div class="stat-change">↑ 5% from last week</div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="recent-section">
            <div class="section-title">Recent Activity</div>
            <table>
                <thead>
                    <tr>
                        <th>Instructors</th>
                        <th>Action</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Sarah Johnson</td>
                        <td>Created new project</td>
                        <td>2024-01-15 10:30 AM</td>
                        <td><span class="badge badge-success">Completed</span></td>
                    </tr>
                    <tr>
                        <td>Mike Chen</td>
                        <td>Updated settings</td>
                        <td>2024-01-14 03:45 PM</td>
                        <td><span class="badge badge-success">Completed</span></td>
                    </tr>
                    <tr>
                        <td>Emma Watson</td>
                        <td>Uploaded documents</td>
                        <td>2024-01-14 11:20 AM</td>
                        <td><span class="badge badge-warning">Pending</span></td>
                    </tr>
                    <tr>
                        <td>Alex Rodriguez</td>
                        <td>Deleted user account</td>
                        <td>2024-01-13 09:15 AM</td>
                        <td><span class="badge badge-danger">Failed</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
```
