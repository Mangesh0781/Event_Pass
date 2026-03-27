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

    .ep-reg-wrap { font-family: 'DM Sans', sans-serif; }

    /* ── LOGO ── */
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
        box-shadow: 0 0 0 3px rgba(232,255,71,0.3);
        display: inline-block;
    }
    .ep-tagline {
        text-align: center;
        font-size: 0.82rem;
        color: var(--muted);
        font-weight: 400;
        margin-bottom: 1.75rem;
    }

    /* ── FIELD ── */
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

    .ep-input-wrap svg.ep-icon {
        position: absolute;
        left: 0.85rem;
        top: 50%;
        transform: translateY(-50%);
        width: 15px; height: 15px;
        color: var(--muted);
        pointer-events: none;
        transition: color .2s;
    }

    .ep-input, .ep-select {
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
        appearance: none;
        -webkit-appearance: none;
    }
    .ep-input::placeholder { color: var(--muted); font-weight: 300; }
    .ep-input:focus, .ep-select:focus {
        background: #fff;
        border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(26,86,232,0.1);
    }
    .ep-input-wrap:focus-within svg.ep-icon { color: var(--blue); }

    /* password toggle */
    .ep-toggle-pw {
        position: absolute;
        right: 0.85rem; top: 50%;
        transform: translateY(-50%);
        background: none; border: none;
        cursor: pointer; color: var(--muted);
        padding: 0; display: flex; align-items: center;
        transition: color .2s;
    }
    .ep-toggle-pw:hover { color: var(--ink); }
    .ep-toggle-pw svg { width: 15px; height: 15px; }

    /* select caret */
    .ep-select-wrap { position: relative; }
    .ep-select-wrap svg.ep-icon { pointer-events: none; }
    .ep-select-caret {
        position: absolute;
        right: 0.85rem; top: 50%;
        transform: translateY(-50%);
        width: 14px; height: 14px;
        color: var(--muted);
        pointer-events: none;
    }

    /* ── ROLE CARDS ── */
    .ep-role-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.65rem;
        margin-top: 0.4rem;
    }
    .ep-role-card {
        position: relative;
        cursor: pointer;
    }
    .ep-role-card input[type="radio"] {
        position: absolute;
        opacity: 0; width: 0; height: 0;
    }
    .ep-role-card-inner {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem 0.75rem;
        background: var(--off);
        border: 1.5px solid transparent;
        border-radius: 12px;
        transition: border-color .2s, background .2s, box-shadow .2s;
        text-align: center;
    }
    .ep-role-card input:checked ~ .ep-role-card-inner {
        background: #fff;
        border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(26,86,232,0.1);
    }
    .ep-role-icon {
        width: 36px; height: 36px;
        border-radius: 10px;
        background: var(--off);
        display: flex; align-items: center; justify-content: center;
        transition: background .2s;
    }
    .ep-role-card input:checked ~ .ep-role-card-inner .ep-role-icon {
        background: var(--accent);
    }
    .ep-role-icon svg { width: 17px; height: 17px; color: var(--ink); }
    .ep-role-name {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--ink);
        font-family: 'Syne', sans-serif;
        letter-spacing: -0.02em;
    }
    .ep-role-desc {
        font-size: 0.68rem;
        color: var(--muted);
        line-height: 1.4;
        font-weight: 400;
    }

    /* ── SUBMIT ── */
    .ep-submit {
        width: 100%;
        margin-top: 1.5rem;
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
        transition: transform .2s, box-shadow .2s;
        box-shadow: 0 3px 0 rgba(0,0,0,0.35);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    .ep-submit:hover { transform: translateY(-1px); box-shadow: 0 5px 0 rgba(0,0,0,0.3); }
    .ep-submit:active { transform: translateY(1px); box-shadow: 0 1px 0 rgba(0,0,0,0.3); }
    .ep-submit svg { width: 16px; height: 16px; }

    /* ── ALREADY REGISTERED ── */
    .ep-login-link {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.35rem;
        margin-top: 1.25rem;
        font-size: 0.82rem;
        color: var(--muted);
    }
    .ep-login-link a {
        font-weight: 600;
        color: var(--blue);
        text-decoration: none;
        transition: opacity .2s;
    }
    .ep-login-link a:hover { opacity: 0.7; }
</style>

<div class="ep-reg-wrap">

    {{-- Logo --}}
    <div class="ep-logo">
        <span class="ep-logo-dot"></span>
        EventPass
    </div>
    <p class="ep-tagline">Create your free account</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Name --}}
        <div class="ep-field">
            <label class="ep-label" for="name">Full name</label>
            <div class="ep-input-wrap">
                <input id="name" class="ep-input" type="text" name="name"
                    value="{{ old('name') }}" required autofocus autocomplete="name"
                    placeholder="Jane Smith" />
                <svg class="ep-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        {{-- Email --}}
        <div class="ep-field">
            <label class="ep-label" for="email">Email address</label>
            <div class="ep-input-wrap">
                <input id="email" class="ep-input" type="email" name="email"
                    value="{{ old('email') }}" required autocomplete="username"
                    placeholder="you@example.com" />
                <svg class="ep-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                </svg>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        {{-- Password --}}
        <div class="ep-field">
            <label class="ep-label" for="password">Password</label>
            <div class="ep-input-wrap">
                <input id="password" class="ep-input" type="password" name="password"
                    required autocomplete="new-password" placeholder="••••••••"
                    style="padding-right:2.8rem;" />
                <svg class="ep-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <button type="button" class="ep-toggle-pw" onclick="togglePw('password','eye1')" aria-label="Toggle password">
                    <svg id="eye1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        {{-- Confirm Password --}}
        <div class="ep-field">
            <label class="ep-label" for="password_confirmation">Confirm password</label>
            <div class="ep-input-wrap">
                <input id="password_confirmation" class="ep-input" type="password"
                    name="password_confirmation" required autocomplete="new-password"
                    placeholder="••••••••" style="padding-right:2.8rem;" />
                <svg class="ep-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <button type="button" class="ep-toggle-pw" onclick="togglePw('password_confirmation','eye2')" aria-label="Toggle confirm password">
                    <svg id="eye2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        {{-- Role --}}
        <div class="ep-field">
            <label class="ep-label">I want to…</label>
            <div class="ep-role-grid">

                <label class="ep-role-card">
                    <input type="radio" name="role" value="customer"
                        {{ old('role', 'customer') === 'customer' ? 'checked' : '' }}>
                    <div class="ep-role-card-inner">
                        <div class="ep-role-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                        </div>
                        <div class="ep-role-name">Attend</div>
                        <div class="ep-role-desc">Book & join events as a guest</div>
                    </div>
                </label>

                <label class="ep-role-card">
                    <input type="radio" name="role" value="organizer"
                        {{ old('role') === 'organizer' ? 'checked' : '' }}>
                    <div class="ep-role-card-inner">
                        <div class="ep-role-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="ep-role-name">Organise</div>
                        <div class="ep-role-desc">Host & manage your own events</div>
                    </div>
                </label>

            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-1" />
        </div>

        {{-- Submit --}}
        <button type="submit" class="ep-submit">
            Create account
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
        </button>

    </form>

    {{-- Already have account --}}
    <div class="ep-login-link">
        Already have an account?
        <a href="{{ route('login') }}">Sign in →</a>
    </div>

</div>

<script>
function togglePw(inputId, eyeId) {
    const input = document.getElementById(inputId);
    const eye   = document.getElementById(eyeId);
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    eye.innerHTML = isHidden
        ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`
        : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
}
</script>

</x-guest-layout>