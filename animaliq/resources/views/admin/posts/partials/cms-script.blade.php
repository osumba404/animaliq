<script>
(function () {
    var textarea = document.getElementById('post-content');
    var titleInput = document.getElementById('post-title');
    var slugInput = document.getElementById('post-slug');
    if (!textarea) return;

    function getCaret(el) {
        var start = 0, end = 0;
        if (typeof el.selectionStart !== 'undefined') {
            start = el.selectionStart;
            end = el.selectionEnd;
        }
        return { start: start, end: end };
    }
    function setCaret(el, start, end) {
        el.focus();
        if (typeof el.setSelectionRange !== 'undefined') {
            el.setSelectionRange(start, end);
        }
    }
    function insertAtCursor(openTag, closeTag) {
        var val = textarea.value;
        var care = getCaret(textarea);
        var before = val.slice(0, care.start);
        var selected = val.slice(care.start, care.end);
        var after = val.slice(care.end);
        var newText = before + openTag + (selected || '') + (closeTag || '') + after;
        textarea.value = newText;
        var newPos = care.start + openTag.length + (selected ? selected.length : 0) + (closeTag ? closeTag.length : 0);
        setCaret(textarea, newPos, newPos);
        updateCounters();
    }

    function updateCounters() {
        var text = (textarea && textarea.value) || '';
        var words = text.trim() ? text.trim().split(/\s+/).length : 0;
        document.getElementById('cms-words').textContent = 'Words: ' + words;
        document.getElementById('cms-chars').textContent = 'Characters: ' + text.length;

        var tags = {};
        var tagList = ['h1','h2','h3','h4','h5','h6','p','strong','em','b','i','ul','ol','li','a','blockquote','hr','div','span','img'];
        tagList.forEach(function(t) {
            var re = new RegExp('<'+t+'[\\s>]', 'gi');
            var m = text.match(re);
            tags[t] = m ? m.length : 0;
        });
        var used = Object.keys(tags).filter(function(k) { return tags[k] > 0; }).map(function(k) { return k + ':' + tags[k]; });
        document.getElementById('cms-tags').textContent = 'Tags: ' + (used.length ? used.join(', ') : '—');
    }

    document.querySelectorAll('.cms-insert').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var openTag = this.getAttribute('data-open') || '';
            var closeTag = this.getAttribute('data-close') || '';
            insertAtCursor(openTag, closeTag);
        });
    });

    if (textarea) {
        textarea.addEventListener('input', updateCounters);
        textarea.addEventListener('keyup', updateCounters);
        updateCounters();
    }

    if (titleInput && slugInput) {
        var slugLock = false;
        titleInput.addEventListener('input', function() {
            if (slugLock) return;
            var s = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
            slugInput.placeholder = s || 'url-friendly-slug';
        });
        slugInput.addEventListener('input', function() { slugLock = !!this.value; });
    }
})();
</script>
