{{-- Site-wide animations. Include after theme. Respects prefers-reduced-motion. --}}
<style>
    :root {
        --anim-duration: 0.45s;
        --anim-duration-slow: 0.7s;
        --anim-ease: cubic-bezier(0.25, 0.46, 0.45, 0.94);
        --anim-ease-out: cubic-bezier(0.16, 1, 0.3, 1);
        --anim-spring: cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    @media (prefers-reduced-motion: reduce) {
        :root { --anim-duration: 0.01s; --anim-duration-slow: 0.01s; }
        *, *::before, *::after { animation-duration: 0.01s !important; transition-duration: 0.01s !important; }
    }

    /* ── Keyframes ── */
    @keyframes ani-fade-in        { from { opacity:0 }                                    to { opacity:1 } }
    @keyframes ani-fade-in-up     { from { opacity:0; transform:translateY(28px) }        to { opacity:1; transform:translateY(0) } }
    @keyframes ani-fade-in-down   { from { opacity:0; transform:translateY(-16px) }       to { opacity:1; transform:translateY(0) } }
    @keyframes ani-fade-in-left   { from { opacity:0; transform:translateX(-28px) }       to { opacity:1; transform:translateX(0) } }
    @keyframes ani-fade-in-right  { from { opacity:0; transform:translateX(28px) }        to { opacity:1; transform:translateX(0) } }
    @keyframes ani-scale-in       { from { opacity:0; transform:scale(0.93) }             to { opacity:1; transform:scale(1) } }
    @keyframes ani-scale-in-spring{ from { opacity:0; transform:scale(0.88) }             to { opacity:1; transform:scale(1) } }
    @keyframes ani-slide-in-right { from { opacity:0; transform:translateX(20px) }        to { opacity:1; transform:translateX(0) } }
    @keyframes ani-float          { 0%,100% { transform:translateY(0) }  50% { transform:translateY(-8px) } }
    @keyframes ani-pulse-glow     { 0%,100% { box-shadow:0 0 0 0 rgba(255,117,24,0) }     60% { box-shadow:0 0 0 10px rgba(255,117,24,0.15) } }
    @keyframes ani-shimmer        { from { background-position:-200% center }             to   { background-position:200% center } }
    @keyframes ani-spin-slow      { from { transform:rotate(0deg) }                       to   { transform:rotate(360deg) } }
    @keyframes ani-bounce-in      { 0% { opacity:0; transform:scale(0.3) }  60% { opacity:1; transform:scale(1.08) }  80% { transform:scale(0.96) }  100% { transform:scale(1) } }
    @keyframes ani-draw-line      { from { transform:scaleX(0) }                          to   { transform:scaleX(1) } }
    @keyframes ani-count-up       { from { opacity:0; transform:translateY(12px) }        to   { opacity:1; transform:translateY(0) } }
    @keyframes ani-page-in        { from { opacity:0; transform:translateY(16px) }        to   { opacity:1; transform:translateY(0) } }

    /* ── Utility classes ── */
    .animate-fade-in        { animation: ani-fade-in        var(--anim-duration)      var(--anim-ease)     both }
    .animate-fade-in-up     { animation: ani-fade-in-up     var(--anim-duration)      var(--anim-ease-out) both }
    .animate-fade-in-down   { animation: ani-fade-in-down   var(--anim-duration)      var(--anim-ease-out) both }
    .animate-fade-in-left   { animation: ani-fade-in-left   var(--anim-duration)      var(--anim-ease-out) both }
    .animate-fade-in-right  { animation: ani-fade-in-right  var(--anim-duration)      var(--anim-ease-out) both }
    .animate-scale-in       { animation: ani-scale-in       var(--anim-duration)      var(--anim-ease)     both }
    .animate-scale-in-spring{ animation: ani-scale-in-spring 0.5s                    var(--anim-spring)   both }
    .animate-bounce-in      { animation: ani-bounce-in      0.6s                     var(--anim-ease)     both }
    .animate-float          { animation: ani-float          3s ease-in-out infinite }
    .animate-pulse-glow     { animation: ani-pulse-glow     2.5s ease-in-out infinite }
    .animate-spin-slow      { animation: ani-spin-slow      8s linear infinite }
    .animate-slow           { animation-duration: var(--anim-duration-slow) !important }
    .animate-delay-1        { animation-delay: 0.08s }
    .animate-delay-2        { animation-delay: 0.16s }
    .animate-delay-3        { animation-delay: 0.24s }
    .animate-delay-4        { animation-delay: 0.32s }
    .animate-delay-5        { animation-delay: 0.40s }
    .animate-delay-6        { animation-delay: 0.48s }
    .animate-delay-7        { animation-delay: 0.56s }
    .animate-delay-8        { animation-delay: 0.64s }

    /* ── Scroll-reveal (hidden until JS fires) ── */
    .reveal {
        opacity: 0;
        transform: translateY(32px);
        transition: opacity 0.65s var(--anim-ease-out), transform 0.65s var(--anim-ease-out);
    }
    .reveal.reveal--left  { transform: translateX(-32px) }
    .reveal.reveal--right { transform: translateX(32px) }
    .reveal.reveal--scale { transform: scale(0.93) }
    .reveal.reveal--none  { transform: none }
    .reveal.is-visible {
        opacity: 1 !important;
        transform: none !important;
    }
    .reveal-delay-1 { transition-delay: 0.08s }
    .reveal-delay-2 { transition-delay: 0.16s }
    .reveal-delay-3 { transition-delay: 0.24s }
    .reveal-delay-4 { transition-delay: 0.32s }
    .reveal-delay-5 { transition-delay: 0.40s }
    .reveal-delay-6 { transition-delay: 0.48s }

    /* ── Hover interactions ── */
    .hover-lift {
        transition: transform var(--anim-duration) var(--anim-ease),
                    box-shadow var(--anim-duration) var(--anim-ease);
    }
    .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 16px 32px var(--shadow) }
    .hover-lift:active { transform: translateY(-2px) }

    .hover-scale { transition: transform 0.25s var(--anim-spring) }
    .hover-scale:hover { transform: scale(1.04) }

    /* ── Buttons ── */
    .theme-btn {
        transition: transform 0.2s var(--anim-ease),
                    box-shadow 0.2s var(--anim-ease),
                    filter 0.2s ease;
    }
    .theme-btn:hover  { transform: translateY(-2px); box-shadow: 0 6px 18px rgba(255,117,24,0.4) }
    .theme-btn:active { transform: translateY(0);    box-shadow: 0 2px 6px  rgba(255,117,24,0.3) }
    .theme-btn-outline {
        transition: transform 0.2s var(--anim-ease),
                    background 0.2s ease,
                    color 0.2s ease,
                    border-color 0.2s ease;
    }
    .theme-btn-outline:hover  { transform: translateY(-2px) }
    .theme-btn-outline:active { transform: translateY(0) }

    /* ── Nav / links ── */
    .theme-nav-link { transition: color 0.2s ease }
    .theme-link     { transition: color 0.2s ease }
    .logo-brand     { transition: opacity 0.25s ease, transform 0.25s var(--anim-ease) }
    .logo-brand:hover { opacity: 0.9; transform: scale(1.03) }

    /* ── Cards ── */
    .theme-card {
        transition: box-shadow var(--anim-duration) var(--anim-ease),
                    transform  var(--anim-duration) var(--anim-ease);
    }
    .theme-card:hover { box-shadow: 0 12px 28px var(--shadow) }

    /* ── Image zoom ── */
    .img-zoom { overflow: hidden }
    .img-zoom img { transition: transform 0.55s var(--anim-ease) }
    .img-zoom:hover img { transform: scale(1.07) }

    /* ── Shimmer text ── */
    .shimmer-text {
        background: linear-gradient(90deg,
            var(--accent-orange) 0%,
            var(--orange-200)    40%,
            var(--accent-orange) 60%,
            var(--orange-600)    100%);
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: ani-shimmer 3s linear infinite;
    }

    /* ── Orange underline draw ── */
    .underline-draw {
        position: relative;
        display: inline-block;
    }
    .underline-draw::after {
        content: '';
        position: absolute;
        left: 0; bottom: -3px;
        width: 100%; height: 2px;
        background: var(--accent-orange);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.35s var(--anim-ease-out);
    }
    .underline-draw:hover::after { transform: scaleX(1) }

    /* ── Stagger children ── */
    .stagger-children > * {
        opacity: 0;
        animation: ani-fade-in-up var(--anim-duration) var(--anim-ease-out) both;
    }
    .stagger-children > *:nth-child(1) { animation-delay: 0.05s }
    .stagger-children > *:nth-child(2) { animation-delay: 0.13s }
    .stagger-children > *:nth-child(3) { animation-delay: 0.21s }
    .stagger-children > *:nth-child(4) { animation-delay: 0.29s }
    .stagger-children > *:nth-child(5) { animation-delay: 0.37s }
    .stagger-children > *:nth-child(6) { animation-delay: 0.45s }
    .stagger-children > *:nth-child(7) { animation-delay: 0.53s }
    .stagger-children > *:nth-child(8) { animation-delay: 0.61s }
    .stagger-children > *:nth-child(9) { animation-delay: 0.69s }

    /* ── Hero slide content ── */
    .hero-slide .relative.z-20 h1   { animation: ani-fade-in-up 0.8s var(--anim-ease-out) 0.15s both }
    .hero-slide .relative.z-20 p    { animation: ani-fade-in-up 0.8s var(--anim-ease-out) 0.30s both }
    .hero-slide .relative.z-20 .flex.gap-3 { animation: ani-fade-in-up 0.8s var(--anim-ease-out) 0.45s both }

    /* ── Page enter ── */
    .main-enter   { animation: ani-page-in var(--anim-duration-slow) var(--anim-ease-out) 0.05s both }
    .footer-enter { animation: ani-fade-in var(--anim-duration-slow) var(--anim-ease)     0.15s both }

    /* ── Stat counter ── */
    .stat-number { animation: ani-count-up 0.6s var(--anim-ease-out) both }

    /* ── Orange accent bar (section divider) ── */
    .accent-bar {
        height: 3px;
        width: 48px;
        background: linear-gradient(90deg, var(--accent-orange), var(--orange-400));
        border-radius: 99px;
        transform-origin: left;
        animation: ani-draw-line 0.5s var(--anim-ease-out) 0.3s both;
    }

    /* ── Input focus ring ── */
    .theme-input {
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .theme-input:focus {
        box-shadow: 0 0 0 3px rgba(255,117,24,0.18);
    }

    /* ── Notification item ── */
    .notification-item {
        transition: transform 0.2s var(--anim-ease), box-shadow 0.2s var(--anim-ease);
    }
    .notification-item:hover { transform: translateX(4px) }
</style>

<script>
/* Scroll-reveal via IntersectionObserver — runs on DOMContentLoaded */
(function () {
    function initReveal() {
        if (!('IntersectionObserver' in window)) {
            document.querySelectorAll('.reveal').forEach(function (el) {
                el.classList.add('is-visible');
            });
            return;
        }
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('.reveal').forEach(function (el) {
            io.observe(el);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initReveal);
    } else {
        initReveal();
    }
})();
</script>
