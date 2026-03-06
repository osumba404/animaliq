{{-- Site-wide animations. Include after theme. Respects prefers-reduced-motion. --}}
<style>
    :root {
        --anim-duration: 0.4s;
        --anim-duration-slow: 0.6s;
        --anim-ease: cubic-bezier(0.25, 0.46, 0.45, 0.94);
        --anim-ease-out: cubic-bezier(0.33, 1, 0.68, 1);
    }
    @media (prefers-reduced-motion: reduce) {
        :root { --anim-duration: 0.01s; --anim-duration-slow: 0.01s; }
        *, *::before, *::after { animation-duration: 0.01s !important; transition-duration: 0.01s !important; }
    }
    @keyframes ani-fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes ani-fade-in-up {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes ani-fade-in-down {
        from { opacity: 0; transform: translateY(-12px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes ani-scale-in {
        from { opacity: 0; transform: scale(0.96); }
        to { opacity: 1; transform: scale(1); }
    }
    @keyframes ani-slide-in-right {
        from { opacity: 0; transform: translateX(16px); }
        to { opacity: 1; transform: translateX(0); }
    }
    .animate-once { animation-fill-mode: both; }
    .animate-fade-in { animation: ani-fade-in var(--anim-duration) var(--anim-ease) forwards; }
    .animate-fade-in-up { animation: ani-fade-in-up var(--anim-duration) var(--anim-ease) forwards; }
    .animate-fade-in-down { animation: ani-fade-in-down var(--anim-duration) var(--anim-ease) forwards; }
    .animate-scale-in { animation: ani-scale-in var(--anim-duration) var(--anim-ease) forwards; }
    .animate-slide-in-right { animation: ani-slide-in-right var(--anim-duration) var(--anim-ease) forwards; }
    .animate-slow { animation-duration: var(--anim-duration-slow) !important; }
    .animate-delay-1 { animation-delay: 0.08s; }
    .animate-delay-2 { animation-delay: 0.16s; }
    .animate-delay-3 { animation-delay: 0.24s; }
    .animate-delay-4 { animation-delay: 0.32s; }
    .animate-delay-5 { animation-delay: 0.4s; }
    .animate-delay-6 { animation-delay: 0.48s; }
    .hover-lift { transition: transform var(--anim-duration) var(--anim-ease), box-shadow var(--anim-duration) var(--anim-ease); }
    .hover-lift:hover { transform: translateY(-4px); box-shadow: 0 12px 24px var(--shadow); }
    .theme-btn { transition: transform 0.2s var(--anim-ease), box-shadow 0.2s var(--anim-ease), filter 0.2s ease; }
    .theme-btn:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(255, 117, 24, 0.35); }
    .theme-btn:active { transform: translateY(0); }
    .theme-btn-outline { transition: transform 0.2s var(--anim-ease), background 0.2s ease, color 0.2s ease, border-color 0.2s ease; }
    .theme-btn-outline:hover { transform: translateY(-1px); }
    .theme-btn-outline:active { transform: translateY(0); }
    .theme-nav-link { transition: color 0.2s ease; }
    .theme-link { transition: color 0.2s ease; }
    .theme-card { transition: box-shadow var(--anim-duration) var(--anim-ease), transform var(--anim-duration) var(--anim-ease); }
    .theme-card:hover { box-shadow: 0 10px 20px var(--shadow); }
    .hero-slide .relative.z-20 h1 { animation: ani-fade-in-up 0.7s var(--anim-ease) 0.2s both; }
    .hero-slide .relative.z-20 p { animation: ani-fade-in-up 0.7s var(--anim-ease) 0.35s both; }
    .hero-slide .relative.z-20 .flex.gap-3 { animation: ani-fade-in-up 0.7s var(--anim-ease) 0.5s both; }
    .logo-brand { transition: opacity 0.25s ease, transform 0.25s var(--anim-ease); }
    .logo-brand:hover { opacity: 0.9; transform: scale(1.02); }
    .stagger-children > * { opacity: 0; animation: ani-fade-in-up var(--anim-duration) var(--anim-ease) forwards; }
    .stagger-children > *:nth-child(1) { animation-delay: 0.05s; }
    .stagger-children > *:nth-child(2) { animation-delay: 0.12s; }
    .stagger-children > *:nth-child(3) { animation-delay: 0.19s; }
    .stagger-children > *:nth-child(4) { animation-delay: 0.26s; }
    .stagger-children > *:nth-child(5) { animation-delay: 0.33s; }
    .stagger-children > *:nth-child(6) { animation-delay: 0.4s; }
    .stagger-children > *:nth-child(7) { animation-delay: 0.47s; }
    .stagger-children > *:nth-child(8) { animation-delay: 0.54s; }
    .stagger-children > *:nth-child(9) { animation-delay: 0.61s; }
    .img-zoom { overflow: hidden; }
    .img-zoom img { transition: transform 0.5s var(--anim-ease); }
    .img-zoom:hover img { transform: scale(1.08); }
    .main-enter { animation: ani-fade-in-up var(--anim-duration-slow) var(--anim-ease) 0.1s both; }
    .footer-enter { animation: ani-fade-in var(--anim-duration-slow) var(--anim-ease) 0.2s both; }
</style>
