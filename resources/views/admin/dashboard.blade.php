@extends('admin.layout')

@section('title', 'Dashboard - Webhook GPT')

@section('content')
<div class="dashboard-header">
    <h1 class="header-title">Dashboard</h1>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon">
                <i class="fas fa-question-circle"></i>
            </div>
            <div class="stat-title">Total QnA</div>
        </div>
        <div class="stat-value">{{ $totalQna ?? 0 }}</div>
        <div class="stat-subtitle">{{ $activeQna ?? 0 }} QnA aktif</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon">
                <i class="fas fa-comments"></i>
            </div>
            <div class="stat-title">Total Interaksi</div>
        </div>
        <div class="stat-value">{{ $totalInteractions ?? 0 }}</div>
        <div class="stat-subtitle">Sejak awal penggunaan</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon">
                <i class="fas fa-database"></i>
            </div>
            <div class="stat-title">Jawaban Manual</div>
        </div>
        <div class="stat-value">{{ $manualResponses ?? 0 }}</div>
        <div class="stat-subtitle">{{ $manualPercentage ?? 0 }}% dari total interaksi</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon">
                <i class="fas fa-robot"></i>
            </div>
            <div class="stat-title">Jawaban AI</div>
        </div>
        <div class="stat-value">{{ $aiResponses ?? 0 }}</div>
        <div class="stat-subtitle">{{ 100 - ($manualPercentage ?? 0) }}% dari total interaksi</div>
    </div>
</div>

<div class="section">
    <div class="section-header">
        <div class="section-icon">
            <i class="fas fa-clock"></i>
        </div>
        <h2 class="section-title">Interaksi Terbaru</h2>
    </div>
    
    <div class="card">
        <div class="interaction-list">
            @if(isset($recentInteractions) && count($recentInteractions) > 0)
                @foreach($recentInteractions as $interaction)
                <div class="interaction-item">
                    <div class="interaction-question">{{ \Illuminate\Support\Str::limit($interaction->question, 100) }}</div>
                    <div class="interaction-meta">
                        <span><i class="fas fa-{{ $interaction->is_manual ? 'database' : 'robot' }}"></i> {{ $interaction->source }}</span>
                        <span><i class="far fa-clock"></i> {{ $interaction->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                @endforeach
            @else
                <div class="no-interactions">
                    <p>Belum ada interaksi</p>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="section">
    <div class="section-header">
        <div class="section-icon">
            <i class="fas fa-bolt"></i>
        </div>
        <h2 class="section-title">Aksi Cepat</h2>
    </div>
    
    <div class="actions">
        <a href="{{ route('qna.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Tambah QnA Baru
        </a>
        <a href="{{ route('logs.index') }}" class="btn btn-primary">
            <i class="fas fa-list"></i> Lihat Semua Log
        </a>
    </div>
</div>
@endsection

@section('styles')
<style>
    .section {
        margin-bottom: 2.5rem;
    }
    
    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .section-icon {
        width: 2rem;
        height: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(6, 182, 212, 0.1);
        color: var(--primary);
        border-radius: 0.5rem;
        margin-right: 0.75rem;
    }
    
    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text);
    }
    
    .interaction-list {
        padding: 0;
    }
    
    .interaction-item {
        padding: 1.25rem;
        border-bottom: 1px solid var(--border);
        transition: background-color 0.2s;
    }
    
    .interaction-item:hover {
        background-color: var(--hover);
    }
    
    .interaction-item:last-child {
        border-bottom: none;
    }
    
    .interaction-question {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--text);
    }
    
    .interaction-meta {
        display: flex;
        font-size: 0.75rem;
        color: var(--text-secondary);
    }
    
    .interaction-meta span {
        display: flex;
        align-items: center;
        margin-right: 1rem;
    }
    
    .interaction-meta i {
        margin-right: 0.375rem;
    }
    
    .no-interactions {
        padding: 2.5rem;
        text-align: center;
        color: var(--text-secondary);
        font-size: 0.875rem;
    }
    
    .actions {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }
</style>
@endsection