@extends('layouts.common')

@section('content')

@php
    $breadcrumb = 'Dashboard';
    $title = 'Project Dashboard';
@endphp
@php
    $boardColors = [
        'cbse' => 'var(--c-blue)',
        'icse' => 'var(--c-green)',
        'state' => 'var(--c-amber)',
        'up' => 'var(--c-violet)',

        // Future defaults
        'ib' => '#8b5cf6',
        'cambridge' => '#06b6d4',
        'nios' => '#ec4899',
    ];

    $defaultColors = [
        '#3b82f6',
        '#22c55e',
        '#f59e0b',
        '#8b5cf6',
        '#06b6d4',
        '#ef4444',
        '#14b8a6',
        '#e11d48',
        '#0ea5e9',
        '#84cc16',
    ];
@endphp
<style>
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@500;600;700;800&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500&display=swap');

    .g-root, .g-root * {
        box-sizing: border-box;
    }

    .g-root {
        --bg: #f4f5fb;
        --surface: #ffffff;
        --surface-soft: #fafaff;
        --ink: #1a1a2e;
        --ink-soft: #6b6b85;
        --ink-faint: #9a9ab0;
        --line: #eaeaf3;

        --primary: #4338ca;
        --primary-ink: #372e8a;
        --primary-soft: #edecfd;

        --amber: #dc8a00;
        --amber-soft: #fdf1dd;
        --green: #158f63;
        --green-soft: #e4f6ee;
        --red: #d64545;
        --red-soft: #fce9e9;
        --teal: #0e829b;
        --teal-soft: #e3f4f8;
        --violet: #6f4ff2;
        --violet-soft: #efeafe;
        --gray-soft: #f1f1f7;

        --radius-lg: 18px;
        --radius-md: 12px;
        --radius-sm: 8px;
        --shadow-card: 0 1px 2px rgba(26,26,46,.04), 0 10px 24px -18px rgba(26,26,46,.18);

        color: var(--ink);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
       
        border-radius: 20px;
    }

    .g-root h1, .g-root h2, .g-root h3,
    .g-root .kpi-value, .g-root .stat-big, .g-root .panel-title, .g-root .bm-val {
        font-family: 'Sora', 'Inter', sans-serif;
    }

    .g-root .mono { font-family: 'JetBrains Mono', monospace; }

    /* ── Eyebrow / section labels ── */
    .section-label, .sec-label {
        position: relative;
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .6px;
        color: var(--ink-soft);
        margin: 28px 0 12px;
        padding-left: 14px;
    }

    .section-label:first-child, .sec-label:first-child { margin-top: 0; }

    .section-label::before, .sec-label::before {
        content: '';
        position: absolute;
        left: 0;
        top: 2px;
        width: 4px;
        height: 12px;
        border-radius: 2px;
        background: linear-gradient(180deg, var(--primary), var(--violet));
    }

    /* ── KPI Grid ── */
    .kpi-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 12px;
        margin-bottom: 8px;
    }

    .kpi-card {
        position: relative;
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: var(--radius-lg);
        padding: 16px 18px 14px;
        box-shadow: var(--shadow-card);
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
        overflow: hidden;
    }

    .kpi-card::after {
        content: '';
        position: absolute;
        left: 0; right: 0; bottom: 0;
        height: 3px;
        background: var(--bar-color, var(--primary));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform .25s ease;
    }

    .kpi-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 30px -18px rgba(26,26,46,.28);
    }

    .kpi-card:hover::after { transform: scaleX(1); }

    .kpi-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
    }

    .kpi-label {
        font-size: 11px;
        color: var(--ink-soft);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .kpi-icon {
        width: 32px;
        height: 32px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .kpi-value {
        font-size: 25px;
        font-weight: 700;
        color: var(--ink);
        line-height: 1;
        letter-spacing: -.2px;
    }

    .kpi-sub {
        font-size: 11.5px;
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 4px;
        color: var(--ink-faint);
    }

    .icon-green { background: var(--green-soft); color: var(--green); }
    .icon-blue { background: var(--primary-soft); color: var(--primary); }
    .icon-teal { background: var(--teal-soft); color: var(--teal); }
    .icon-amber { background: var(--amber-soft); color: var(--amber); }
    .icon-red { background: var(--red-soft); color: var(--red); }
    .icon-violet { background: var(--violet-soft); color: var(--violet); }
    .icon-gray { background: var(--gray-soft); color: var(--ink-soft); }

    .text-ok { color: var(--green); }
    .text-warn { color: var(--amber); }
    .text-err { color: var(--red); }
    .text-mute { color: var(--ink-faint); }

    /* ── Panels / cards ── */
    .panel, .custom-card {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: var(--radius-lg);
        padding: 18px 20px 20px;
        margin-bottom: 12px;
        box-shadow: var(--shadow-card);
    }

    .panel-title {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--ink);
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--line);
    }

    .panel-title i {
        font-size: 16px;
    }

    .panel-title .title-right {
        margin-left: auto;
        font-size: 11px;
        font-weight: 500;
        color: var(--ink-faint);
        background: var(--surface-soft);
        border: 1px solid var(--line);
        padding: 3px 9px;
        border-radius: 20px;
    }

    .badge {
        font-size: 10.5px;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: .3px;
    }

    .badge-green { background: var(--green-soft); color: var(--green); }
    .badge-sm { background: var(--gray-soft); color: var(--ink-soft); font-weight: 600; }

    /* ── Layout grids ── */
    .charts-2col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .charts-3col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .g-main-grid {
        display: grid;
        grid-template-columns: 2.15fr 1fr;
        gap: 12px;
        align-items: start;
    }

    .g-side-col .panel:last-child { margin-bottom: 0; }

    .g2 {
        display: grid;
        grid-template-columns: 1.3fr 1fr;
        gap: 12px;
    }

    @media (max-width: 1100px) {
        .g-main-grid, .g2 { grid-template-columns: 1fr; }
    }

    @media (max-width: 992px) {
        .charts-2col { grid-template-columns: 1fr; }
        .charts-3col { grid-template-columns: 1fr 1fr; }
    }

    @media (max-width: 600px) {
        .charts-3col { grid-template-columns: 1fr; }
        .g-root { padding: 12px; }
    }

    .ch {
        position: relative;
        width: 100%;
    }

    /* ── Legend ── */
    .legend-row {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        margin-bottom: 10px;
    }

    .leg {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        color: var(--ink-soft);
    }

    .leg-sq {
        width: 9px;
        height: 9px;
        border-radius: 2px;
        flex-shrink: 0;
    }

    /* ── Stock health ── */
    .stat-big {
        font-size: 38px;
        font-weight: 800;
        color: var(--ink);
        line-height: 1;
        margin-bottom: 3px;
        letter-spacing: -.5px;
    }

    .stat-sub {
        font-size: 11.5px;
        color: var(--ink-faint);
    }

    .divider {
        width: 100%;
        height: 1px;
        background: var(--line);
        margin: 14px 0;
    }

    .progress-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .prog-header {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        color: var(--ink-soft);
        margin-bottom: 5px;
    }

    .prog-header span:last-child {
        font-weight: 700;
        color: var(--ink);
    }

    .prog-bar {
        height: 6px;
        background: var(--gray-soft);
        border-radius: 3px;
        overflow: hidden;
    }

    .prog-fill {
        height: 100%;
        border-radius: 3px;
    }

    /* ── Donut ring ── */
    .ring-wrap {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .ring-legend {
        display: flex;
        flex-direction: column;
        gap: 9px;
        flex: 1;
    }

    .ring-leg-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 12px;
    }

    .ring-leg-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
        margin-right: 6px;
    }

    .ring-leg-label {
        display: flex;
        align-items: center;
        color: var(--ink-soft);
        flex: 1;
    }

    .ring-leg-val {
        font-weight: 700;
        color: var(--ink);
    }

    /* ── Board mini stats ── */
    .board-mini-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(90px, 1fr));
        gap: 10px;
        margin-top: 14px;
    }

    .board-mini {
        background: var(--surface-soft);
        border: 1px solid var(--line);
        border-radius: var(--radius-sm);
        padding: 10px 10px 9px;
        text-align: center;
    }

    .bm-val {
        font-size: 17px;
        font-weight: 700;
        line-height: 1.1;
    }

    .bm-lbl {
        font-size: 10px;
        color: var(--ink-faint);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .3px;
        margin-top: 3px;
    }

    /* ── Recent activity feed ── */
    .activity-list {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .act-row {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 10px 6px;
        border-radius: var(--radius-sm);
        transition: background .15s ease;
    }

    a.act-row:hover { background: var(--surface-soft); }

    .act-avatar {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .act-body {
        flex: 1;
        min-width: 0;
    }

    .act-name {
        font-size: 12.5px;
        font-weight: 600;
        color: var(--ink);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .act-meta {
        font-size: 11px;
        color: var(--ink-faint);
        margin-top: 1px;
    }

    .act-badge {
        font-size: 10px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 20px;
        flex-shrink: 0;
        white-space: nowrap;
    }

    /* ── Tables ── */
    .g-root .table-responsive { margin: 0 -2px; }

    .g-root table.table {
        width: 100%;
        border-collapse: collapse;
    }

    .g-root table.table thead th {
        font-size: 10.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .4px;
        color: var(--ink-faint);
        text-align: left;
        padding: 0 8px 9px;
        border-bottom: 1px solid var(--line);
    }

    .g-root table.table tbody td {
        padding: 10px 8px;
        border-bottom: 1px solid var(--line);
        color: var(--ink);
        vertical-align: middle;
    }

    .g-root table.table tbody tr:last-child td { border-bottom: none; }
    .g-root table.table tbody tr:hover td { background: var(--surface-soft); }

    .g-root .btn-xs {
        font-size: 11px;
        font-weight: 600;
        padding: 4px 11px;
        border-radius: 20px;
        border: none;
        text-decoration: none;
        display: inline-block;
    }

    .g-root .btn-primary {
        background: var(--primary-soft);
        color: var(--primary);
    }

    .g-root .btn-primary:hover { background: var(--primary); color: #fff; }
        .panel-select {
        font-size: 12px;
        font-weight: 500;
        color: var(--ink-soft);
        background: var(--surface-soft);
        border: 1px solid var(--line);
        border-radius: 20px;
        padding: 6px 14px;
    }

    /* ── Tables ── */
    .g-root table.premium-table {
        width: 100%;
        border-collapse: collapse;
    }

    .g-root table.premium-table thead th {
        font-size: 10.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .4px;
        color: var(--ink-faint);
        text-align: left;
        padding: 0 8px 10px;
        border-bottom: 1px solid var(--line);
    }

    .g-root table.premium-table tbody td {
        padding: 12px 8px;
        border-bottom: 1px solid var(--line);
        color: var(--ink);
        vertical-align: middle;
        font-size: 13px;
    }

    .g-root table.premium-table tbody tr:last-child td { border-bottom: none; }
    .g-root table.premium-table tbody tr:hover td { background: var(--surface-soft); }

    /* ── AI Insights ── */
    .insight-card {
        padding: 14px 16px;
        border-radius: var(--radius-md);
        margin-bottom: 10px;
        display: flex;
        gap: 13px;
        align-items: center;
        border: 1px solid transparent;
    }

    .insight-card:last-child { margin-bottom: 0; }

    .insight-positive { background: var(--green-soft); border-color: rgba(21,143,99,.18); }
    .insight-warning { background: var(--amber-soft); border-color: rgba(220,138,0,.18); }
    .insight-info { background: var(--primary-soft); border-color: rgba(67,56,202,.18); }

    .insight-icon {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        flex-shrink: 0;
        box-shadow: 0 2px 6px rgba(26,26,46,.08);
    }

    .insight-text { font-size: 12.5px; font-weight: 500; color: var(--ink); margin-bottom: 2px; }

    .insight-action {
        text-decoration: none;
        font-weight: 700;
        font-size: 11px;
        color: var(--ink);
        display: inline-flex;
        align-items: center;
        gap: 3px;
    }

    /* ── Tasks ── */
    .task-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid var(--line);
    }

    .task-item:last-child { border-bottom: none; padding-bottom: 0; }
    .task-item:first-child { padding-top: 0; }

    .task-checkbox {
        width: 19px;
        height: 19px;
        border-radius: 6px;
        border: 2px solid var(--line);
        cursor: pointer;
        flex-shrink: 0;
        position: relative;
    }

    .task-checkbox.checked {
        background: var(--primary);
        border-color: var(--primary);
    }

    .task-checkbox.checked::after {
        content: '✓';
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .task-name {
        font-size: 12.5px;
        font-weight: 600;
        color: var(--ink);
        margin-bottom: 4px;
    }

    .task-name.done {
        text-decoration: line-through;
        color: var(--ink-faint);
    }

    .priority-pill {
        font-size: 9.5px;
        padding: 3px 9px;
        border-radius: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .3px;
    }

    .p-high { background: var(--red-soft); color: var(--red); }
    .p-medium { background: var(--amber-soft); color: var(--amber); }
    .p-low { background: var(--green-soft); color: var(--green); }

    /* ── Payment Summary ── */
    .payment-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid var(--line);
        font-size: 13px;
    }

    .payment-row .lbl { color: var(--ink-soft); }
    .payment-row .val { font-weight: 600; color: var(--ink); }
    .payment-row .val.neg { color: var(--red); }

    .payment-row.total {
        border-bottom: none;
        margin-top: 6px;
        padding-top: 18px;
        font-weight: 700;
        font-size: 19px;
        color: var(--primary);
        font-family: 'Sora', sans-serif;
    }

    .payment-row.total .lbl { color: var(--ink); font-size: 13px; font-weight: 600; font-family: 'Inter', sans-serif; }

</style>
    @if (auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
        @include('dashboard.super-admin')
    @elseif(auth()->user()->hasRole('vendor'))
        @include('dashboard.vendor')
    @elseif(auth()->user()->hasRole('school'))
        @include('dashboard.school')
    @elseif(auth()->user()->hasRole('parent'))
        @include('dashboard.parent')
    @else
        @include('dashboard.default')
    @endif
@endsection
