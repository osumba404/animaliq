{{-- Theme toggle: light / dark. Place in header. --}}
<div class="theme-switch-wrap" role="group" aria-label="Theme">
    <button type="button" class="theme-switch-btn active" data-theme="light" aria-pressed="true">Light</button>
    <button type="button" class="theme-switch-btn" data-theme="dark" aria-pressed="false">Dark</button>
</div>
<script>
(function() {
    var KEY = 'animaliq-theme';
    function getStored() { try { return localStorage.getItem(KEY); } catch (e) { return null; } }
    function setStored(v) { try { localStorage.setItem(KEY, v); } catch (e) {} }
    function apply(theme) {
        var html = document.documentElement;
        html.classList.remove('light-theme', 'dark-theme');
        html.classList.add(theme === 'dark' ? 'dark-theme' : 'light-theme');
        document.querySelectorAll('.theme-switch-btn').forEach(function(btn) {
            var t = btn.getAttribute('data-theme');
            btn.classList.toggle('active', t === theme);
            btn.setAttribute('aria-pressed', t === theme ? 'true' : 'false');
        });
        setStored(theme);
    }
    var preferred = getStored();
    if (!preferred && typeof window !== 'undefined' && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) preferred = 'dark';
    if (!preferred) preferred = 'light';
    apply(preferred);
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.theme-switch-btn').forEach(function(btn) {
            btn.addEventListener('click', function() { apply(btn.getAttribute('data-theme')); });
        });
    });
})();
</script>
