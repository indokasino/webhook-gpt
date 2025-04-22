<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Webhook GPT Admin Panel</title>
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
            
            /* Light Mode Colors */
            --light-bg: #f8fafc;
            --light-card: #ffffff;
            --light-card-darker: #f1f5f9;
            --light-text: #1e293b;
            --light-text-secondary: #64748b;
            --light-border: #e2e8f0;
            --light-input-bg: #f5f8fa;
            --light-input-border: #dbe7f3;
            
            /* Dark Mode Colors */
            --dark-bg: #0f172a;
            --dark-card: #1e293b;
            --dark-card-darker: #172033;
            --dark-text: #f8fafc;
            --dark-text-secondary: #94a3b8;
            --dark-border: #334155;
            --dark-input-bg: #1e293b;
            --dark-input-border: #334155;
        }
        
        html[data-theme="light"] {
            --bg: var(--light-bg);
            --card: var(--light-card);
            --card-darker: var(--light-card-darker);
            --text: var(--light-text);
            --text-secondary: var(--light-text-secondary);
            --border: var(--light-border);
            --input-bg: var(--light-input-bg);
            --input-border: var(--light-input-border);
        }
        
        html[data-theme="dark"] {
            --bg: var(--dark-bg);
            --card: var(--dark-card);
            --card-darker: var(--dark-card-darker);
            --text: var(--dark-text);
            --text-secondary: var(--dark-text-secondary);
            --border: var(--dark-border);
            --input-bg: var(--dark-input-bg);
            --input-border: var(--dark-input-border);
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: var(--bg);
            font-family: 'Inter', 'Segoe UI', -apple-system, sans-serif;
            color: var(--text);
        }
        
        .login-container {
            width: 100%;
            max-width: 400px;
            background: var(--card);
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-header h1 {
            margin: 0;
            color: var(--primary);
            font-size: 32px;
            font-weight: 700;
        }
        
        .login-header p {
            color: var(--text-secondary);
            margin-top: 5px;
            font-size: 16px;
        }
        
        .form-group {
            margin-bottom: 24px;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
            color: var(--text);
            font-size: 16px;
        }
        
        .input-wrapper {
            position: relative;
        }
        
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            background-color: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
            color: var(--text);
            transition: all 0.2s;
        }
        
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 2px rgba(6, 182, 212, 0.25);
        }
        
        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 16px;
        }
        
        .checkbox-container {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
        }
        
        .checkbox-container input {
            margin-right: 10px;
            width: 16px;
            height: 16px;
        }
        
        .checkbox-container label {
            margin-bottom: 0;
            font-size: 14px;
        }
        
        .btn-login {
            width: 100%;
            padding: 14px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
            transition: background-color 0.2s;
        }
        
        .btn-login:hover {
            background: var(--primary-dark);
        }
        
        .alert {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 24px;
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: var(--danger);
        }
        
        .alert ul {
            margin: 0;
            padding-left: 20px;
        }
        
        /* Theme switch styles */
        .theme-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: var(--card);
            border: 1px solid var(--border);
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }
        
        .theme-toggle:hover {
            transform: scale(1.05);
        }
        
        .theme-toggle i {
            font-size: 20px;
            color: var(--text);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Webhook GPT</h1>
            <p>Admin Panel</p>
        </div>
        
        @if($errors->any())
        <div class="alert">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@example.com">
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" required placeholder="••••••">
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                </div>
            </div>
            
            <div class="checkbox-container">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Ingat Saya</label>
            </div>
            
            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>
    
    <div class="theme-toggle" id="theme-toggle" title="Ubah Tema">
        <i class="fas fa-sun" id="theme-icon"></i>
    </div>
    
    <script>
        // Set theme based on localStorage or default to dark
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('theme-toggle');
            const themeIcon = document.getElementById('theme-icon');
            
            // Check for saved theme preference
            const savedTheme = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-theme', savedTheme);
            
            // Update icon based on current theme
            updateThemeIcon(savedTheme);
            
            // Handle theme toggle
            themeToggle.addEventListener('click', function() {
                const currentTheme = document.documentElement.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                document.documentElement.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                
                updateThemeIcon(newTheme);
            });
            
            function updateThemeIcon(theme) {
                if (theme === 'dark') {
                    themeIcon.classList.remove('fa-moon');
                    themeIcon.classList.add('fa-sun');
                } else {
                    themeIcon.classList.remove('fa-sun');
                    themeIcon.classList.add('fa-moon');
                }
            }
        });
    </script>
</body>
</html>