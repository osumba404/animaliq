@props([
    'url' => url()->current(),
    'title' => $shareTitle ?? (isset($title) ? (is_string($title) ? $title : '') : ''),
    'text' => $shareText ?? '',
    'id' => 'share-' . bin2hex(random_bytes(4)),
])
@php
    $fullUrl = str_starts_with($url, 'http') ? $url : url($url);
    $encodedUrl = rawurlencode($fullUrl);
    $encodedTitle = rawurlencode($title ?: config('app.name'));
    $encodedText = rawurlencode($text ?: $title ?: '');
@endphp
<div class="inline-block share-wrap" data-share-id="{{ $id }}">
    <button type="button" class="share-trigger inline-flex items-center gap-2 px-3 py-2 rounded-lg theme-bg-secondary theme-text-primary border theme-border hover:opacity-90 transition text-sm font-medium" aria-label="Share" aria-haspopup="dialog" data-share-id="{{ $id }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
        <span>Share</span>
    </button>
    <div class="share-modal fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50" role="dialog" aria-modal="true" aria-label="Share options" data-share-modal="{{ $id }}">
        <div class="theme-card rounded-2xl p-6 max-w-sm w-full shadow-xl share-modal-inner">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold theme-text-primary">Share</h3>
                <button type="button" class="share-close p-1 rounded theme-text-secondary hover:theme-bg-warm text-2xl leading-none" aria-label="Close" data-share-id="{{ $id }}">&times;</button>
            </div>
            <div class="space-y-3">
                <button type="button" data-share-copy="{{ $fullUrl }}" class="share-copy w-full flex items-center gap-3 px-4 py-3 rounded-xl theme-bg-secondary theme-text-primary hover:opacity-90 transition text-left">
                    <span class="flex-shrink-0 w-10 h-10 rounded-full theme-bg-warm flex items-center justify-center">
                        <svg class="w-5 h-5 theme-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </span>
                    <span class="font-medium">Copy link</span>
                </button>
                <a href="https://twitter.com/intent/tweet?url={{ $encodedUrl }}&text={{ $encodedTitle }}" target="_blank" rel="noopener noreferrer" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl theme-bg-secondary theme-text-primary hover:opacity-90 transition text-left">
                    <span class="flex-shrink-0 w-10 h-10 rounded-full bg-[#1DA1F2]/20 flex items-center justify-center"><svg class="w-5 h-5" fill="#1DA1F2" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></span>
                    <span class="font-medium">X (Twitter)</span>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $encodedUrl }}" target="_blank" rel="noopener noreferrer" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl theme-bg-secondary theme-text-primary hover:opacity-90 transition text-left">
                    <span class="flex-shrink-0 w-10 h-10 rounded-full bg-[#1877F2]/20 flex items-center justify-center"><svg class="w-5 h-5" fill="#1877F2" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></span>
                    <span class="font-medium">Facebook</span>
                </a>
                <a href="https://wa.me/?text={{ $encodedTitle }}%20{{ $encodedUrl }}" target="_blank" rel="noopener noreferrer" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl theme-bg-secondary theme-text-primary hover:opacity-90 transition text-left">
                    <span class="flex-shrink-0 w-10 h-10 rounded-full bg-[#25D366]/20 flex items-center justify-center"><svg class="w-5 h-5" fill="#25D366" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg></span>
                    <span class="font-medium">WhatsApp</span>
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $encodedUrl }}" target="_blank" rel="noopener noreferrer" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl theme-bg-secondary theme-text-primary hover:opacity-90 transition text-left">
                    <span class="flex-shrink-0 w-10 h-10 rounded-full bg-[#0A66C2]/20 flex items-center justify-center"><svg class="w-5 h-5" fill="#0A66C2" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></span>
                    <span class="font-medium">LinkedIn</span>
                </a>
            </div>
        </div>
    </div>
</div>
