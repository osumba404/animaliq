{{-- Orange & Black palette: light + dark mode. Include in <head>. --}}
<script>
(function(){var k='animaliq-theme';var s=(typeof localStorage!=='undefined'&&localStorage.getItem(k));var t=s||(typeof window!=='undefined'&&window.matchMedia&&window.matchMedia('(prefers-color-scheme: dark)').matches?'dark':'light');document.documentElement.classList.add(t==='dark'?'dark-theme':'light-theme');})();
</script>
<style>
    * { transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease; }
    /* Light theme (default) */
    html, html.light-theme {
        --bg-primary: #FFFFFF;
        --bg-secondary: #F8F9FA;
        --bg-warm: #FFF5E6;
        --text-primary: #2C2C2C;
        --text-secondary: #36454F;
        --border-color: #C0C0C0;
        --accent-orange: #FF7518;
        --card-bg: #F8F9FA;
        --shadow: rgba(0, 0, 0, 0.1);
        --orange-100: #FFDAB9;
        --orange-200: #FFB347;
        --orange-300: #FF7F50;
        --orange-400: #F28500;
        --orange-500: #FF7518;
        --orange-600: #CC5500;
        --orange-700: #B7410E;
        --orange-800: #E2725B;
        --orange-900: #C04000;
    }
    /* Dark theme */
    html.dark-theme {
        --bg-primary: #121212;
        --bg-secondary: #1A1A1A;
        --bg-warm: #242424;
        --text-primary: #FFFFFF;
        --text-secondary: #E0E0E0;
        --border-color: #404040;
        --accent-orange: #FF5F1F;
        --card-bg: #1A1A1A;
        --shadow: rgba(0, 0, 0, 0.3);
        --orange-100: #3d2817;
        --orange-200: #FFA500;
        --orange-300: #FF6B35;
        --orange-400: #FFBF00;
        --orange-500: #FFAE42;
        --orange-600: #FD5E53;
        --orange-700: #e85d4f;
        --orange-800: #FF4433;
        --orange-900: #B86B4C;
    }
    body { background-color: var(--bg-primary); color: var(--text-primary); line-height: 1.6; overflow-x: hidden; }
    img { max-width: 100%; height: auto; }
    .overflow-x-auto-mobile { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    .theme-bg-primary { background-color: var(--bg-primary); }
    .theme-bg-secondary { background-color: var(--bg-secondary); }
    .theme-bg-warm { background-color: var(--bg-warm); }
    .theme-text-primary { color: var(--text-primary); }
    .theme-text-secondary { color: var(--text-secondary); }
    .theme-border { border-color: var(--border-color); }
    .theme-accent { color: var(--accent-orange); }
    .theme-card { background: var(--card-bg); border: 1px solid var(--border-color); box-shadow: 0 4px 6px var(--shadow); }
    .theme-btn {
        background: var(--accent-orange); color: #fff; border: none; padding: 0.5rem 1rem; border-radius: 0.5rem;
        font-weight: 600; cursor: pointer;
    }
    .theme-btn:hover { filter: brightness(1.1); }
    .theme-btn-outline {
        background: transparent; color: var(--accent-orange); border: 2px solid var(--accent-orange);
        padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 600; cursor: pointer;
    }
    .theme-btn-outline:hover { background: var(--accent-orange); color: #fff; }
    a.theme-link { color: var(--accent-orange); text-decoration: none; }
    a.theme-link:hover { text-decoration: underline; }
    .theme-nav-link { color: var(--text-secondary); text-decoration: none; }
    .theme-nav-link:hover { color: var(--accent-orange); text-decoration: underline; }
    .theme-input {
        background: var(--bg-primary); color: var(--text-primary); border: 1px solid var(--border-color);
        border-radius: 0.375rem; padding: 0.5rem 0.75rem; width: 100%;
    }
    .theme-input:focus { outline: none; border-color: var(--accent-orange); box-shadow: 0 0 0 2px rgba(255, 117, 24, 0.2); }
    .theme-alert-success { background: var(--orange-100); color: var(--orange-900); border: 1px solid var(--orange-300); }
    .theme-alert-error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }
    html.dark-theme .theme-alert-error { background: #450a0a; color: #fecaca; border-color: #991b1b; }
    .theme-section-title { color: var(--accent-orange); border-left: 4px solid var(--orange-400); padding-left: 0.75rem; }
    .theme-header-border { border-bottom: 2px solid var(--accent-orange); }
    .theme-switch-wrap { display: flex; gap: 0.25rem; background: var(--bg-secondary); padding: 0.25rem; border-radius: 2rem; border: 1px solid var(--border-color); }
    .theme-switch-btn { padding: 0.35rem 0.75rem; border: none; border-radius: 2rem; cursor: pointer; font-size: 0.875rem; font-weight: 600; background: transparent; color: var(--text-secondary); }
    .theme-switch-btn.active { background: var(--accent-orange); color: #fff; }
    .theme-badge { background: var(--orange-100); color: var(--orange-900); padding: 0.125rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; }
    html.dark-theme .theme-badge { background: var(--orange-700); color: #fff; }
    .theme-table-header { background: var(--bg-secondary); color: var(--text-primary); }
    .theme-table-cell { border-color: var(--border-color); }

    /* Mobile menu & hamburger */
    .mobile-menu-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 40; opacity: 0; pointer-events: none; transition: opacity 0.2s ease; }
    .mobile-menu-overlay.open { opacity: 1; pointer-events: auto; }
    .mobile-nav-panel { position: fixed; top: 0; right: 0; bottom: 0; width: min(280px, 85vw); max-width: 100%; background: var(--bg-primary); border-left: 1px solid var(--border-color); z-index: 50; transform: translateX(100%); transition: transform 0.25s ease; overflow-y: auto; box-shadow: -4px 0 20px var(--shadow); }
    .mobile-nav-panel.open { transform: translateX(0); }
    .hamburger-btn { display: flex; flex-direction: column; justify-content: center; gap: 5px; width: 40px; height: 40px; padding: 8px; background: transparent; border: 1px solid var(--border-color); border-radius: 0.375rem; cursor: pointer; color: var(--text-primary); }
    .hamburger-btn span { display: block; width: 100%; height: 2px; background: currentColor; border-radius: 1px; transition: transform 0.2s ease, opacity 0.2s ease; }
    .hamburger-btn.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
    .hamburger-btn.open span:nth-child(2) { opacity: 0; }
    .hamburger-btn.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
    body.mobile-nav-open { overflow: hidden; }
    .mobile-nav-link:hover { background: var(--bg-warm); }
    @media (min-width: 768px) {
        .mobile-menu-overlay.open { opacity: 0; pointer-events: none; }
        .mobile-nav-panel.open { transform: translateX(100%); }
    }

    /* Admin mobile sidebar */
    .admin-sidebar-mobile-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 40; opacity: 0; pointer-events: none; transition: opacity 0.2s ease; }
    .admin-sidebar-mobile-overlay.open { opacity: 1; pointer-events: auto; }
    @media (min-width: 768px) {
        .admin-sidebar-mobile-overlay { display: none !important; }
    }
</style>
