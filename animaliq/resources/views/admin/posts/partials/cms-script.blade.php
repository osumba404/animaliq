<style>
.cms-editor.cms-placeholder::before { content: attr(data-placeholder); color: var(--text-secondary); pointer-events: none; }
.cms-editor { outline: none; }
.cms-editor h1 { font-size: 1.5rem; font-weight: 700; margin: 0.5em 0; }
.cms-editor h2 { font-size: 1.25rem; font-weight: 700; margin: 0.5em 0; }
.cms-editor h3 { font-size: 1.125rem; font-weight: 600; margin: 0.5em 0; }
.cms-editor h4 { font-size: 1rem; font-weight: 600; margin: 0.5em 0; }
.cms-editor blockquote { border-left: 4px solid var(--accent-orange); padding-left: 1rem; margin: 0.5em 0; color: var(--text-secondary); }
.cms-editor ul, .cms-editor ol { margin: 0.5em 0; padding-left: 1.5rem; }
.cms-editor hr { border: none; border-top: 1px solid var(--border-color); margin: 0.75em 0; }
.cms-editor img { max-width: 100%; height: auto; display: block; margin: 0.5em 0; }
</style>
<script>
(function () {
    var editor = document.getElementById('post-content-editor');
    var hiddenInput = document.getElementById('post-content');
    var titleInput = document.getElementById('post-title');
    var slugInput = document.getElementById('post-slug');
    var form = document.getElementById('post-form');
    if (!editor || !hiddenInput || !form) return;

    var savedSelection = null;

    function saveSelection() {
        var sel = window.getSelection();
        if (!sel.rangeCount || !editor.contains(sel.anchorNode)) return;
        try {
            savedSelection = sel.getRangeAt(0).cloneRange();
        } catch (e) {}
    }
    function restoreSelection() {
        if (!savedSelection) return;
        try {
            var sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(savedSelection);
        } catch (e) {}
    }
    editor.addEventListener('mouseup', saveSelection);
    editor.addEventListener('keyup', saveSelection);
    document.getElementById('cms-toolbar-wrap').addEventListener('mouseenter', saveSelection);

    function syncToHidden() {
        hiddenInput.value = editor.innerHTML || '';
        updateCounters();
    }

    function updateCounters() {
        var html = (editor && editor.innerHTML) || '';
        var text = (editor && (editor.innerText || editor.textContent)) || '';
        var words = text.trim() ? text.trim().split(/\s+/).length : 0;
        var wordsEl = document.getElementById('cms-words');
        var charsEl = document.getElementById('cms-chars');
        var tagsEl = document.getElementById('cms-tags');
        if (wordsEl) wordsEl.textContent = 'Words: ' + words;
        if (charsEl) charsEl.textContent = 'Characters: ' + text.length;
        var tags = {};
        var tagList = ['h1','h2','h3','h4','h5','h6','p','strong','em','b','i','ul','ol','li','a','blockquote','hr','div','span','img'];
        tagList.forEach(function(t) {
            var re = new RegExp('<'+t+'[\\s>]', 'gi');
            var m = html.match(re);
            tags[t] = m ? m.length : 0;
        });
        var used = Object.keys(tags).filter(function(k) { return tags[k] > 0; }).map(function(k) { return k + ':' + tags[k]; });
        if (tagsEl) tagsEl.textContent = 'Tags: ' + (used.length ? used.join(', ') : '—');
    }

    function runCommand(cmd, value) {
        editor.focus();
        if (savedSelection) restoreSelection();
        if (cmd === 'createLink' && value === 'prompt') {
            var url = prompt('Enter URL:');
            if (url !== null) document.execCommand('createLink', false, url || '');
        } else if (value) {
            document.execCommand(cmd, false, value);
        } else {
            document.execCommand(cmd, false, null);
        }
        syncToHidden();
    }

    document.querySelectorAll('.cms-cmd').forEach(function(btn) {
        btn.addEventListener('mousedown', function(e) {
            e.preventDefault();
            var cmd = this.getAttribute('data-cmd');
            var value = this.getAttribute('data-value') || '';
            if (this.getAttribute('data-prompt') === 'true' && cmd === 'createLink') value = 'prompt';
            runCommand(cmd, value);
        });
    });

    var imageInput = document.getElementById('cms-image-input');
    var uploadUrl = form.getAttribute('data-upload-url');
    if (imageInput && uploadUrl) {
        document.querySelector('.cms-insert-image').addEventListener('click', function() { imageInput.click(); });
        imageInput.addEventListener('change', function() {
            var file = this.files[0];
            if (!file) return;
            editor.focus();
            restoreSelection();
            var fd = new FormData();
            fd.append('image', file);
            fd.append('_token', form.querySelector('input[name="_token"]').value);
            var btn = document.querySelector('.cms-insert-image');
            var origText = btn.textContent;
            btn.textContent = 'Uploading…';
            btn.disabled = true;
            fetch(uploadUrl, { method: 'POST', body: fd, headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    if (data.url) document.execCommand('insertImage', false, data.url);
                    syncToHidden();
                })
                .catch(function() { alert('Image upload failed.'); })
                .finally(function() { btn.textContent = origText; btn.disabled = false; imageInput.value = ''; });
        });
    }

    editor.addEventListener('input', syncToHidden);
    editor.addEventListener('paste', function() { setTimeout(syncToHidden, 0); });
    editor.addEventListener('blur', syncToHidden);
    form.addEventListener('submit', function() { syncToHidden(); });

    syncToHidden();
    updateCounters();

    if (titleInput && slugInput) {
        var slugLock = false;
        titleInput.addEventListener('input', function() {
            if (slugLock) return;
            var s = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
            slugInput.placeholder = s || 'url-friendly-slug';
        });
        slugInput.addEventListener('input', function() { slugLock = !!this.value; });
    }

    if (editor.getAttribute('data-placeholder')) {
        editor.addEventListener('focus', function() { this.classList.remove('cms-placeholder'); });
        editor.addEventListener('blur', function() {
            if (!this.innerText || !this.innerText.trim()) this.classList.add('cms-placeholder');
        });
        if (!editor.innerText || !editor.innerText.trim()) editor.classList.add('cms-placeholder');
    }
})();
</script>
