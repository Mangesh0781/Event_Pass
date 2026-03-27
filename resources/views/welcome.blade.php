<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EventPass | Discover Your Next Experience</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink:    #0d0d0d;
            --off:    #f5f3ee;
            --cream:  #faf9f6;
            --accent: #e8ff47;
            --blue:   #1a56e8;
            --muted:  #7a7670;
            --card-bg: #ffffff;
            --border: rgba(13,13,13,0.09);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--ink);
            overflow-x: hidden;
        }

        /* ── NOISE TEXTURE OVERLAY ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.035'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 999;
            opacity: .5;
        }

        /* ── NAV ── */
        nav {
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.1rem 2.5rem;
            background: rgba(250,249,246,0.82);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border-bottom: 1px solid var(--border);
        }

        .nav-logo {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.35rem;
            letter-spacing: -0.04em;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .nav-logo span {
            display: inline-block;
            background: var(--accent);
            color: var(--ink);
            border-radius: 6px;
            padding: 1px 7px;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            line-height: 1.6;
            vertical-align: middle;
        }

        .nav-actions { display: flex; align-items: center; gap: 0.75rem; }

        .btn-ghost {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--muted);
            padding: 0.5rem 1rem;
            border-radius: 100px;
            transition: color .2s, background .2s;
            text-decoration: none;
        }
        .btn-ghost:hover { color: var(--ink); background: var(--off); }

        .btn-primary {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--ink);
            background: var(--accent);
            padding: 0.55rem 1.4rem;
            border-radius: 100px;
            text-decoration: none;
            transition: transform .2s, box-shadow .2s;
            box-shadow: 0 2px 0 rgba(0,0,0,0.15);
        }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 4px 0 rgba(0,0,0,0.15); }

        /* ── HERO ── */
        .hero {
            position: relative;
            min-height: 88vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 5rem 1.5rem 4rem;
            overflow: hidden;
        }

        /* Decorative blobs */
        .hero::after {
            content: '';
            position: absolute;
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, rgba(232,255,71,0.22) 0%, transparent 70%);
            border-radius: 50%;
            top: -200px;
            right: -200px;
            pointer-events: none;
        }
        .blob-2 {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(26,86,232,0.08) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -100px;
            left: -100px;
            pointer-events: none;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--muted);
            background: var(--off);
            border: 1px solid var(--border);
            padding: 0.45rem 1rem;
            border-radius: 100px;
            margin-bottom: 2rem;
            animation: fadeUp 0.6s ease both;
        }
        .hero-eyebrow::before {
            content: '';
            width: 6px; height: 6px;
            background: var(--blue);
            border-radius: 50%;
            display: inline-block;
        }

        .hero-title {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: clamp(3rem, 8vw, 6.5rem);
            line-height: 1.0;
            letter-spacing: -0.04em;
            color: var(--ink);
            max-width: 900px;
            animation: fadeUp 0.7s 0.1s ease both;
        }

        .hero-title .highlight {
            position: relative;
            display: inline-block;
            color: var(--blue);
        }
        .hero-title .highlight::after {
            content: '';
            position: absolute;
            left: 0; bottom: 4px;
            width: 100%; height: 6px;
            background: var(--accent);
            border-radius: 3px;
            z-index: -1;
        }

        .hero-sub {
            font-size: 1.1rem;
            font-weight: 300;
            color: var(--muted);
            max-width: 520px;
            line-height: 1.7;
            margin: 1.8rem auto 2.8rem;
            animation: fadeUp 0.7s 0.2s ease both;
        }

        .hero-ctas {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeUp 0.7s 0.3s ease both;
        }

        .cta-main {
            font-family: 'Syne', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--ink);
            background: var(--accent);
            padding: 1rem 2.2rem;
            border-radius: 14px;
            text-decoration: none;
            box-shadow: 0 3px 0 rgba(0,0,0,0.2), 0 8px 24px rgba(232,255,71,0.3);
            transition: transform .2s, box-shadow .2s;
            letter-spacing: -0.02em;
        }
        .cta-main:hover { transform: translateY(-2px); box-shadow: 0 5px 0 rgba(0,0,0,0.2), 0 16px 32px rgba(232,255,71,0.35); }

        .cta-sec {
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--ink);
            background: var(--card-bg);
            padding: 1rem 2.2rem;
            border-radius: 14px;
            text-decoration: none;
            border: 1px solid var(--border);
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: transform .2s, box-shadow .2s;
            display: flex; align-items: center; gap: 0.5rem;
        }
        .cta-sec:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.08); }
        .cta-sec svg { width: 16px; height: 16px; }

        /* ── TRUST STRIP ── */
        .trust-strip {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
            padding: 1.5rem 2rem;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            background: var(--off);
            animation: fadeUp 0.7s 0.4s ease both;
        }
        .trust-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--muted);
        }
        .trust-item strong { color: var(--ink); }

        /* ── EVENTS SECTION ── */
        .events-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 6rem 2rem;
        }

        .section-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 3rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .section-label {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--blue);
            margin-bottom: 0.5rem;
        }

        .section-title {
            font-family: 'Syne', sans-serif;
            font-size: clamp(2rem, 4vw, 2.8rem);
            font-weight: 800;
            letter-spacing: -0.04em;
            line-height: 1.1;
        }

        .view-all {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--blue);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.5rem 1rem;
            border: 1px solid rgba(26,86,232,0.2);
            border-radius: 100px;
            transition: background .2s;
            white-space: nowrap;
        }
        .view-all:hover { background: rgba(26,86,232,0.05); }

        /* ── EVENT CARDS ── */
        .events-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        @media (max-width: 900px) {
            .events-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 600px) {
            .events-grid { grid-template-columns: 1fr; }
            nav { padding: 1rem 1.25rem; }
            .hero { padding: 3rem 1.25rem 3rem; }
        }

        .event-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 1.75rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            transition: transform .25s, box-shadow .25s, border-color .25s;
            position: relative;
            overflow: hidden;
        }
        .event-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(26,86,232,0.03) 0%, transparent 60%);
            pointer-events: none;
        }
        .event-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 48px rgba(0,0,0,0.09);
            border-color: rgba(26,86,232,0.15);
        }

        /* first card gets accent treatment */
        .event-card:first-child {
            background: var(--ink);
            border-color: transparent;
        }
        .event-card:first-child .card-venue,
        .event-card:first-child .card-desc { color: rgba(255,255,255,0.5); }
        .event-card:first-child .card-title { color: #fff; }
        .event-card:first-child .card-join { color: var(--accent); }
        .event-card:first-child .card-num {
            background: rgba(232,255,71,0.15);
            color: var(--accent);
        }
        .event-card:first-child .card-divider { border-color: rgba(255,255,255,0.08); }
        .event-card:first-child::before { background: linear-gradient(135deg, rgba(232,255,71,0.05) 0%, transparent 60%); }

        .card-num {
            width: 2.2rem;
            height: 2.2rem;
            background: var(--off);
            color: var(--blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 0.85rem;
        }

        .card-title {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: -0.02em;
            line-height: 1.3;
            color: var(--ink);
            flex-grow: 1;
        }

        .card-desc {
            font-size: 0.875rem;
            font-weight: 300;
            color: var(--muted);
            line-height: 1.6;
        }

        .card-divider { border: none; border-top: 1px solid var(--border); margin: 0; }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-venue {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted);
            display: flex; align-items: center; gap: 0.3rem;
        }
        .card-venue svg { width: 12px; height: 12px; opacity: 0.6; }

        .card-join {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--blue);
            text-decoration: none;
            display: flex; align-items: center; gap: 0.25rem;
            transition: gap .2s;
        }
        .card-join:hover { gap: 0.5rem; }

        /* ── FOOTER ── */
        footer {
            border-top: 1px solid var(--border);
            padding: 2.5rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-logo {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
            letter-spacing: -0.04em;
            color: var(--ink);
        }

        .footer-copy {
            font-size: 0.82rem;
            color: var(--muted);
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .events-section {
            animation: fadeUp 0.7s 0.5s ease both;
        }
    </style>
</head>
<body>

    <!-- NAV -->
    <nav>
        <div class="nav-logo">
            EventPass
            <span>Beta</span>
        </div>
        <div class="nav-actions">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-ghost">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-ghost">Log in</a>
                    <a href="{{ route('register') }}" class="btn-primary">Register →</a>
                @endauth
            @endif
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="blob-2"></div>

        <div class="hero-eyebrow">Your next experience awaits</div>

        <h1 class="hero-title">
            Connecting People<br>
            <span class="highlight">Through Events.</span>
        </h1>

        <p class="hero-sub">
            Book your spot at the most exciting workshops, conferences, and meetups — or host your own.
        </p>

        <div class="hero-ctas">
            <a href="{{ route('register') }}" class="cta-main">Get Started Free</a>
            <a href="#events" class="cta-sec">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
                Explore Events
            </a>
        </div>
    </section>

    <!-- TRUST STRIP -->
    <div class="trust-strip">
        <div class="trust-item">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            <strong>Secure Booking</strong>
        </div>
        <div class="trust-item">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            <strong>Instant Confirmation</strong>
        </div>
        <div class="trust-item">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
            <strong>10k+ Attendees</strong>
        </div>
        <div class="trust-item">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <strong>Local & Online Events</strong>
        </div>
    </div>

    <!-- EVENTS SECTION -->
    <section id="events" class="events-section">
        <div class="section-header">
            <div>
                <div class="section-label">Upcoming</div>
                <h2 class="section-title">Happening Soon</h2>
            </div>
            <a href="{{ route('login') }}" class="view-all">View all events →</a>
        </div>

        <div class="events-grid">
            @foreach($events->take(3) as $event)
            <div class="event-card">
                <div class="card-num">{{ $loop->iteration }}</div>
                <h3 class="card-title">{{ $event->title }}</h3>
                <p class="card-desc">{{ Str::limit($event->description, 90) }}</p>
                <hr class="card-divider">
                <div class="card-footer">
                    <span class="card-venue">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $event->venue }}
                    </span>
                    <a href="{{ route('login') }}" class="card-join">Join →</a>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-logo">EventPass</div>
        <div class="footer-copy">&copy; 2026 EventPass. All rights reserved.</div>
    </footer>

</body>
</html>