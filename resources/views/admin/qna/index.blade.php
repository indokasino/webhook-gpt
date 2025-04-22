<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QnA Management - Webhook GPT</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f8fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1140px;
            margin: 0 auto;
            padding: 20px;
        }
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .nav-menu {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0 0 30px 0;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .nav-menu li {
            padding: 0;
        }
        .nav-menu li a {
            display: block;
            padding: 15px 20px;
            color: #333;
            text-decoration: none;
            transition: background-color 0.2s;
        }
        .nav-menu li a:hover, .nav-menu li a.active {
            background-color: #f0f0f0;
        }
        .btn {
            display: inline-block;
            background: #3490dc;
            color: white;
            padding: 10px 15px;
            border-radius: 4px;
            text-decoration: none;
            margin-right: 10px;
        }
        .btn-primary {
            background: #3490dc;
        }
        .btn-success {
            background: #38c172;
        }
        .table {
            width: 100%;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .table th, .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .filter-form {
            margin-bottom: 20px;
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .filter-form input, .filter-form select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
        }
        .badge-success {
            background: #d4edda;
            color: #155724;
        }
        .badge-secondary {
            background: #e2e3e5;
            color: #383d41;
        }
        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>QnA Management</h1>
            <a href="{{ route('qna.create') }}" class="btn btn-success">Tambah QnA Baru</a>
        </div>
        
        <ul class="nav-menu">
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('qna.index') }}" class="active">QnA Management</a></li>
            <li><a href="{{ route('logs.index') }}">Log Interaksi</a></li>
            <li><a href="{{ route('prompts.index') }}">Manage Prompts</a></li>
            <li><a href="{{ route('settings.index') }}">Settings</a></li>
        </ul>
        
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        
        <form action="{{ route('qna.index') }}" method="GET" class="filter-form">
            <input type="text" name="search" placeholder="Cari..." value="{{ request('search') }}">
            <select name="status">
                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        
        @if(count($qnas ?? []) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pertanyaan</th>
                    <th>Status</th>
                    <th>Confidence</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($qnas as $qna)
                <tr>
                    <td>{{ $qna->id }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($qna->question, 80) }}</td>
                    <td>
                        <span class="badge badge-{{ $qna->status === 'active' ? 'success' : ($qna->status === 'inactive' ? 'secondary' : 'warning') }}">
                            {{ ucfirst($qna->status) }}
                        </span>
                    </td>
                    <td>{{ number_format($qna->confidence_score, 2) }}</td>
                    <td>
                        <a href="{{ route('qna.edit', $qna->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('qna.destroy', $qna->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        {{ $qnas->links() }}
        @else
        <p>Tidak ada data QnA yang ditemukan.</p>
        @endif
    </div>
</body>
</html>