{{-- Single icon theme toggle: sun (in dark mode) = switch to light; moon (in light mode) = switch to dark --}}
<button type="button" id="theme-toggle-btn" class="flex items-center justify-center w-9 h-9 rounded-lg theme-bg-secondary theme-border border p-0 text-current hover:opacity-80 transition-opacity" aria-label="Toggle light/dark mode" title="Toggle theme">
    <svg id="theme-icon-light" class="nav-icon w-5 h-5 hidden" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
    <svg id="theme-icon-dark" class="nav-icon w-5 h-5 hidden" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
</button>
<script>
(function() {
    var KEY = 'animaliq-theme';
    function getStored() { try { return localStorage.getItem(KEY); } catch (e) { return null; } }
    function setStored(v) { try { localStorage.setItem(KEY, v); } catch (e) {} }
    function apply(theme) {
        var html = document.documentElement;
        html.classList.remove('light-theme', 'dark-theme');
        html.classList.add(theme === 'dark' ? 'dark-theme' : 'light-theme');
        setStored(theme);
        var iconLight = document.getElementById('theme-icon-light');
        var iconDark = document.getElementById('theme-icon-dark');
        if (iconLight && iconDark) {
            iconLight.classList.toggle('hidden', theme !== 'dark');
            iconDark.classList.toggle('hidden', theme !== 'light');
        }
    }
    var preferred = getStored();
    if (!preferred && typeof window !== 'undefined' && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) preferred = 'dark';
    if (!preferred) preferred = 'light';
    apply(preferred);
    document.addEventListener('DOMContentLoaded', function() {
        apply(document.documentElement.classList.contains('dark-theme') ? 'dark' : 'light');
        var btn = document.getElementById('theme-toggle-btn');
        if (btn) {
            btn.addEventListener('click', function() {
                var isDark = document.documentElement.classList.contains('dark-theme');
                apply(isDark ? 'light' : 'dark');
            });
        }
    });
})();
</script>
