<style>
    /* ==============================
       SHARED HEADER STYLES
    ============================== */
    .top-bar {
        background: #FAFBFA;
        /* لون أفتح وأريح للعين مقارنة باللون السابق الغامق */
        padding: 10px 5% 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: none;
        clip-path: none;
        position: relative;
    }

    .top-bar-right {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .top-brand-link {
        display: flex;
        align-items: center;
        gap: 14px;
        text-decoration: none;
    }

    .top-logo {
        height: 36px;
        object-fit: contain;
    }

    .top-site-name {
        color: #0D1C2C;
        font-size: 15px;
        font-weight: 700;
        border-right: 2px solid rgba(255, 255, 255, 0.3);
        padding-right: 14px;
    }

    .top-bar-left {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .top-link {
        color: #a7f3d0;
        font-size: 13px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: color 0.2s;
    }

    .top-link:hover {
        color: #fff;
    }

    .top-user {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.1);
        padding: 6px 14px;
        border-radius: 30px;
    }

    .top-user img {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #a7f3d0;
    }

    .top-user span {
        color: #fff;
        font-size: 13px;
        font-weight: 600;
    }

    .notif-btn {
        position: relative;
        width: 34px;
        height: 34px;
        background: rgba(255, 255, 255, 0.1);
        border: none;
        border-radius: 50%;
        color: #fff;
        font-size: 15px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
    }

    .notif-btn:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .notif-badge {
        position: absolute;
        top: -3px;
        left: -3px;
        background: #ef4444;
        color: #fff;
        font-size: 9px;
        font-weight: 800;
        min-width: 16px;
        height: 16px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 3px;
    }

    .cart-icon-btn {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.22);
        border-radius: 50%;
        color: #fff;
        text-decoration: none;
        font-size: 15px;
        transition: background 0.2s;
        flex-shrink: 0;
    }

    .cart-icon-btn:hover {
        background: rgba(255, 255, 255, 0.24);
        color: #fff;
    }

    .cart-count-badge {
        position: absolute;
        top: -4px;
        left: -4px;
        background: #ef4444;
        color: #fff;
        font-size: 9px;
        font-weight: 800;
        min-width: 17px;
        height: 17px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 3px;
        font-family: 'Cairo', sans-serif;
        border: 2px solid #2d8a5a;
    }

    .lang-btn {
        display: flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        font-family: 'Cairo', sans-serif;
        transition: background 0.2s;
    }

    .lang-btn:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    /* ── Language Toggle Pill ── */
    .lang-toggle-pill {
        display: inline-flex;
        align-items: center;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 20px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.08);
    }

    .lang-toggle-pill a {
        display: inline-flex;
        align-items: center;
        padding: 5px 13px;
        font-family: 'Cairo', sans-serif;
        font-size: 12px;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
        white-space: nowrap;
    }

    .lang-toggle-pill a:hover {
        color: #fff;
    }

    .lang-toggle-pill a.active {
        background: rgba(255, 255, 255, 0.25);
        color: #fff;
    }

    .lang-toggle-pill .ltp-divider {
        width: 1px;
        height: 16px;
        background: rgba(255, 255, 255, 0.25);
        flex-shrink: 0;
    }

    .auth-btn {
        display: flex;
        align-items: center;
        gap: 7px;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.25);
        color: #fff;
        padding: 6px 16px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        font-family: 'Cairo', sans-serif;
        transition: background 0.2s;
        white-space: nowrap;
    }

    .auth-btn:hover {
        background: rgba(255, 255, 255, 0.22);
        color: #fff;
    }

    .auth-btn.login-btn {
        background: #c8a951;
        border-color: #c8a951;
    }

    .auth-btn.login-btn:hover {
        background: #b8960e;
    }

    .user-menu {
        position: relative;
    }

    .user-menu-dropdown {
        display: none;
        position: absolute;
        top: calc(100% + 10px);
        left: 0;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.18);
        min-width: 170px;
        z-index: 200;
        overflow: hidden;
        font-family: 'Cairo', sans-serif;
        animation: fadeDown .15s ease;
    }

    .user-menu-dropdown.open {
        display: block;
    }

    @keyframes fadeDown {
        from {
            opacity: 0;
            transform: translateY(-6px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .user-menu-dropdown a,
    .user-menu-dropdown button {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 11px 16px;
        color: #1e2d27;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        border: none;
        background: none;
        width: 100%;
        font-family: 'Cairo', sans-serif;
        cursor: pointer;
        text-align: right;
        transition: background 0.15s;
    }

    .user-menu-dropdown a:hover,
    .user-menu-dropdown button:hover {
        background: #e8f5ee;
        color: #2d8a5a;
    }

    .user-menu-dropdown .divider-line {
        border: none;
        border-top: 1px solid #f0f4f2;
        margin: 4px 0;
    }

    @media (max-width: 600px) {
        .top-bar {
            padding: 10px 5% 15px;
            clip-path: none;
        }

        .top-site-name {
            display: none;
        }

        .auth-btn span.auth-label {
            display: none;
        }

        .top-main-nav {
            gap: 4px;
        }

        .top-nav-label {
            display: none;
        }

        .top-nav-item {
            padding: 7px 10px;
        }

        .top-link-label {
            display: none;
        }
    }

    /* ==============================
       MAIN NAV (center)
    ============================== */
    .top-main-nav {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .top-nav-item {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 15px;
        border-radius: 30px;
        font-family: 'Cairo', sans-serif;
        font-size: 13px;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.82);
        text-decoration: none;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.14);
        transition: background .18s, color .18s, border-color .18s, transform .15s;
        white-space: nowrap;
    }

    .top-nav-item:hover,
    .top-nav-item.active {
        background: rgba(255, 255, 255, 0.18);
        border-color: rgba(255, 255, 255, 0.30);
        color: #fff;
        transform: translateY(-1px);
    }

    .top-nav-icon {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.12);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        flex-shrink: 0;
        transition: background .18s;
    }

    .top-nav-item:hover .top-nav-icon,
    .top-nav-item.active .top-nav-icon {
        background: rgba(255, 255, 255, 0.22);
    }

    /* Partners button — slightly distinguished */
    .top-nav-partners {
        background: rgba(200, 169, 81, 0.18);
        border-color: rgba(200, 169, 81, 0.35);
        color: #f5e09a;
    }

    .top-nav-partners:hover {
        background: rgba(200, 169, 81, 0.30);
        border-color: rgba(200, 169, 81, 0.55);
        color: #fde68a;
    }

    .top-nav-partners .top-nav-icon {
        background: rgba(200, 169, 81, 0.25);
        color: #f5e09a;
    }
</style>

<!-- ============ TOP HEADER BAR ============ -->
<div class="top-bar">

    {{-- ===== RIGHT: Brand ===== --}}


    {{-- ===== CENTER: Main Nav ===== --}}
    <div class="top-bar-right">
        <a href="{{ url('/') }}" class="top-brand-link" aria-label="الذهاب إلى الصفحة الرئيسية">
            <img src="{{ asset('images/new-logo1.png') }}" class="top-logo" alt="أمر تم">
            <span class="top-site-name">آمر تم</span>
        </a>
    </div>


    {{-- ===== LEFT: Utility ===== --}}
    <div class="top-bar-left">

        @auth
            @php
                $__cartCount = \App\Models\Cart::where('user_id', Auth::id())->first()?->items()->count() ?? 0;
            @endphp

            <a href="{{ route('cart.index') }}" class="cart-icon-btn" title="{{ __('header.cart') }}">
                <i class="fa fa-shopping-cart"></i>

                @if ($__cartCount > 0)
                    <span class="cart-count-badge">{{ $__cartCount }}</span>
                @endif
            </a>

            <a href="{{ route('partner.services') }}" class="top-link">
                <i class="fas fa-list-check"></i>
                <span class="top-link-label">{{ __('header.my_services') }}</span>
            </a>

            {{-- <a href="{{ url('/amrtm') }}" class="top-link">
        <i class="fa fa-briefcase"></i>
        <span class="top-link-label">أمر تم</span>
    </a> --}}
            <div class="user-menu" id="userMenu">
                <button type="button" class="auth-btn" id="userMenuToggle" onclick="toggleUserMenu(event)"
                    style="border:none; cursor:pointer;">
                    <i class="fa fa-user-circle" style="font-size:16px;"></i>
                    <span class="auth-label">{{ Auth::user()->name }}</span>
                    <i class="fa fa-chevron-down" id="userMenuChevron"
                        style="font-size:10px; opacity:.7; transition:transform .2s;"></i>
                </button>
                <div class="user-menu-dropdown" id="userMenuDropdown">
                    @php $role = Auth::user()->role->value; @endphp
                    @if ($role === 'supervisor')
                        <a href="{{ route('supervisor.dashboard') }}"><i class="fa fa-tachometer-alt"></i>
                            {{ __('header.dashboard') }}</a>
                        <a href="{{ route('supervisor.users') }}"><i class="fa fa-users"></i>
                            {{ __('header.manage_users') }}</a>
                        {{-- <a href="{{ route('supervisor.halls') }}"><i class="fa fa-building"></i> {{ __('header.halls') }}</a> --}}
                        <a href="{{ route('supervisor.bookings') }}"><i class="fa fa-calendar-check"></i>
                            {{ __('header.bookings') }}</a>
                        <a href="{{ route('supervisor.referrals') }}"><i class="fa fa-link"></i>
                            {{ __('header.referrals') }}</a>
                        <a href="{{ route('amrtm.admin.dashboard') }}"><i class="fa fa-file-alt"></i> خدمات الأعمال</a>
                    @elseif($role === 'manager')
                        <a href="{{ route('manager.dashboard') }}"><i class="fa fa-tachometer-alt"></i>
                            {{ __('header.dashboard') }}</a>
                        <a href="{{ route('manager.agents') }}"><i class="fa fa-users"></i> {{ __('header.agents') }}</a>
                        <a href="{{ route('manager.halls') }}"><i class="fa fa-building"></i> {{ __('header.halls') }}</a>
                        <a href="{{ route('manager.bookings') }}"><i class="fa fa-calendar-check"></i>
                            {{ __('header.bookings') }}</a>
                        <a href="{{ route('manager.referrals') }}"><i class="fa fa-link"></i>
                            {{ __('header.referrals') }}</a>
                        <a href="{{ route('amrtm.user.dashboard') }}"><i class="fa fa-file-alt"></i> خدمات الأعمال</a>
                    @elseif($role === 'agent')
                        <a href="{{ route('agent.dashboard') }}"><i class="fa fa-tachometer-alt"></i>
                            {{ __('header.dashboard') }}</a>
                        <a href="{{ route('agent.referrals') }}"><i class="fa fa-link"></i>
                            {{ __('header.my_referrals') }}</a>
                        <a href="{{ route('agent.halls') }}"><i class="fa fa-building"></i> {{ __('header.halls') }}</a>
                    @elseif($role === 'owner')
                        <a href="{{ route('owner.dashboard') }}">
                            <i class="fa fa-tachometer-alt"></i> {{ __('header.dashboard') }}
                        </a>
                        <a href="{{ route('owner.hall-info') }}">
                            <i class="fa fa-building"></i> {{ __('header.my_hall') }}
                        </a>
                        <a href="{{ route('owner.bookings') }}">
                            <i class="fa fa-calendar-check"></i> {{ __('header.bookings') }}
                        </a>
                    @elseif($role === 'partner')
                        <a href="{{ route('partner.dashboard') }}">
                            <i class="fa fa-tachometer-alt"></i> {{ __('header.partner_dashboard') }}
                        </a>
                        <a href="{{ route('partner.profile-setup') }}">
                            <i class="fas fa-id-card"></i> {{ __('header.profile_data') }}
                        </a>
                        <a href="{{ route('partner.services') }}">
                            <i class="fas fa-list-check"></i> {{ __('header.my_services') }}
                        </a>
                    @elseif($role === 'officiant')
                        <a href="{{ route('officiant.dashboard') }}">
                            <i class="fa fa-tachometer-alt"></i> لوحة التحكم
                        </a>
                        <a href="{{ route('officiant.profile-setup') }}">
                            <i class="fas fa-id-card"></i> بيانات البروفايل
                        </a>
                        <a href="{{ route('officiant.services') }}">
                            <i class="fas fa-list-check"></i> خدماتي وأسعاري
                        </a>
                        <a href="{{ route('officiant.bookings') }}">
                            <i class="fas fa-calendar-check"></i> طلبات الحجز
                        </a>
                    @else
                        <a href="{{ route('halls.list') }}"><i class="fa fa-search"></i>
                            {{ __('header.browse_halls') }}</a>
                        <a href="{{ route('user.my-bookings') }}"><i class="fa fa-calendar-check"></i> طلباتي</a>
                        <a href="{{ route('amrtm.user.dashboard') }}"><i class="fa fa-file-alt"></i> خدمات الأعمال</a>
                    @endif
                    <hr class="divider-line">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"><i class="fa fa-sign-out-alt"></i> {{ __('header.logout') }}</button>
                    </form>
                </div>
            </div>
        @elseif (Route::has('login'))
            <a href="{{ route('login') }}" class="auth-btn login-btn">
                <i class="fa fa-sign-in-alt"></i>
                <span class="auth-label">{{ __('header.login') }}</span>
            </a>
        @endauth

        @php $isAr = app()->getLocale() === 'ar'; @endphp
        @if (Route::has('lang.switch'))
            <div class="lang-toggle-pill">
                <a href="{{ route('lang.switch', 'ar') }}" class="{{ $isAr ? 'active' : '' }}">عربي</a>
                <span class="ltp-divider"></span>
                <a href="{{ route('lang.switch', 'en') }}" class="{{ !$isAr ? 'active' : '' }}">EN</a>
            </div>
        @endif
    </div>
</div>

<script>
    function toggleUserMenu(e) {
        e.stopPropagation();
        var dropdown = document.getElementById('userMenuDropdown');
        var chevron = document.getElementById('userMenuChevron');
        var isOpen = dropdown.classList.contains('open');
        dropdown.classList.toggle('open', !isOpen);
        chevron.style.transform = isOpen ? '' : 'rotate(180deg)';
    }

    document.addEventListener('click', function(e) {
        var menu = document.getElementById('userMenu');
        if (menu && !menu.contains(e.target)) {
            document.getElementById('userMenuDropdown').classList.remove('open');
            document.getElementById('userMenuChevron').style.transform = '';
        }
    });
</script>
