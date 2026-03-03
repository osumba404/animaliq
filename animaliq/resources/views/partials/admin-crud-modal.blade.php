{{-- Admin CRUD modal: include in admin layout. Links with data-crud-modal load their href into #crud-modal-content and open the modal. --}}
<div id="crud-modal" class="fixed inset-0 z-50 hidden" aria-modal="true" role="dialog" aria-labelledby="crud-modal-title">
    <div class="fixed inset-0 bg-black/50" id="crud-modal-backdrop"></div>
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="theme-card rounded-lg max-w-2xl w-full max-h-[90vh] overflow-auto shadow-xl relative" id="crud-modal-content-wrap">
            <button type="button" id="crud-modal-close" class="absolute top-3 right-3 w-8 h-8 rounded-full theme-bg-secondary flex items-center justify-center theme-text-primary hover:theme-accent" aria-label="Close">&times;</button>
            <div id="crud-modal-content" class="p-6 pt-10"></div>
        </div>
    </div>
</div>
<script>
(function() {
    var modal = document.getElementById('crud-modal');
    var content = document.getElementById('crud-modal-content');
    var backdrop = document.getElementById('crud-modal-backdrop');
    var closeBtn = document.getElementById('crud-modal-close');
    function openModal() { modal.classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
    function closeModal() { modal.classList.add('hidden'); document.body.style.overflow = ''; if (content) content.innerHTML = ''; }
    if (backdrop) backdrop.addEventListener('click', closeModal);
    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    document.addEventListener('click', function(e) {
        var a = e.target.closest('a[data-crud-modal]');
        if (!a) return;
        e.preventDefault();
        var url = a.getAttribute('href');
        if (!url) return;
        content.innerHTML = '<p class="theme-text-secondary">Loading…</p>';
        openModal();
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'text/html' } })
            .then(function(r) { return r.text(); })
            .then(function(html) { content.innerHTML = html; })
            .catch(function() { content.innerHTML = '<p class="theme-alert-error p-4">Failed to load form.</p>'; });
    });
})();
</script>
