@extends('layouts.index')

@section('title')
    Home -
@endsection

@push('styles')
    <style>
        /* ───── PROFILE HERO ───── */
        .spmb-profile-hero {
            background: linear-gradient(135deg, #155a9c 0%, #1f6fc8 45%, #2b8ee8 100%);
            border-radius: 24px;
            padding: 24px 22px;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 18px 45px rgba(14, 36, 68, 0.22);
            border: 1px solid rgba(255,255,255,0.16);
            backdrop-filter: blur(6px);
        }
        .spmb-profile-hero::before {
            content: '';
            position: absolute;
            right: -45px; top: -55px;
            width: 205px; height: 205px;
            background: radial-gradient(circle, rgba(255,255,255,0.18) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        .spmb-profile-hero::after {
            content: '';
            position: absolute;
            left: 24px; bottom: -72px;
            width: 170px; height: 170px;
            background: radial-gradient(circle, rgba(253,230,138,0.18) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        .spmb-avatar-ring {
            width: 76px;
            height: 76px;
            border-radius: 16px;
            background: rgba(255,255,255,0.16);
            border: 2px solid rgba(255,255,255,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            font-weight: 800;
            color: white;
            flex-shrink: 0;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0,0,0,0.16);
        }
        .spmb-avatar-ring img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 14px;
        }
        @keyframes spmb-pulse { 0%,100%{opacity:1} 50%{opacity:0.4} }

        .spmb-info-tile {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 12px;
            padding: 12px 14px;
            transition: background 0.2s;
            min-height: 74px;
        }
        .spmb-info-tile:hover { background: rgba(255,255,255,0.16); }
        .spmb-info-tile .tile-lbl {
            font-size: 10px;
            opacity: 0.6;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 4px;
        }
        .spmb-info-tile .tile-val {
            font-size: 14px;
            font-weight: 700;
            line-height: 1.35;
        }
        .tile-val-score { font-size: 20px; font-weight: 800; color: #fcd34d; }

        .spmb-hero-address {
            background: rgba(255,255,255,0.11);
            border: 1px solid rgba(255,255,255,0.16);
            border-radius: 14px;
            padding: 12px 13px;
            position: relative;
            z-index: 1;
        }
        .spmb-hero-divider {
            height: 1px;
            background: rgba(255,255,255,0.16);
            margin: 14px 0 10px;
            position: relative;
            z-index: 1;
        }
        .spmb-hero-toggle {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.18);
            color: #fff;
            border-radius: 999px;
            padding: 6px 10px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }
        .spmb-hero-toggle:hover {
            background: rgba(255,255,255,0.2);
            color: #fff;
        }
        .spmb-hero-toggle .bi {
            transition: transform 0.2s ease;
        }
        .spmb-hero-toggle[aria-expanded="false"] .bi {
            transform: rotate(180deg);
        }

        .spmb-hero-actions .btn {
            width: 100%;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.2s ease;
        }
        .spmb-hero-actions .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(10, 35, 66, 0.16);
        }
        .spmb-hero-actions .btn-light:hover {
            background: #eaf4ff;
            color: #155a9c !important;
            border-color: #d5e8ff;
        }
        .spmb-hero-actions .btn-outline-light:hover {
            background: rgba(255,255,255,0.16);
            color: #fff !important;
            border-color: rgba(255,255,255,0.35);
        }


        .jalur-card {
            background: #fff;
            border-radius: 14px;
            border: 1.5px solid #dce6f0;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            margin-bottom: 12px;
        }
        .jalur-card::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 0;
            background: linear-gradient(180deg, #1e72cc, #1a5fa8);
            border-radius: 14px 0 0 14px;
            transition: width 0.25s ease;
        }
        .jalur-card:hover {
            border-color: #1e72cc;
            transform: translateX(3px);
            box-shadow: 0 6px 24px rgba(26,95,168,0.13);
            color: inherit;
            text-decoration: none;
        }
        .jalur-card:hover::before { width: 5px; }
        .jalur-card.selected {
            border-color: #1a5fa8;
            background: #f0f7ff;
        }
        .jalur-card.selected::before { width: 5px; }

        .jalur-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 24px;
            transition: transform 0.2s;
        }
        .jalur-card:hover .jalur-icon { transform: scale(1.08) rotate(-3deg); }
        .j-zonasi   { background: #e0eeff; }

        .jalur-title { font-size: 15px; font-weight: 700; color: #0d1f35; margin: 0 0 3px; }
        .jalur-desc  { font-size: 12px; color: #7a93ae; margin: 0 0 8px; line-height: 1.5; }

        .jalur-arrow {
            width: 32px; height: 32px;
            background: #f4f7fb;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #dce6f0;
            flex-shrink: 0;
            margin-left: auto;
            transition: all 0.2s;
        }
        .jalur-card:hover .jalur-arrow { background: #1a5fa8; border-color: #1a5fa8; }
        .jalur-card:hover .jalur-arrow i { color: white !important; }

        /* ───── TAGS ───── */
        .jtag {
            display: inline-block;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: 20px;
            letter-spacing: 0.2px;
        }
        .jtag-blue  { background: #dbeafe; color: #1d4ed8; }

        /* ───── DOC CHECKLIST ───── */
        .doc-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
            border-bottom: 1px solid #dce6f0;
            font-size: 13px;
            color: #3d5775;
        }
        .doc-item:last-child { border-bottom: none; padding-bottom: 0; }
        .doc-check {
            width: 22px; height: 22px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 13px;
        }
        .dc-done { background: #d1fae5; color: #10b981; }
        .dc-no   { background: #fee2e2; color: #ef4444; }
        .doc-name { flex: 1; font-weight: 500; }

        /* ───── TIMELINE ───── */
        .tl-item {
            display: flex;
            gap: 14px;
            padding-bottom: 20px;
            position: relative;
        }
        .tl-item:last-child { padding-bottom: 0; }
        .tl-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 15px; top: 32px; bottom: 0;
            width: 2px;
            background: #dce6f0;
        }
        .tl-dot {
            width: 32px; height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 12px;
            font-weight: 700;
            border: 2px solid transparent;
            z-index: 1;
        }
        .tl-done   { background: #d1fae5; color: #10b981; border-color: #10b981; }
        .tl-active { background: #dbeafe; color: #1a5fa8; border-color: #1a5fa8; animation: spmb-ring 2s infinite; }
        .tl-next   { background: #f3f4f6; color: #9ca3af; border-color: #e5e7eb; }
        @keyframes spmb-ring {
            0%,100%{box-shadow:0 0 0 0 rgba(30,114,204,0.3)}
            50%{box-shadow:0 0 0 5px rgba(30,114,204,0)}
        }

        /* ───── FLOATING SCHEDULE PANEL ───── */
        body.spmb-panel-open {
            overflow: hidden;
        }
        
        /* ───── SCHEDULE TAB - DEFAULT (DESKTOP) ───── */
        .spmb-schedule-tab {
            position: fixed;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            z-index: 1065;
            width: 52px;
            padding: 16px 8px;
            background: linear-gradient(135deg, #1e72cc 0%, #134a86 100%);
            border-radius: 16px 0 0 16px;
            box-shadow: -4px 0 15px rgba(15, 23, 42, 0.15);
            color: #fff;
            cursor: pointer;
            user-select: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-right: none;
            transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1), right 0.35s ease;
        }
        .spmb-schedule-tab.panel-open {
            right: 420px;
        }
        .spmb-schedule-tab:hover {
            color: #fff;
            width: 60px;
            background: linear-gradient(135deg, #2584e8 0%, #16569c 100%);
            box-shadow: -8px 0 25px rgba(30, 114, 204, 0.4);
        }
        .spmb-schedule-tab.panel-open:hover {
            width: 52px;
            right: 420px;
        }

        .spmb-schedule-tab .tab-icon {
            font-size: 20px;
            transition: transform 0.3s ease;
        }
        .spmb-schedule-tab:hover .tab-icon {
            transform: scale(1.1) rotate(-5deg);
        }
        .spmb-schedule-tab__label {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.2em;
            writing-mode: vertical-rl;
            text-orientation: mixed;
            transform: rotate(180deg);
            line-height: 1;
        }
        .spmb-schedule-tab__sub {
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 0.12em;
            opacity: 0.8;
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            line-height: 1;
        }
        .spmb-schedule-backdrop {
            position: fixed;
            inset: 0;
            z-index: 1060;
            background: rgba(13, 31, 53, 0.45);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.35s ease;
        }
        .spmb-schedule-backdrop.show {
            opacity: 1;
            pointer-events: auto;
        }
        .spmb-schedule-panel {
            position: fixed;
            top: 0;
            right: 0;
            z-index: 1061;
            width: 420px;
            max-width: calc(100vw - 18px);
            height: 100vh;
            background: #ffffff;
            box-shadow: -24px 0 42px rgba(15, 23, 42, 0.18);
            transform: translateX(100%);
            transition: transform 0.35s ease;
            display: flex;
            flex-direction: column;
        }
        .spmb-schedule-panel.open {
            transform: translateX(0);
        }
        .spmb-schedule-panel__header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            padding: 1.25rem 1.25rem 1rem;
            background: linear-gradient(180deg, #f8fbff 0%, #ffffff 100%);
            border-bottom: 1px solid #dce6f0;
        }
        .spmb-schedule-panel__close {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            border: 1px solid #dce6f0;
            background: #f4f7fb;
            color: #1a5fa8;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .spmb-schedule-panel__close:hover {
            background: #fee2e2;
            color: #ef4444;
            border-color: #fecaca;
        }
        .spmb-schedule-panel__body {
            flex: 1;
            overflow-y: auto;
            padding: 1rem 1.25rem 1.25rem;
        }
        .spmb-panel-section + .spmb-panel-section {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #dce6f0;
        }
        .spmb-schedule-panel .doc-item {
            padding: 11px 0;
        }

        /* ───── RESPONSIVE BREAKPOINTS ───── */

        /* Large Desktop (992px - 1199px) */
        @media (max-width: 1199.98px) {
            .row.g-5 {
                display: flex;
                flex-direction: column;
                gap: 1.25rem;
            }
            .spmb-schedule-panel {
                width: 450px;
                max-width: 85vw;
            }
            .spmb-schedule-tab.panel-open {
                right: 450px;
            }
            .spmb-schedule-tab.panel-open:hover {
                right: 450px;
            }
        }

        /* Tablet (768px - 991px) */
        @media (max-width: 991.98px) {
            .spmb-schedule-panel {
                width: 400px;
                max-width: 90vw;
            }
            
            /* Tab berubah jadi horizontal floating button */
            .spmb-schedule-tab {
                top: auto;
                bottom: 24px;
                right: 24px;
                transform: none;
                width: auto;
                min-width: 130px;
                height: 50px;
                padding: 12px 20px;
                flex-direction: row;
                border-radius: 25px;
                border: 1px solid rgba(255, 255, 255, 0.2);
                gap: 10px;
                justify-content: center;
                box-shadow: 0 4px 20px rgba(15, 23, 42, 0.25);
            }
            
            .spmb-schedule-tab.panel-open {
                right: 24px;
                bottom: 24px;
                opacity: 0;
                pointer-events: none;
                transform: translateY(20px);
            }
            
            .spmb-schedule-tab:hover {
                width: auto;
                min-width: 140px;
                transform: translateY(-3px);
                box-shadow: 0 8px 30px rgba(30, 114, 204, 0.4);
            }
            
            .spmb-schedule-tab.panel-open:hover {
                width: auto;
                right: 24px;
                transform: translateY(20px);
            }
            
            .spmb-schedule-tab .tab-icon {
                font-size: 18px;
            }
            
            .spmb-schedule-tab__label,
            .spmb-schedule-tab__sub {
                writing-mode: horizontal-tb;
                transform: none;
            }
            
            .spmb-schedule-tab__label {
                font-size: 12px;
                letter-spacing: 0.15em;
            }
            
            .spmb-schedule-panel__header {
                padding: 1rem 1.25rem 0.875rem;
            }
            
            .spmb-schedule-panel__body {
                padding: 0.875rem 1.25rem 1.25rem;
            }
        }

        /* Mobile Landscape (576px - 767px) */
        @media (max-width: 767.98px) {
            .spmb-schedule-panel {
                width: 100vw;
                max-width: 100vw;
            }
            
            .spmb-schedule-tab {
                bottom: 20px;
                right: 20px;
                min-width: 120px;
                height: 46px;
                padding: 10px 18px;
                border-radius: 23px;
            }
            
            .spmb-schedule-tab.panel-open {
                right: 20px;
                bottom: 20px;
            }
            
            .spmb-schedule-tab:hover {
                min-width: 125px;
            }
            
            .spmb-schedule-tab .tab-icon {
                font-size: 17px;
            }
            
            .spmb-schedule-tab__label {
                font-size: 11px;
            }
        }

        /* Mobile Portrait (max-width: 575px) */
        @media (max-width: 575.98px) {
            .spmb-schedule-tab {
                bottom: 16px;
                right: 16px;
                min-width: 110px;
                height: 44px;
                padding: 8px 16px;
                border-radius: 22px;
                gap: 8px;
            }
            
            .spmb-schedule-tab.panel-open {
                right: 16px;
                bottom: 16px;
            }
            
            .spmb-schedule-tab:hover {
                min-width: 115px;
                transform: translateY(-2px);
            }
            
            .spmb-schedule-tab .tab-icon {
                font-size: 16px;
            }
            
            .spmb-schedule-tab__label {
                font-size: 10px;
                letter-spacing: 0.1em;
            }
            
            .spmb-schedule-panel__header {
                padding: 0.875rem 1rem;
            }
            
            .spmb-schedule-panel__body {
                padding: 0.75rem 1rem;
            }
            
            .spmb-schedule-panel__close {
                width: 34px;
                height: 34px;
                border-radius: 10px;
            }
            
            .spmb-schedule-panel__header h5 {
                font-size: 16px;
            }
        }

        /* Small Mobile (max-width: 375px) */
        @media (max-width: 375px) {
            .spmb-schedule-tab {
                bottom: 12px;
                right: 12px;
                min-width: 100px;
                height: 40px;
                padding: 6px 14px;
                border-radius: 20px;
                gap: 6px;
            }
            
            .spmb-schedule-tab.panel-open {
                right: 12px;
                bottom: 12px;
            }
            
            .spmb-schedule-tab .tab-icon {
                font-size: 15px;
            }
            
            .spmb-schedule-tab__label {
                font-size: 9px;
                letter-spacing: 0.08em;
            }
        }

        /* Landscape Mode untuk Mobile */
        @media (max-height: 500px) and (orientation: landscape) {
            .spmb-schedule-tab {
                bottom: 10px;
                right: 10px;
                min-width: 90px;
                height: 36px;
                padding: 5px 12px;
                border-radius: 18px;
                gap: 5px;
            }
            
            .spmb-schedule-tab.panel-open {
                right: 10px;
                bottom: 10px;
            }
            
            .spmb-schedule-tab .tab-icon {
                font-size: 14px;
            }
            
            .spmb-schedule-tab__label {
                font-size: 9px;
                letter-spacing: 0.06em;
            }
            
            .spmb-schedule-panel__header {
                padding: 0.75rem;
            }
            
            .spmb-schedule-panel__body {
                padding: 0.5rem 0.75rem;
            }
        }

        /* Add this class to your span */
        .pulse-animation {
            animation: pulse-red 2s infinite;
        }

        @keyframes pulse-red {
            0% { transform: scale(0.99); box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
            100% { transform: scale(0.99); box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
        }

        .cursor-pointer {
            cursor: pointer;
        }
        .cursor-pointer:hover {
            background: #f8fbff;
            border-radius: 8px;
            padding-left: 8px;
            padding-right: 8px;
        }
        .doc-item[style*="cursor: not-allowed"]:hover {
            background: transparent;
        }

        /* ───── SIDEBAR CARD RIGHT ───── */
        .sidebar-card {
            background: #ffffff;
            border-radius: 14px;
            border: 1px solid #dce6f0;
            padding: 18px 16px;
            margin-bottom: 16px;
            box-shadow: 0 2px 8px rgba(14, 36, 68, 0.06);
            transition: all 0.25s ease;
        }
        .sidebar-card:hover {
            border-color: #1e72cc;
            box-shadow: 0 4px 16px rgba(30, 114, 204, 0.12);
        }
        .sidebar-card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }
        .sidebar-card-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 18px;
        }
        .sidebar-card-icon.primary { background: #dbeafe; color: #1e72cc; }
        .sidebar-card-icon.success { background: #d1fae5; color: #10b981; }
        .sidebar-card-icon.warning { background: #fef3c7; color: #f59e0b; }
        .sidebar-card-title {
            font-size: 13px;
            font-weight: 700;
            color: #0d1f35;
            margin-bottom: 8px;
        }
        .sidebar-card-value {
            font-size: 18px;
            font-weight: 800;
            color: #1e72cc;
        }
        .sidebar-card-desc {
            font-size: 12px;
            color: #7a93ae;
            line-height: 1.4;
        }
        .sidebar-card-divider {
            height: 1px;
            background: #dce6f0;
            margin: 12px 0;
        }
        .sidebar-badge {
            display: inline-block;
            background: #dbeafe;
            color: #1e72cc;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
    </style>
@endpush

@section('content')

    <div class="row g-5">
        <div class="col-12 col-xl-3 d-flex flex-column gap-5 order-1 order-xl-1">
            <div>
                <div class="spmb-profile-hero">
                    <div class="d-flex gap-3 align-items-start position-relative" style="z-index:1">
                        <div class="spmb-avatar-ring">
                            <img src="{{ $siswa->foto == '' ? asset('images/student_sd.png') : Storage::url('' . $siswa->foto) }}" alt="" class="img-fluid">
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                <p class="fs-5 fw-bolder mb-0 text-white">{{ $siswa->nama }}</p>
                                <span class="badge bg-white fw-bolder text-dark">
                                <i class="{{ $siswa->jenis_kelamin == 'L' ? 'fas fa-mars text-primary' : 'fas fa-venus text-danger' }}" 
                                title="{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}">
                                </i>
                                </span>
                            </div>
                            <p class="mb-0" style="font-size:13px; color:rgba(255,255,255,0.72);">
                                NISN: {{ $siswa->nisn }}
                            </p>
                            <p class="mb-0" style="font-size:13px; color:rgba(255,255,255,0.72);">
                                NIK: {{ $siswa->nik }}
                            </p>
                        </div>
                        
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3 position-relative" style="z-index:1">
                        <span class="fw-semibold text-white-50 small">Informasi Lengkap</span>
                        <button class="spmb-hero-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#spmb-hero-details" aria-expanded="false" aria-controls="spmb-hero-details">
                            <i class="bi bi-chevron-up"></i>
                            <span>Detail</span>
                        </button>
                        
                    </div>
                    

                    <div class="spmb-hero-divider"></div>
                    <div class="spmb-hero-actions mt-3">
                            <a href="{{ route('siswa.edit_profil') }}" class="btn btn-sm btn-success text-dark fw-semibold py-2">
                                <i class="bi bi-pencil-square"></i> Edit Informasi Siswa
                            </a>
                            <a href="{{ route('siswa.cetak_sptjm') }}" target="_blank" class="btn btn-sm btn-outline-light text-white py-2 mt-2">
                                <i class="bi bi-download"></i> Download SPTJM
                            </a>
                        </div>

                    <div class="collapse" id="spmb-hero-details">
                        <div class="row g-2 mt-1 position-relative" style="z-index:1">
                            <div class="spmb-hero-address mt-3">
                                <div class="fw-semibold mb-1">Alamat Lengkap</div>
                                <div class="small text-white-50">{{ $siswa->alamat ?? '-' }}</div>
                                <div class="small text-white-50">{{ $siswa->lokasi_lengkap }}</div>
                            </div>
                            <div class="col-6">
                                <div class="spmb-info-tile">
                                    <div class="tile-lbl">Tanggal Lahir</div>
                                    <div class="tile-val">{{ fulldate($siswa->tanggal_lahir) }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="spmb-info-tile">
                                    <div class="tile-lbl">Asal Sekolah</div>
                                    <div class="tile-val tile-val-score">{{ $siswa->asal_sekolah->nama ?? '' }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="spmb-info-tile">
                                    <div class="tile-lbl">No. Telp</div>
                                    <div class="tile-val">{{ $siswa->notelp ?? '-' }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="spmb-info-tile">
                                    <div class="tile-lbl">Tingkat</div>
                                    <div class="tile-val tile-val-score">{{ tingkat()[$siswa->tingkat] ?? '' }}</div>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-6">
                        <div class="fs-6 fw-semibold mb-3">Upload Dokumen Persyaratan</div>

                        @foreach($list_jenis_dokumen as $jenis_dokumen)
                            @php
                                // Validasi beneran udah ada file-nya atau belum
                                $is_uploaded = isset($jenis_dokumen->list_dokumen[0]->details[0]->file) && $jenis_dokumen->list_dokumen[0]->details[0]->file !== '';

                                // Cek status lock dari seleksi_aktif
                                $is_locked_dashboard = !empty($seleksi_aktif);

                                // Aturan gembok: Kalau statusnya lock DAN file-nya belum diupload
                                $is_restricted = $is_locked_dashboard && !$is_uploaded;
                            @endphp

                            <div class="doc-item {{ $is_restricted ? '' : 'cursor-pointer' }}"
                                style="transition: all 0.2s; {{ $is_restricted ? 'cursor: not-allowed;' : '' }}"
                                @if(!$is_restricted) onclick="info_document({{ $jenis_dokumen->id }})" @endif>

                                @if($is_restricted)
                                    <div class="doc-check bg-secondary text-white"><i class="bi bi-lock-fill"></i></div>
                                @elseif(!$is_uploaded)
                                    <div class="doc-check bg-light text-muted"><i class="bi bi-dash"></i></div>
                                @else
                                    @if(($jenis_dokumen->list_dokumen[0]->flag ?? 0) == 0)
                                        <div class="doc-check bg-primary bg-opacity-10 text-primary"><i class="bi bi-info-circle"></i></div>
                                    @elseif(($jenis_dokumen->list_dokumen[0]->flag ?? 0) == 1)
                                        <div class="doc-check dc-done"><i class="bi bi-check2"></i></div>
                                    @elseif(($jenis_dokumen->list_dokumen[0]->flag ?? 0) == -1)
                                        <div class="doc-check dc-no"><i class="bi bi-x"></i></div>
                                    @endif
                                @endif

                                <span class="doc-name">{{ $jenis_dokumen->nama }}</span>

                                    <i class="bi bi-info-circle text-primary ms-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="{{ $jenis_dokumen->keterangan ?? 'Tidak ada keterangan.' }}"
                                    onclick="event.stopPropagation();">
                                    </i>

                                @if(!$is_uploaded)
                                    @if($is_restricted)
                                        <span class="badge badge-secondary fw-bold fs-8">Kosong</span>
                                    @else
                                        <span class="badge badge-secondary fw-bold fs-8">Belum Upload</span>
                                    @endif
                                @else
                                    @if(($jenis_dokumen->list_dokumen[0]->flag ?? 0) == 0)
                                        <span class="badge badge-primary fw-bold fs-8">Menunggu Verifikasi</span>
                                    @elseif(($jenis_dokumen->list_dokumen[0]->flag ?? 0) == 1)
                                        <span class="badge badge-success fw-bold fs-8">Lengkap</span>
                                    @elseif(($jenis_dokumen->list_dokumen[0]->flag ?? 0) == -1)
                                        <span class="badge badge-danger fw-bold fs-8">Ditolak</span>
                                    @endif
                                @endif

                            </div>
                        @endforeach

                    </div>
                </div>

        </div>

        <div class="col-12 col-xl-9 d-flex flex-column gap-5 order-3 order-xl-2">
            <div>
                @if(!empty($seleksi_aktif))
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-primary d-flex align-items-start gap-4 p-6 mb-6 fade-up fade-up-1 h-100">
                                <div class="d-flex align-items-center justify-content-center w-50px h-50px rounded-circle bg-white flex-shrink-0">
                                    <i class="bi bi-hourglass-split fs-2 text-primary"></i>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="text-uppercase fw-bold fs-8 ls-2 text-primary mb-1">Status Pendaftaran</span>
                                    <span class="fw-bolder fs-3 text-primary mb-2">Menunggu Hasil Seleksi</span>
                                    <span class="fw-semibold text-primary-emphasis fs-6 lh-lg"> Kamu sudah memilih <strong>Jalur {{ $seleksi_aktif->jalur->nama }}</strong> dan pendaftaranmu sedang diproses oleh panitia. Silakan tunggu pengumuman hasil seleksi.</span>
                                </div>
                            </div>
                            <a href="{{ route('siswa.jalur.seleksi', $seleksi_aktif->jalur->nama) }}" class="btn btn-primary">Buka Jalur {{ $seleksi_aktif->jalur->nama }}</a>
                        </div>
                    </div>
                @else
                    <div class="fs-4 fw-bolder text-dark mb-3">
                        Jalur Pendaftaran<br>
                        <div class="fw-semibold fs-6 bg-danger text-light px-3 rounded-2 py-2 pulse-animation mt-2 mb-4">
                            Murid wajib mengunggah seluruh dokumen persyaratan sesuai dengan ketentuan jalur pendaftaran yang dipilih.
                        </div>
                    </div>

                    @foreach($list_jalur as $jalur)
                        <a href="{{ route('siswa.jalur', $jalur->nama) }}" class="jalur-card">
                            <div class="jalur-icon j-zonasi p-3">
                                <img src="{{ Storage::url('' . $jalur->icon) }}" alt="" class="img-fluid">
                            </div>
                            <div class="flex-fill">
                                <p class="jalur-title">Jalur {{ $jalur->nama}}</p>
                                <p class="jalur-desc">{{ $jalur->keterangan }}</p>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($jalur->list_dokumen as $jenis_dokumen)
                                        <span class="jtag jtag-blue">{{ $jenis_dokumen->nama }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="jalur-arrow">
                                <i class="bi bi-chevron-right text-muted" style="font-size:14px;"></i>
                            </div>
                        </a>
                    @endforeach

                @endif
            </div>
        </div>
    </div>
@endsection

@push('floating-panels')
    <div class="spmb-schedule-tab" id="spmb_schedule_toggle" role="button" tabindex="0" aria-controls="spmb_schedule_panel" aria-expanded="false">
        <i class="bi bi-calendar-event-fill tab-icon"></i>
        <span class="spmb-schedule-tab__label">JADWAL</span>
    </div>

    <div class="spmb-schedule-backdrop" id="spmb_schedule_backdrop"></div>

    <aside class="spmb-schedule-panel" id="spmb_schedule_panel" aria-hidden="true">
        <div class="spmb-schedule-panel__header">
            <div>
                <h5 class="mb-1 fw-bolder text-dark">Jadwal SPMB Online</h5>
                <p class="mb-0 text-muted fs-8">Tetap mengikuti layar saat kamu scroll.</p>
            </div>
            <button type="button" class="spmb-schedule-panel__close" id="spmb_schedule_close" aria-label="Tutup panel">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <div class="spmb-schedule-panel__body">
            <section class="spmb-panel-section">

                @foreach($list_jalur as $jalur)
                    <div class="fs-6 fw-bolder mb-3">Jadwal Jalur {{ $jalur->nama }}</div>
                    @php($now = now())
                    @foreach($jalur->list_tahapan as $tahapan)
                        <div class="tl-item">
                            @if($now >= date('Y-m-d H:i:s', strtotime($tahapan->tanggal_awal . ' ' . $tahapan->waktu_awal)) && $now <= date('Y-m-d H:i:s', strtotime($tahapan->tanggal_akhir . ' ' . $tahapan->waktu_akhir)))
                                <div class="tl-dot tl-active">●</div>
                            @endif
                            @if($now < date('Y-m-d H:i:s', strtotime($tahapan->tanggal_awal . ' ' . $tahapan->waktu_awal)))
                                    <div class="tl-dot tl-next"><i class="bi bi-calendar"></i></div>
                            @endif
                            @if($now > date('Y-m-d H:i:s', strtotime($tahapan->tanggal_akhir . ' ' . $tahapan->waktu_akhir)))
                                <div class="tl-dot tl-done"><i class="bi bi-check2"></i></div>
                            @endif
                            <div>
                                <p class="fs-6 fw-bolder mb-0">{{ $tahapan->nama }}</p>
                                <p class="fs-8">
                                    Mulai : {{ fulldate($tahapan->tanggal_awal) }}, {{ format_time($tahapan->waktu_awal) }} <br>
                                    Sampai : {{ fulldate($tahapan->tanggal_akhir) }}, {{ format_time($tahapan->waktu_akhir) }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                    <hr>
                @endforeach
            </section>
        </div>
    </aside>
@endpush

@push('modals')
    <div class="modal fade" tabindex="-1" id="modal_info">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" id="modal_info_content">
            </div>
        </div>
    </div>
@endpush

@push('styles')
    <link href="{{ asset('assets_admin/plugins/custom/openlayer/ol.css') }}"  rel="stylesheet" type="text/css">
@endpush

@push('scripts')
    <script src="{{ asset('assets_admin/plugins/custom/openlayer/ol.js') }}"></script>
    <script>
        // 1. Deklarasi variabel global
        let $modal_info, $modal_info_content;
        let $schedulePanel, $scheduleBackdrop, $scheduleToggle, $scheduleClose;
        let base_url = '{{ url('siswa/dokumen') }}', params_url = '{{ $params ?? '' }}';

        $(document).ready(function() {
            // 2. Inisialisasi selector DOM
            $modal_info = $('#modal_info');
            $modal_info_content = $('#modal_info_content');
            $schedulePanel = $('#spmb_schedule_panel');
            $scheduleBackdrop = $('#spmb_schedule_backdrop');
            $scheduleToggle = $('#spmb_schedule_toggle');
            $scheduleClose = $('#spmb_schedule_close');

            // 3. Logika Buka Panel Schedule
            const open_schedule_panel = () => {
                $schedulePanel.addClass('open').attr('aria-hidden', 'false');
                $scheduleBackdrop.addClass('show');
                $scheduleToggle.addClass('panel-open'); // Tab ikut bergeser
                $('body').addClass('spmb-panel-open');
                $scheduleToggle.attr('aria-expanded', 'true');
            };

            // 4. Logika Tutup Panel Schedule
            const close_schedule_panel = () => {
                $schedulePanel.removeClass('open').attr('aria-hidden', 'true');
                $scheduleBackdrop.removeClass('show');
                $scheduleToggle.removeClass('panel-open'); // Tab kembali ke posisi semula
                $('body').removeClass('spmb-panel-open');
                $scheduleToggle.attr('aria-expanded', 'false');
            };

            // 5. Toggle Panel Schedule (Buka/Tutup)
            const toggle_schedule_panel = () => {
                if ($schedulePanel.hasClass('open')) {
                    close_schedule_panel();
                } else {
                    open_schedule_panel();
                }
            };

            // 6. Event Listener Panel Schedule
            $scheduleToggle.on('click', function(e) {
                e.preventDefault();
                toggle_schedule_panel();
            });
            
            $scheduleToggle.on('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    toggle_schedule_panel();
                }
            });
            
            // Tombol close (X)
            $scheduleClose.on('click', function(e) {
                e.preventDefault();
                close_schedule_panel();
            });
            
            // Klik backdrop
            $scheduleBackdrop.on('click', function(e) {
                e.preventDefault();
                close_schedule_panel();
            });
            
            // Tombol Escape
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape' && $schedulePanel.hasClass('open')) {
                    e.preventDefault();
                    close_schedule_panel();
                }
            });

            // Mencegah klik di dalam panel menutup panel
            $schedulePanel.on('click', function(e) {
                e.stopPropagation();
            });

            // Jalankan inisialisasi awal modal
            init();
        });

        // 7. Fungsi Utama
        function init() {
            if ($modal_info_content) {
                $modal_info_content.html('');
            }
            if ($modal_info) {
                try { $modal_info.modal('hide'); } catch (e) { }
            }
        }

        function display_modal(html) {
            if ($modal_info_content && $modal_info) {
                $modal_info_content.html(html);
                $modal_info.modal('show');
            }
        }

        function info_document(jenis_dokumen_id) {
            $.get(base_url + '/' + jenis_dokumen_id, (result) => display_modal(result))
            .fail((xhr) => display_modal(xhr.responseText));
        }

        // 8. Event Delegation untuk Form Dinamis
        $(document).on('submit', '#form_info', function(e) {
            e.preventDefault();

            let $form_info = $(this);
            let $btnSubmit = $form_info.find('button[type="submit"]');
            
            // Fallback jika tidak ada button[type="submit"]
            if (!$btnSubmit.length) {
                $btnSubmit = $form_info.find('button').last();
            }
            
            if (!$btnSubmit.length) {
                console.error('Tombol submit tidak ditemukan');
                return false;
            }
            
            let originalText = $btnSubmit.text();

            // Disable tombol dan tampilkan loading
            $btnSubmit.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Mengunggah...');

            let url = base_url;
            let data = new FormData(this); 

            // Blokir Flatpickr sebelum submit
            let $datepickers = $('.datepicker');
            $datepickers.each(function() {
                try { if (this._flatpickr) this._flatpickr.close(); } catch(err) {}
            });
            $datepickers.prop('disabled', true);

            Swal.fire({
                title: 'Mohon Tunggu',
                html: 'Sedang mengunggah dokumen...<br><br><small>Proses bergantung pada besar file dan jaringan internet</small>',
                allowOutsideClick: false,
                showConfirmButton: false,
                returnFocus: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url,
                type: 'post',
                data,
                cache: false,
                processData: false,
                contentType: false,
                success: () => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Dokumen berhasil disimpan.',
                        confirmButtonText: 'OK',
                        returnFocus: false
                    }).then(() => window.location.reload());
                }
            }).fail((xhr) => {
                Swal.close();
                $btnSubmit.prop('disabled', false).text(originalText);
                $datepickers.prop('disabled', false);

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';

                    for (let field in errors) {
                        errorMessage += errors[field][0] + '<br>';
                    }

                    Swal.fire({
                        icon: 'warning',
                        title: 'Gagal Disimpan!',
                        html: errorMessage,
                        confirmButtonColor: '#d33',
                        returnFocus: false
                    });
                }
                else if (xhr.responseText.substring(0, 8) === '<script>') {
                    if ($modal_info_content) {
                        $modal_info_content.html(xhr.responseText);
                    }
                }
                else {
                    if (typeof error_handle === 'function') {
                        error_handle(xhr.responseText);
                    } else {
                        Swal.fire({
                            title: 'Oops!',
                            text: 'Terjadi kesalahan sistem atau file terlalu besar.',
                            icon: 'error',
                            returnFocus: false
                        });
                    }
                }
            });
        });
    </script>
@endpush
