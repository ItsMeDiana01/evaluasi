<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suara Pramuka — Papan Evaluasi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <style>
        :root {
            --forest: #1a2e1a;
            --forest-mid: #243824;
            --forest-light: #2f4f2f;
            --amber: #d4820a;
            --amber-glow: #f0a020;
            --amber-pale: #fde68a;
            --cream: #faf6ee;
            --glass-bg: rgba(255,255,255,0.05);
            --glass-border: rgba(255,255,255,0.1);
            --text-primary: #f0ede8;
            --text-muted: rgba(240,237,232,0.55);
            --note-yellow: #fef08a;
            --note-green: #bbf7d0;
            --note-red: #fecdd3;
            --shadow-deep: 0 20px 60px rgba(0,0,0,0.5);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: var(--forest);
            color: var(--text-primary);
            font-family: 'Space Grotesk', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── BACKGROUND TEXTURE ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 20% 10%, rgba(47,79,47,0.4) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 80% 80%, rgba(212,130,10,0.12) 0%, transparent 50%),
                radial-gradient(ellipse 50% 70% at 70% 20%, rgba(26,46,26,0.8) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
        }

        /* ── HEADER ── */
        header {
            position: relative;
            z-index: 10;
            padding: 1.25rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(26,46,26,0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--glass-border);
        }

        .header-brand {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--amber), var(--amber-glow));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            box-shadow: 0 4px 16px rgba(212,130,10,0.4);
            flex-shrink: 0;
        }

        .brand-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            color: var(--amber-pale);
            letter-spacing: 0.01em;
        }

        .brand-text p {
            font-size: 0.72rem;
            color: var(--text-muted);
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .stats-pill {
            display: flex;
            gap: 1rem;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 999px;
            padding: 0.4rem 1rem;
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .stats-pill span strong {
            color: var(--amber-pale);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--amber), var(--amber-glow));
            color: #1a1a00;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 0.85rem;
            border: none;
            border-radius: 999px;
            padding: 0.6rem 1.4rem;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(212,130,10,0.35);
            transition: all 0.2s;
            white-space: nowrap;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(212,130,10,0.5);
        }

        /* ── FILTER BAR ── */
        .filter-bar {
            position: relative;
            z-index: 5;
            display: flex;
            gap: 0.75rem;
            padding: 1rem 2rem;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            align-items: center;
        }

        .filter-bar::-webkit-scrollbar { display: none; }

        .filter-label {
            font-size: 0.72rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            white-space: nowrap;
            margin-right: 0.25rem;
        }

        .filter-chip {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            color: var(--text-muted);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.78rem;
            font-weight: 500;
            border-radius: 999px;
            padding: 0.4rem 1rem;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .filter-chip:hover,
        .filter-chip.active {
            background: rgba(212,130,10,0.18);
            border-color: var(--amber);
            color: var(--amber-pale);
        }

        .filter-chip.active {
            box-shadow: 0 0 12px rgba(212,130,10,0.2);
        }

        /* ── BOARD ── */
        main {
            position: relative;
            z-index: 5;
            padding: 0.5rem 2rem 3rem;
        }

        #board {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1.25rem;
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 5rem 2rem;
            color: var(--text-muted);
        }

        .empty-state .empty-icon { font-size: 3rem; margin-bottom: 1rem; }
        .empty-state p { font-size: 1rem; }

        /* ── STICKY NOTE ── */
        .sticky-note {
            border-radius: 4px;
            padding: 1.25rem 1.25rem 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 200px;
            position: relative;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 4px 4px 12px rgba(0,0,0,0.25), 0 1px 0 rgba(255,255,255,0.2) inset;
            cursor: default;
        }

        .sticky-note::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 32px;
            background: rgba(0,0,0,0.08);
            border-radius: 4px 4px 0 0;
        }

        .sticky-note:hover {
            transform: rotate(0deg) translateY(-6px) scale(1.02) !important;
            box-shadow: 8px 20px 40px rgba(0,0,0,0.35), 0 1px 0 rgba(255,255,255,0.2) inset;
            z-index: 20;
        }

        .note-badge {
            position: absolute;
            top: 8px;
            right: 12px;
            font-size: 0.62rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 2px 8px;
            border-radius: 999px;
            background: rgba(0,0,0,0.12);
            color: rgba(0,0,0,0.6);
        }

        .note-body {
            padding-top: 1.5rem;
            font-size: 0.875rem;
            line-height: 1.6;
            color: #2c2c1e;
            font-weight: 500;
            flex-grow: 1;
            overflow-y: auto;
            word-break: break-word;
            max-height: 140px;
            scrollbar-width: thin;
            scrollbar-color: rgba(0,0,0,0.2) transparent;
        }

        .note-footer {
            margin-top: 0.75rem;
            border-top: 1px solid rgba(0,0,0,0.1);
            padding-top: 0.6rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .note-meta {
            font-size: 0.68rem;
            color: rgba(0,0,0,0.4);
        }

        .note-actions {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .vote-btn {
            display: flex;
            align-items: center;
            gap: 3px;
            font-size: 0.72rem;
            font-weight: 600;
            color: rgba(0,0,0,0.45);
            background: rgba(0,0,0,0.08);
            border: none;
            border-radius: 999px;
            padding: 3px 8px;
            cursor: pointer;
            transition: all 0.15s;
            font-family: 'Space Grotesk', sans-serif;
        }

        .vote-btn:hover { background: rgba(0,0,0,0.15); }

        .vote-btn.liked {
            background: rgba(34,197,94,0.2);
            color: #166534;
        }

        .vote-btn.disliked {
            background: rgba(239,68,68,0.2);
            color: #991b1b;
        }

        .vote-btn.liked:hover { background: rgba(34,197,94,0.3); }
        .vote-btn.disliked:hover { background: rgba(239,68,68,0.3); }

        /* ── MODAL BACKDROP ── */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(6px);
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s;
        }

        .modal-backdrop.open {
            opacity: 1;
            pointer-events: all;
        }

        /* ── WELCOME MODAL ── */
        .welcome-modal {
            background: linear-gradient(160deg, var(--forest-mid) 0%, var(--forest) 100%);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 480px;
            box-shadow: var(--shadow-deep);
            transform: translateY(16px);
            transition: transform 0.3s;
        }

        .modal-backdrop.open .welcome-modal,
        .modal-backdrop.open .form-modal {
            transform: translateY(0);
        }

        .welcome-modal .wm-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--amber), var(--amber-glow));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin-bottom: 1.25rem;
            box-shadow: 0 8px 24px rgba(212,130,10,0.4);
        }

        .welcome-modal h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            color: var(--amber-pale);
            margin-bottom: 0.5rem;
        }

        .welcome-modal .tagline {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 1.75rem;
            line-height: 1.5;
        }

        .rules-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-bottom: 2rem;
        }

        .rules-list li {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            font-size: 0.85rem;
            line-height: 1.5;
            color: var(--text-primary);
        }

        .rules-list li .rule-icon {
            flex-shrink: 0;
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        .rule-icon.green { background: rgba(187,247,208,0.15); }
        .rule-icon.amber { background: rgba(253,230,138,0.15); }
        .rule-icon.red   { background: rgba(254,205,211,0.15); }
        .rule-icon.blue  { background: rgba(147,197,253,0.15); }

        .welcome-modal .btn-start {
            width: 100%;
            background: linear-gradient(135deg, var(--amber), var(--amber-glow));
            border: none;
            border-radius: 12px;
            padding: 0.9rem;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            color: #1a1a00;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 6px 20px rgba(212,130,10,0.4);
        }

        .welcome-modal .btn-start:hover {
            box-shadow: 0 10px 30px rgba(212,130,10,0.55);
            transform: translateY(-1px);
        }

        /* ── FORM MODAL ── */
        .form-modal {
            background: linear-gradient(160deg, #1e2e1e 0%, var(--forest) 100%);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            width: 100%;
            max-width: 440px;
            box-shadow: var(--shadow-deep);
            transform: translateY(16px);
            transition: transform 0.3s;
        }

        .form-modal h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            color: var(--amber-pale);
            margin-bottom: 1.5rem;
        }

        .form-group { margin-bottom: 1.25rem; }

        .form-group label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.5rem;
        }

        .cat-option {
            position: relative;
        }

        .cat-option input[type=radio] {
            position: absolute;
            opacity: 0;
            width: 0;
        }

        .cat-option label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.3rem;
            padding: 0.75rem 0.5rem;
            border-radius: 12px;
            border: 1.5px solid var(--glass-border);
            background: var(--glass-bg);
            cursor: pointer;
            text-transform: none;
            letter-spacing: 0;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--text-muted);
            transition: all 0.15s;
        }

        .cat-option label .cat-icon { font-size: 1.2rem; }

        .cat-option input:checked + label {
            color: var(--text-primary);
            border-color: var(--amber);
            background: rgba(212,130,10,0.12);
        }

        .cat-option label:hover {
            border-color: rgba(212,130,10,0.4);
            color: var(--text-primary);
        }

        textarea#pesan {
            width: 100%;
            background: rgba(255,255,255,0.05);
            border: 1.5px solid var(--glass-border);
            border-radius: 12px;
            padding: 0.875rem;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.875rem;
            color: var(--text-primary);
            resize: none;
            outline: none;
            transition: border-color 0.2s;
            line-height: 1.6;
        }

        textarea#pesan::placeholder { color: var(--text-muted); }

        textarea#pesan:focus {
            border-color: var(--amber);
            box-shadow: 0 0 0 3px rgba(212,130,10,0.15);
        }

        .char-count {
            text-align: right;
            font-size: 0.7rem;
            color: var(--text-muted);
            margin-top: 0.3rem;
        }

        .char-count.warn { color: #f97316; }

        .form-actions {
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
            margin-top: 1.5rem;
        }

        .btn-cancel {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            color: var(--text-muted);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.85rem;
            font-weight: 500;
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            cursor: pointer;
            transition: all 0.15s;
        }

        .btn-cancel:hover {
            background: rgba(255,255,255,0.1);
            color: var(--text-primary);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--amber), var(--amber-glow));
            border: none;
            color: #1a1a00;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.85rem;
            font-weight: 700;
            border-radius: 10px;
            padding: 0.6rem 1.5rem;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 14px rgba(212,130,10,0.35);
        }

        .btn-submit:hover {
            box-shadow: 0 6px 20px rgba(212,130,10,0.5);
            transform: translateY(-1px);
        }

        .btn-submit:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        /* ── TOAST ── */
        .toast-container {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 200;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .toast {
            background: var(--forest-mid);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 0.75rem 1.2rem;
            font-size: 0.85rem;
            color: var(--text-primary);
            box-shadow: 0 8px 30px rgba(0,0,0,0.4);
            display: flex;
            align-items: center;
            gap: 0.6rem;
            transform: translateX(120%);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
        }

        .toast.show {
            transform: translateX(0);
            opacity: 1;
        }

        .toast.success { border-left: 3px solid #4ade80; }
        .toast.error { border-left: 3px solid #f87171; }
        .toast.info { border-left: 3px solid var(--amber); }

        /* ── SEARCH BAR ── */
        .search-wrap {
            position: relative;
            flex: 1;
            max-width: 260px;
        }

        .search-wrap input {
            width: 100%;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 999px;
            padding: 0.4rem 1rem 0.4rem 2.2rem;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.78rem;
            color: var(--text-primary);
            outline: none;
            transition: border-color 0.2s;
        }

        .search-wrap input::placeholder { color: var(--text-muted); }
        .search-wrap input:focus { border-color: var(--amber); }

        .search-wrap svg {
            position: absolute;
            left: 0.7rem;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.4;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 640px) {
            header { padding: 1rem; flex-wrap: wrap; gap: 0.75rem; }
            .stats-pill { display: none; }
            main { padding: 0.5rem 1rem 3rem; }
            .filter-bar { padding: 0.75rem 1rem; }
            .welcome-modal, .form-modal { padding: 1.5rem; }
        }

        /* ── ANIMATIONS ── */
        @keyframes noteIn {
            from { opacity: 0; transform: rotate(var(--rot)) scale(0.85) translateY(10px); }
            to   { opacity: 1; transform: rotate(var(--rot)) scale(1) translateY(0); }
        }

        .sticky-note {
            animation: noteIn 0.35s cubic-bezier(0.34,1.56,0.64,1) both;
        }

        .sort-select {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            color: var(--text-muted);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.78rem;
            border-radius: 999px;
            padding: 0.4rem 0.9rem;
            cursor: pointer;
            outline: none;
        }

        .sort-select option {
            background: #1a2e1a;
            color: #f0ede8;
        }
    </style>
</head>
<body>

    <!-- WELCOME MODAL -->
    <div class="modal-backdrop" id="welcome-backdrop">
        <div class="welcome-modal">
            <div class="wm-icon">🌿</div>
            <h2>Evaluasi Kepengurusan</h2>
            <p class="tagline">Evaluasi Kepengurusan yang di khususkan <b>INTI PENGURUS</b> UKM Pramuka tahun 2026/2027</p>

<ul class="rules-list">
    <li>
        <div class="rule-icon green">🎭</div>
        <span><strong>100% anonim.</strong> Tidak ada nama, tidak ada identitas. Tulis apa yang benar-benar ingin disampaikan.</span>
    </li>
    <li>
        <div class="rule-icon amber">⚡</div>
        <span><strong>Kritik sejujur mungkin.</strong> Jika ada pengurus, divisi, atau individu yang menurutmu bermasalah, tuliskan secara langsung dan spesifik.</span>
    </li>
    <li>
        <div class="rule-icon red">🎯</div>
        <span><strong>Fokus pada masalah.</strong> Serang kinerja, keputusan, sikap, atau tanggung jawabnya. Jangan menyerang hal pribadi yang tidak berkaitan dengan organisasi.</span>
    </li>
    <li>
        <div class="rule-icon blue">📢</div>
        <span><strong>Jangan ditahan.</strong> Semua masukan, keluhan, kekecewaan, maupun apresiasi berhak disampaikan agar kepengurusan bisa dievaluasi secara menyeluruh.</span>
    </li>
</ul>

            <button class="btn-start" onclick="tutupWelcome()">Saya Mengerti — Masuk ke Papan</button>
        </div>
    </div>

    <!-- FORM MODAL -->
    <div class="modal-backdrop" id="form-backdrop">
        <div class="form-modal">
            <h3>✍️ Tulis Evaluasi</h3>

            <form id="evaluasi-form" autocomplete="off">
                <div class="form-group">
                    <label>Jenis Masukan</label>
                    <div class="category-grid">
                        <div class="cat-option">
                            <input type="radio" id="cat-kuning" name="kategori" value="kuning" checked>
                            <label for="cat-kuning"><span class="cat-icon">💡</span>Saran</label>
                        </div>
                        <div class="cat-option">
                            <input type="radio" id="cat-hijau" name="kategori" value="hijau">
                            <label for="cat-hijau"><span class="cat-icon">🌟</span>Apresiasi</label>
                        </div>
                        <div class="cat-option">
                            <input type="radio" id="cat-merah" name="kategori" value="merah">
                            <label for="cat-merah"><span class="cat-icon">🔥</span>Kritik</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="pesan">Isi Evaluasi</label>
                    <textarea id="pesan" rows="5" maxlength="300" required placeholder="Tuliskan pendapatmu di sini...&#10;Jadilah jujur, konstruktif, dan berbasis fakta."></textarea>
                    <p class="char-count" id="char-count">0 / 300</p>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="tutupModal()">Batal</button>
                    <button type="submit" class="btn-submit" id="btn-kirim">Kirim Anonim 🚀</button>
                </div>
            </form>
        </div>
    </div>

    <!-- HEADER -->
    <header>
        <div class="header-brand">
            <div class="brand-icon">👨🏻‍💻</div>
            <div class="brand-text">
                <h1>Papan Evaluasi Kepengurusan</h1>
                <p>Yang perlu Web Kayak Gini Bisa Hubungi Yoga</p>

            </div>
        </div>
        <div class="header-actions">
            <div class="stats-pill">
                <span><strong id="stat-total">—</strong> masukan</span>
                <span><strong id="stat-today">—</strong> hari ini</span>
            </div>
            <button class="btn-primary" onclick="bukaModal()">+ Tulis Evaluasi</button>
        </div>
    </header>

    <!-- FILTER & SEARCH BAR -->
    <div class="filter-bar">
        <span class="filter-label">Filter:</span>
        <button class="filter-chip active" data-filter="semua">Semua</button>
        <button class="filter-chip" data-filter="kuning">💡 Saran</button>
        <button class="filter-chip" data-filter="hijau">🌟 Apresiasi</button>
        <button class="filter-chip" data-filter="merah">🔥 Kritik</button>
        <div style="margin-left:auto;display:flex;gap:.5rem;align-items:center;">
            <div class="search-wrap">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                <input type="text" id="search-input" placeholder="Cari evaluasi...">
            </div>
            <select class="sort-select" id="sort-select">
                <option value="terbaru">Terbaru</option>
                <option value="terlama">Terlama</option>
                <option value="terlike">Paling Disukai</option>
            </select>
        </div>
    </div>

    <!-- BOARD -->
    <main>
        <div id="board">
            <div class="empty-state">
                <div class="empty-icon">🌱</div>
                <p>Memuat papan evaluasi...</p>
            </div>
        </div>
    </main>

    <!-- TOAST CONTAINER -->
    <div class="toast-container" id="toast-container"></div>

    <!-- FIREBASE + LOGIC -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
        import {
            getFirestore, collection, addDoc, onSnapshot,
            query, orderBy, doc, updateDoc, getDoc, increment
        } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-firestore.js";

        const firebaseConfig = {
            apiKey: "AIzaSyA14Da-oj718B6txyBufsItDT2dhIFAdPM",
            authDomain: "evaluasi-7d7ae.firebaseapp.com",
            databaseURL: "https://evaluasi-7d7ae-default-rtdb.asia-southeast1.firebasedatabase.app",
            projectId: "evaluasi-7d7ae",
            storageBucket: "evaluasi-7d7ae.firebasestorage.app",
            messagingSenderId: "380136969697",
            appId: "1:380136969697:web:e443ebc0ca5e67c39aaea0"
        };

        const app = initializeApp(firebaseConfig);
        const db = getFirestore(app);
        const col = collection(db, "evaluasi");

        // Local anonymous voter ID (random per session, stored in sessionStorage)
        let voterId = sessionStorage.getItem("voterId");
        if (!voterId) {
            voterId = 'v_' + Math.random().toString(36).substr(2, 12);
            sessionStorage.setItem("voterId", voterId);
        }

        // Vote history stored in localStorage (keyed by voterId)
        function getVoteHistory() {
            try { return JSON.parse(localStorage.getItem('votes_' + voterId) || '{}'); } catch { return {}; }
        }
        function saveVote(docId, val) {
            const h = getVoteHistory();
            h[docId] = val;
            localStorage.setItem('votes_' + voterId, JSON.stringify(h));
        }

        let allNotes = [];
        let currentFilter = 'semua';
        let currentSort = 'terbaru';
        let searchQuery = '';

        // ── REAL-TIME LISTENER ──
        const q = query(col, orderBy("dibuatPada", "desc"));
        onSnapshot(q, (snapshot) => {
            allNotes = snapshot.docs.map(d => ({ id: d.id, ...d.data() }));
            updateStats();
            renderBoard();
        });

        function updateStats() {
            const total = allNotes.length;
            const today = allNotes.filter(n => {
                const d = new Date(n.dibuatPada);
                const now = new Date();
                return d.toDateString() === now.toDateString();
            }).length;
            document.getElementById('stat-total').textContent = total;
            document.getElementById('stat-today').textContent = today;
        }

        function renderBoard() {
            const board = document.getElementById('board');
            const votes = getVoteHistory();

            let notes = [...allNotes];

            // Filter
            if (currentFilter !== 'semua') notes = notes.filter(n => n.kategori === currentFilter);

            // Search
            if (searchQuery.trim()) {
                const sq = searchQuery.toLowerCase();
                notes = notes.filter(n => n.pesan.toLowerCase().includes(sq));
            }

            // Sort
            if (currentSort === 'terbaru') notes.sort((a,b) => b.dibuatPada - a.dibuatPada);
            else if (currentSort === 'terlama') notes.sort((a,b) => a.dibuatPada - b.dibuatPada);
            else if (currentSort === 'terlike') notes.sort((a,b) => ((b.likes||0)-(b.dislikes||0)) - ((a.likes||0)-(a.dislikes||0)));

            if (notes.length === 0) {
                board.innerHTML = `<div class="empty-state"><div class="empty-icon">🌱</div><p>Belum ada evaluasi${currentFilter !== 'semua' ? ' untuk kategori ini' : ''}. Jadilah yang pertama!</p></div>`;
                return;
            }

            const colorMap = {
                kuning: { bg: '#fef08a', label: 'Saran', icon: '💡' },
                hijau:  { bg: '#bbf7d0', label: 'Apresiasi', icon: '🌟' },
                merah:  { bg: '#fecdd3', label: 'Kritik', icon: '🔥' },
            };

            board.innerHTML = '';
            notes.forEach((note, i) => {
                const cfg = colorMap[note.kategori] || colorMap.kuning;
                const rot = ((note.dibuatPada % 100) / 100 * 4 - 2).toFixed(1);
                const myVote = votes[note.id];
                const likeClass = myVote === 'like' ? 'liked' : '';
                const dislikeClass = myVote === 'dislike' ? 'disliked' : '';
                const likes = note.likes || 0;
                const dislikes = note.dislikes || 0;

                const el = document.createElement('div');
                el.className = 'sticky-note';
                el.style.cssText = `background:${cfg.bg};--rot:${rot}deg;transform:rotate(${rot}deg);animation-delay:${i*0.04}s`;
                el.innerHTML = `
                    <span class="note-badge">${cfg.icon} ${cfg.label}</span>
                    <p class="note-body">${escapeHtml(note.pesan)}</p>
                    <div class="note-footer">
                        <span class="note-meta">🕒 ${formatWaktu(note.dibuatPada)}</span>
                        <div class="note-actions">
                            <button class="vote-btn ${likeClass}" onclick="handleVote('${note.id}','like')" title="Setuju">
                                👍 <span id="like-${note.id}">${likes}</span>
                            </button>
                            <button class="vote-btn ${dislikeClass}" onclick="handleVote('${note.id}','dislike')" title="Tidak Setuju">
                                👎 <span id="dislike-${note.id}">${dislikes}</span>
                            </button>
                        </div>
                    </div>
                `;
                board.appendChild(el);
            });
        }

        // ── VOTE HANDLER ──
        window.handleVote = async (docId, type) => {
            const votes = getVoteHistory();
            const prev = votes[docId];

            if (prev === type) {
                showToast('Kamu sudah memilih ini.', 'info');
                return;
            }

            const ref = doc(db, 'evaluasi', docId);
            const updates = {};
            if (type === 'like') {
                updates.likes = increment(1);
                if (prev === 'dislike') updates.dislikes = increment(-1);
            } else {
                updates.dislikes = increment(1);
                if (prev === 'like') updates.likes = increment(-1);
            }

            try {
                await updateDoc(ref, updates);
                saveVote(docId, type);
                showToast(type === 'like' ? 'Kamu menyukai ini 👍' : 'Kamu menandai ini 👎', 'info');
            } catch (e) {
                showToast('Gagal merekam vote. Coba lagi.', 'error');
            }
        };

        // ── SUBMIT FORM ──
        document.getElementById('evaluasi-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = document.getElementById('btn-kirim');
            btn.disabled = true;
            btn.textContent = 'Mengirim...';

            const pesan = document.getElementById('pesan').value.trim();
            const kategori = document.querySelector('input[name="kategori"]:checked').value;

            if (!pesan) {
                showToast('Isi evaluasi tidak boleh kosong.', 'error');
                btn.disabled = false; btn.textContent = 'Kirim Anonim 🚀';
                return;
            }

            try {
                await addDoc(col, {
                    pesan,
                    kategori,
                    dibuatPada: Date.now(),
                    likes: 0,
                    dislikes: 0
                });
                document.getElementById('evaluasi-form').reset();
                document.getElementById('char-count').textContent = '0 / 300';
                tutupModal();
                showToast('Evaluasi berhasil dikirim secara anonim! 🎉', 'success');
            } catch {
                showToast('Gagal mengirim. Periksa koneksi internet Anda.', 'error');
            }

            btn.disabled = false;
            btn.textContent = 'Kirim Anonim 🚀';
        });

        // ── CHAR COUNTER ──
        document.getElementById('pesan').addEventListener('input', function() {
            const len = this.value.length;
            const cc = document.getElementById('char-count');
            cc.textContent = `${len} / 300`;
            cc.className = 'char-count' + (len >= 270 ? ' warn' : '');
        });

        // ── FILTERS ──
        document.querySelectorAll('.filter-chip').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.filter-chip').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                currentFilter = btn.dataset.filter;
                renderBoard();
            });
        });

        document.getElementById('search-input').addEventListener('input', function() {
            searchQuery = this.value;
            renderBoard();
        });

        document.getElementById('sort-select').addEventListener('change', function() {
            currentSort = this.value;
            renderBoard();
        });

        // ── HELPERS ──
        function escapeHtml(t) {
            return t.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#039;');
        }

        function formatWaktu(ts) {
            if (!ts) return '';
            return new Date(ts).toLocaleDateString('id-ID', { day:'numeric', month:'short', hour:'2-digit', minute:'2-digit' });
        }

        window.showToast = function(msg, type = 'info') {
            const c = document.getElementById('toast-container');
            const t = document.createElement('div');
            t.className = `toast ${type}`;
            const icons = { success: '✅', error: '❌', info: 'ℹ️' };
            t.innerHTML = `<span>${icons[type]}</span><span>${msg}</span>`;
            c.appendChild(t);
            requestAnimationFrame(() => { requestAnimationFrame(() => { t.classList.add('show'); }); });
            setTimeout(() => {
                t.classList.remove('show');
                setTimeout(() => t.remove(), 400);
            }, 3200);
        };
    </script>

    <script>
        // Modal controls
        window.bukaModal = function() {
            document.getElementById('form-backdrop').classList.add('open');
        };
        window.tutupModal = function() {
            document.getElementById('form-backdrop').classList.remove('open');
        };
        window.tutupWelcome = function() {
            document.getElementById('welcome-backdrop').classList.remove('open');
        };

        // Close on backdrop click
        document.getElementById('form-backdrop').addEventListener('click', function(e) {
            if (e.target === this) tutupModal();
        });
        document.getElementById('welcome-backdrop').addEventListener('click', function(e) {
            if (e.target === this) tutupWelcome();
        });

         // Show welcome popup every time page loads
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.getElementById('welcome-backdrop').classList.add('open');
            }, 300);
        });
    </script>
</body>
</html>