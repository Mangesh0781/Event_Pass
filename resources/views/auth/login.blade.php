<x-guest-layout>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@300;400;500;600&display=swap');

    :root {
        --ink:    #0d0d0d;
        --cream:  #faf9f6;
        --off:    #f2f0eb;
        --accent: #e8ff47;
        --blue:   #1a56e8;
        --muted:  #7a7670;
        --border: rgba(13,13,13,0.09);
        --red:    #ef4444;
    }

    .ep-login-wrap {
        font-family: 'DM Sans', sans-serif;
    }

    /* ── LOGO / HEADER ── */
    .ep-logo {
        font-family: 'Syne', sans-serif;
        font-weight: 800;
        font-size: 1.4rem;
        letter-spacing: -0.04em;
        color: var(--ink);
        text-align: center;
        margin-bottom: 0.35rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.45rem;
    }
    .ep-logo-dot {
        width: 8px; height: 8px;
        background: var(--accent);
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 0 3px rgba(232,255,71,0.3);
    }
    .ep-tagline {
        text-align: center;
        font-size: 0.82rem;
        color: var(--muted);
        font-weight: 400;
        margin-bottom: 2rem;
        letter-spacing: 0.01em;
    }

    /* ── ERROR BLOCK ── */
    .ep-error {
        margin-bottom: 1.25rem;
        padding: 0.9rem 1rem;
        background: #fff5f5;
        border: 1px solid rgba(239,68,68,0.2);
        border-radius: 12px;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        animation: ep-shake 0.4s ease;
    }
    @keyframes ep-shake {
        0%,100% { transform: translateX(0); }
        20%      { transform: translateX(-5px); }
        40%      { transform: translateX(5px); }
        60%      { transform: translateX(-3px); }
        80%      { transform: translateX(3px); }
    }
    .ep-error-icon {
        width: 28px; height: 28px;
        background: var(--red);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .ep-error-icon svg { width: 13px; height: 13px; color: #fff; }
    .ep-error-title {
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: #991b1b;
        margin-bottom: 2px;
    }
    .ep-error-msg {
        font-size: 0.8rem;
        color: #b91c1c;
        font-weight: 400;
        line-height: 1.4;
    }

    /* ── FORM FIELDS ── */
    .ep-field { margin-bottom: 1rem; }

    .ep-label {
        display: block;
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--ink);
        margin-bottom: 0.4rem;
        letter-spacing: 0.01em;
    }

    .ep-input-wrap { position: relative; }

    .ep-input-wrap svg.ep-input-icon {
        position: absolute;
        left: 0.85rem;
        top: 50%;
        transform: translateY(-50%);
        width: 15px; height: 15px;
        color: var(--muted);
        pointer-events: none;
        transition: color .2s;
    }

    .ep-input {
        width: 100%;
        padding: 0.75rem 0.9rem 0.75rem 2.5rem;
        background: var(--off);
        border: 1.5px solid transparent;
        border-radius: 10px;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.9rem;
        color: var(--ink);
        outline: none;
        transition: border-color .2s, background .2s, box-shadow .2s;
    }
    .ep-input::placeholder { color: var(--muted); font-weight: 300; }
    .ep-input:focus {
        background: #fff;
        border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(26,86,232,0.1);
    }
    .ep-input:focus + svg.ep-input-icon,
    .ep-input-wrap:focus-within svg.ep-input-icon { color: var(--blue); }

    /* toggle password button */
    .ep-toggle-pw {
        position: absolute;
        right: 0.85rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: var(--muted);
        padding: 0;
        display: flex;
        align-items: center;
        transition: color .2s;
    }
    .ep-toggle-pw:hover { color: var(--ink); }
    .ep-toggle-pw svg { width: 15px; height: 15px; }

    /* error message under field */
    .ep-field-err {
        font-size: 0.75rem;
        color: var(--red);
        margin-top: 0.35rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    /* ── REMEMBER + FORGOT ROW ── */
    .ep-meta-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 1rem 0 1.5rem;
    }

    .ep-checkbox-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        font-size: 0.83rem;
        color: var(--muted);
        font-weight: 400;
        user-select: none;
    }
    .ep-checkbox-label input[type="checkbox"] {
        width: 15px; height: 15px;
        accent-color: var(--blue);
        border-radius: 4px;
        cursor: pointer;
    }

    .ep-forgot {
        font-size: 0.8rem;
        font-weight: 500;
        color: var(--blue);
        text-decoration: none;
        transition: opacity .2s;
    }
    .ep-forgot:hover { opacity: 0.7; }

    /* ── SUBMIT BUTTON ── */
    .ep-submit {
        width: 100%;
        padding: 0.85rem;
        background: var(--ink);
        color: #fff;
        font-family: 'Syne', sans-serif;
        font-size: 0.95rem;
        font-weight: 700;
        letter-spacing: -0.01em;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: transform .2s, box-shadow .2s, background .2s;
        box-shadow: 0 3px 0 rgba(0,0,0,0.35);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    .ep-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 0 rgba(0,0,0,0.3);
    }
    .ep-submit:active {
        transform: translateY(1px);
        box-shadow: 0 1px 0 rgba(0,0,0,0.3);
    }
    .ep-submit svg { width: 16px; height: 16px; }

    /* ── DIVIDER ── */
    .ep-divider {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin: 1.5rem 0;
        color: var(--muted);
        font-size: 0.75rem;
        font-weight: 500;
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }
    .ep-divider::before,
    .ep-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--border);
    }

    /* ── REGISTER CTA ── */
    .ep-register-cta {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        padding: 0.85rem;
        background: var(--off);
        border: 1.5px solid var(--border);
        border-radius: 12px;
        text-decoration: none;
        transition: border-color .2s, background .2s, transform .2s;
    }
    .ep-register-cta:hover {
        border-color: rgba(26,86,232,0.25);
        background: #fff;
        transform: translateY(-1px);
    }
    .ep-register-cta-icon {
        width: 32px; height: 32px;
        background: var(--accent);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .ep-register-cta-icon svg { width: 15px; height: 15px; color: var(--ink); }
    .ep-register-cta-text { text-align: left; }
    .ep-register-cta-label {
        font-size: 0.7rem;
        color: var(--muted);
        font-weight: 400;
        letter-spacing: 0.03em;
        line-height: 1;
        margin-bottom: 2px;
    }
    .ep-register-cta-action {
        font-size: 0.875rem;
        font-weight: 700;
        color: var(--ink);
        font-family: 'Syne', sans-serif;
        letter-spacing: -0.02em;
    }
    .ep-register-cta-arrow {
        margin-left: auto;
        color: var(--muted);
        transition: transform .2s, color .2s;
    }
    .ep-register-cta:hover .ep-register-cta-arrow {
        transform: translateX(3px);
        color: var(--blue);
    }
    .ep-register-cta-arrow svg { width: 16px; height: 16px; }
</style>

<div class="ep-login-wrap">

    {{-- LOGO --}}
    <div class="ep-logo">
        <span class="ep-logo-dot"></span>
        EventPass
    </div>
    <p class="ep-tagline">Sign in to your account</p>

    {{-- Session Status --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- Error Banner --}}
    @if (session('popup_error'))
    <div class="ep-error">
        <div class="ep-error-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </div>
        <div>
            <div class="ep-error-title">Access Blocked</div>
            <div class="ep-error-msg">{{ session('popup_error') }}</div>
        </div>
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="ep-field">
            <label class="ep-label" for="email">Email address</label>
            <div class="ep-input-wrap">
                <input
                    id="email"
                    class="ep-input"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="you@example.com"
                />
                <svg class="ep-input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                </svg>
            </div>
            <x-input-error :messages="$errors->get('email')" class="ep-field-err mt-2" />
        </div>

        {{-- Password --}}
        <div class="ep-field">
            <label class="ep-label" for="password">Password</label>
            <div class="ep-input-wrap">
                <input
                    id="password"
                    class="ep-input"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                    style="padding-right: 2.8rem;"
                />
                <svg class="ep-input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <button type="button" class="ep-toggle-pw" onclick="togglePw()" aria-label="Toggle password">
                    <svg id="pw-eye" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="ep-field-err mt-2" />
        </div>

        {{-- Remember + Forgot --}}
        <div class="ep-meta-row">
            <label class="ep-checkbox-label" for="remember_me">
                <input id="remember_me" type="checkbox" name="remember">
                Remember me
            </label>
            @if (Route::has('password.request'))
                <a class="ep-forgot" href="{{ route('password.request') }}">Forgot password?</a>
            @endif
        </div>

        {{-- Submit --}}
        <button type="submit" class="ep-submit">
            Sign in
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
        </button>
    </form>

    {{-- Divider --}}
    <div class="ep-divider">or</div>

    {{-- Register CTA --}}
    @if (Route::has('register'))
    <a href="{{ route('register') }}" class="ep-register-cta">
        <div class="ep-register-cta-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
        </div>
        <div class="ep-register-cta-text">
            <div class="ep-register-cta-label">New to EventPass?</div>
            <div class="ep-register-cta-action">Create a free account</div>
        </div>
        <div class="ep-register-cta-arrow">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </div>
    </a>
    @endif

</div>

<script>
function togglePw() {
    const input = document.getElementById('password');
    const eye = document.getElementById('pw-eye');
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    eye.innerHTML = isHidden
        ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`
        : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
}
</script>

</x-guest-layout>