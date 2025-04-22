<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Webhook GPT Admin Panel')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #06b6d4;
            --primary-dark: #0891b2;
            --primary-light: #22d3ee;
            --secondary: #6366f1;
            --success: #10b981;
            --info: #3b82f6;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #0f172a;
            --light: #f8fafc;
            --gray: #64748b;
            --gray-light: #cbd5e1;
            --gray-dark: #334155;
            --radius: 0.5rem;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Inter', 'Segoe UI', -apple-system, sans-serif;
            background-color: #0f172a;
            color: var(--light);
            line-height: 1.6;
        }
        
        .app-container {
            display: flex;
            min-height: 100vh;
        }
        
        .sidebar {
            width: 260px;
            background-color: #1e293b;
            border-right: 1px solid #334155;
            padding: 2rem 0;
            display: flex;
            flex-direction: column;
        }
        
        .sidebar-header {
            padding: 0 1.5rem 1.5rem;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid rgba(148, 163, 184, 0.1);
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        
        .logo i {
            margin-right: 0.75rem;
        }
        
        .sidebar-title {
            font-size: 0.875rem;
            color: var(--gray);
        }
        
        .nav-menu {
            list-style: none;
            flex: 1;
        }
        
        .nav-item {
            margin-bottom: 0.25rem;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.5rem;
            color: var(--gray-light);
            text-decoration: none;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        
        .nav-link:hover {
            background-color: rgba(226, 232, 240, 0.05);
            color: var(--light);
        }
        
        .nav-link.active {
            background-color: rgba(6, 182, 212, 0.1);
            color: var(--primary);
            border-left-color: var(--primary);
        }
        
        .nav-link i {
            width: 20px;
            margin-right: 0.75rem;
            font-size: 1.125rem;
        }
        
        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-x: hidden;
        }
        
        .dashboard-header {
            margin-bottom: 2rem;
        }
        
        .header-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--light);
        }
        
        .card {
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: var(--radius);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            padding: 1.25rem;
            border-bottom: 1px solid #334155;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--light);
            display: flex;
            align-items: center;
        }
        
        .card-title i {
            margin-right: 0.75rem;
            color: var(--primary);
        }
        
        .card-body {
            padding: 1.25rem;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius);
            font-weight: 500;
            font-size: 0.875rem;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
        }
        
        .btn i {
            margin-right: 0.5rem;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: var(--light);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
        }
        
        .btn-success {
            background-color: var(--success);
            color: var(--light);
        }
        
        .btn-success:hover {
            background-color: #0ca875;
        }
        
        .btn-danger {
            background-color: var(--danger);
            color: var(--light);
        }
        
        .btn-danger:hover {
            background-color: #dc2626;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table th,
        .table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #334155;
        }
        
        .table th {
            font-weight: 600;
            color: var(--gray-light);
            background-color: rgba(6, 182, 212, 0.05);
        }
        
        .table tr:hover {
            background-color: rgba(6, 182, 212, 0.02);
        }
        
        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .badge-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }
        
        .badge-warning {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }
        
        .badge-secondary {
            background-color: rgba(100, 116, 139, 0.1);
            color: var(--gray);
        }
        
        .form-group {
            margin-bottom: 1.25rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--gray-light);
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: var(--radius);
            color: var(--light);
            font-family: inherit;
            font-size: 0.875rem;
            transition: border-color 0.2s;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(6, 182, 212, 0.1);
        }
        
        .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: var(--radius);
            color: var(--light);
            font-family: inherit;
            font-size: 0.875rem;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23cbd5e1'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1rem;
        }
        
        .form-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(6, 182, 212, 0.1);
        }
        
        .alert {
            padding: 1rem;
            border-radius: var(--radius);
            margin-bottom: 1.5rem;
        }
        
        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: var(--success);
        }
        
        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: var(--danger);
        }
        
        .alert-warning {
            background-color: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.2);
            color: var(--warning);
        }
        
        .pagination {
            display: flex;
            list-style: none;
            margin-top: 1.5rem;
        }
        
        .pagination-item {
            margin-right: 0.5rem;
        }
        
        .pagination-link {
            display: block;
            padding: 0.5rem 0.75rem;
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: var(--radius);
            color: var(--gray-light);
            text-decoration: none;
            transition: all 0.2s;
        }
        
        .pagination-link:hover {
            background-color: rgba(6, 182, 212, 0.1);
            color: var(--primary);
        }
        
        .pagination-link.active {
            background-color: var(--primary);
            border-color: var(--primary);
            color: var(--light);
        }
        
        .logout-form {
            margin-top: auto;
            padding: 0 1.5rem;
        }
        
        .logout-btn {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 0.875rem 1.5rem;
            background-color: transparent;
            border: 1px solid #334155;
            border-radius: var(--radius);
            color: var(--gray-light);
            font-family: inherit;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .logout-btn:hover {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            border-color: var(--danger);
        }
        
        .logout-btn i {
            margin-right: 0.75rem;
        }
        
        @media (max-width: 992px) {
            .app-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                padding: 1rem 0;
            }
            
            .nav-menu {
                display: flex;
                flex-wrap: wrap;
            }
            
            .nav-item {
                width: 50%;
            }
            
            .main-content {
                padding: 1.5rem;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="app-container">
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-robot"></i>
                    <span>Webhook GPT</span>
                </div>
                <div class="sidebar-title">Admin Panel</div>
            </div>
            
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('qna.index') }}" class="nav-link {{ request()->routeIs('qna.*') ? 'active' : '' }}">
                        <i class="fas fa-question-circle"></i>
                        <span>QnA Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logs.index') }}" class="nav-link {{ request()->routeIs('logs.*') ? 'active' : '' }}">
                        <i class="fas fa-history"></i>
                        <span>Log Interaksi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('prompts.index') }}" class="nav-link {{ request()->routeIs('prompts.*') ? 'active' : '' }}">
                        <i class="fas fa-comment-alt"></i>
                        <span>Manage Prompts</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('settings.index') }}" class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
            
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
        
        <div class="main-content">
            @yield('content')
        </div>
    </div>
    
    @yield('scripts')
</body>
</html>