<script>
(function() {
    function initShare() {
        document.querySelectorAll('.share-trigger').forEach(function(btn) {
            var id = btn.getAttribute('data-share-id');
            var modal = document.querySelector('.share-modal[data-share-modal="' + id + '"]');
            if (!modal) return;
            btn.addEventListener('click', function() {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            });
        });
        document.querySelectorAll('.share-close').forEach(function(btn) {
            var id = btn.getAttribute('data-share-id');
            var modal = document.querySelector('.share-modal[data-share-modal="' + id + '"]');
            if (!modal) return;
            function close() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = '';
            }
            btn.addEventListener('click', close);
            modal.addEventListener('click', function(e) {
                if (e.target === modal || !modal.querySelector('.share-modal-inner').contains(e.target)) close();
            });
        });
        document.querySelectorAll('.share-copy').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var url = this.getAttribute('data-share-copy');
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(url).then(function() {
                        var orig = btn.innerHTML;
                        btn.innerHTML = '<span class="flex-shrink-0 w-10 h-10 rounded-full bg-green-500/20 flex items-center justify-center"><svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></span><span class="font-medium text-green-600">Copied!</span>';
                        setTimeout(function() { btn.innerHTML = orig; }, 2000);
                    });
                } else {
                    var ta = document.createElement('textarea'); ta.value = url; document.body.appendChild(ta); ta.select(); document.execCommand('copy'); document.body.removeChild(ta);
                    var orig = btn.innerHTML;
                    btn.innerHTML = '<span class="flex-shrink-0 w-10 h-10 rounded-full bg-green-500/20 flex items-center justify-center"><svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></span><span class="font-medium text-green-600">Copied!</span>';
                    setTimeout(function() { btn.innerHTML = orig; }, 2000);
                }
            });
        });
    }
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', initShare);
    else initShare();
})();
</script>
