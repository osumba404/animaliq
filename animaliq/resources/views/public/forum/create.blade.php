@extends('layouts.public')

@section('title', 'New Discussion – Animal IQ Initiative')

@section('content')
    <section class="theme-bg-warm border-b theme-border -mx-4 px-4 py-10 md:py-14 mb-8">
        <div class="max-w-2xl mx-auto">
            <nav class="text-sm mb-3">
                <ol class="flex items-center gap-1 theme-text-secondary">
                    <li><a href="{{ route('forum.index') }}" class="hover:underline">Forum</a> <span class="opacity-40">›</span></li>
                    <li class="theme-text-primary font-medium">New Discussion</li>
                </ol>
            </nav>
            <p class="text-sm font-semibold tracking-wider uppercase theme-accent mb-2">Community</p>
            <h1 class="text-3xl md:text-4xl font-bold theme-text-primary">Start a Discussion</h1>
            <div class="mt-4 accent-bar"></div>
        </div>
    </section>

    <div class="max-w-2xl mx-auto">
        @if($errors->any())
        <div class="mb-6 p-4 rounded-xl theme-alert-error text-sm space-y-1">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('forum.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Title --}}
            <div>
                <label class="block text-sm font-semibold theme-text-primary mb-1.5" for="title">Title <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required maxlength="255"
                    placeholder="What's your discussion about?"
                    class="theme-input w-full text-base @error('title') border-red-500 @enderror">
                @error('title')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Body --}}
            <div>
                <label class="block text-sm font-semibold theme-text-primary mb-1.5" for="body">Your thoughts <span class="text-red-500">*</span></label>
                <textarea id="body" name="body" rows="10" required minlength="10" maxlength="10000"
                    placeholder="Share details, ask a question, start a debate…"
                    class="theme-input w-full resize-y @error('body') border-red-500 @enderror">{{ old('body') }}</textarea>
                <div class="flex justify-between mt-1">
                    @error('body')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                    <span class="text-xs theme-text-secondary ml-auto" id="body-count">0 / 10,000</span>
                </div>
            </div>

            {{-- Image --}}
            <div>
                <label class="block text-sm font-semibold theme-text-primary mb-1.5" for="image">Image <span class="text-xs font-normal theme-text-secondary">(optional, max 2 MB)</span></label>
                <div class="border-2 border-dashed theme-border rounded-xl p-6 text-center cursor-pointer hover:border-[var(--accent-orange)] transition" id="image-drop-zone">
                    <input type="file" name="image" id="image" accept="image/*" class="hidden" onchange="previewImage(this)">
                    <div id="image-placeholder">
                        <svg class="w-8 h-8 mx-auto mb-2 theme-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="text-sm theme-text-secondary">Click to upload an image</p>
                        <p class="text-xs theme-text-secondary opacity-70 mt-1">PNG, JPG, WebP, GIF</p>
                    </div>
                    <img id="image-preview" src="" alt="Preview" class="hidden max-h-48 mx-auto rounded-lg object-contain">
                    <button type="button" id="image-remove" class="hidden mt-2 text-xs text-red-500 hover:underline" onclick="removeImage()">Remove</button>
                </div>
                @error('image')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="theme-btn px-8">Post Discussion</button>
                <a href="{{ route('forum.index') }}" class="text-sm theme-text-secondary hover:underline">Cancel</a>
            </div>
        </form>
    </div>

@push('scripts')
<script>
(function() {
    var bodyEl = document.getElementById('body');
    var countEl = document.getElementById('body-count');
    function updateCount() {
        countEl.textContent = bodyEl.value.length.toLocaleString() + ' / 10,000';
    }
    bodyEl.addEventListener('input', updateCount);
    updateCount();

    var dropZone = document.getElementById('image-drop-zone');
    dropZone.addEventListener('click', function(e) {
        if (e.target.id !== 'image-remove') document.getElementById('image').click();
    });
    dropZone.addEventListener('dragover', function(e) { e.preventDefault(); dropZone.classList.add('border-[var(--accent-orange)]'); });
    dropZone.addEventListener('dragleave', function() { dropZone.classList.remove('border-[var(--accent-orange)]'); });
    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        dropZone.classList.remove('border-[var(--accent-orange)]');
        var file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            var dt = new DataTransfer();
            dt.items.add(file);
            document.getElementById('image').files = dt.files;
            previewImage(document.getElementById('image'));
        }
    });
})();
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image-placeholder').classList.add('hidden');
            var preview = document.getElementById('image-preview');
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            document.getElementById('image-remove').classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function removeImage() {
    document.getElementById('image').value = '';
    document.getElementById('image-preview').classList.add('hidden');
    document.getElementById('image-remove').classList.add('hidden');
    document.getElementById('image-placeholder').classList.remove('hidden');
}
</script>
@endpush
@endsection
