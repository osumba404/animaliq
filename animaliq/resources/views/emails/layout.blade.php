<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>{{ $subject ?? 'Animal IQ' }}</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { background-color: #111111; font-family: 'Inter', Arial, sans-serif; color: #2C2C2C; -webkit-font-smoothing: antialiased; }
  .wrapper { background-color: #111111; padding: 40px 16px; }
  .container { max-width: 600px; margin: 0 auto; }

  /* Header */
  .header { background: linear-gradient(135deg, #1a1a1a 0%, #2a1500 50%, #1a1a1a 100%); border-radius: 16px 16px 0 0; padding: 36px 40px 28px; text-align: center; border-bottom: 3px solid #FF7518; position: relative; overflow: hidden; }
  .header::before { content: ''; position: absolute; top: -40px; right: -40px; width: 180px; height: 180px; background: radial-gradient(circle, rgba(255,117,24,0.18) 0%, transparent 70%); border-radius: 50%; }
  .header::after { content: ''; position: absolute; bottom: -30px; left: -30px; width: 140px; height: 140px; background: radial-gradient(circle, rgba(255,117,24,0.12) 0%, transparent 70%); border-radius: 50%; }
  .logo-wrap { display: inline-flex; align-items: center; gap: 10px; margin-bottom: 6px; }
  .logo-icon { width: 42px; height: 42px; background: linear-gradient(135deg, #FF7518, #CC5500); border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; }
  .logo-icon svg { width: 24px; height: 24px; color: #fff; }
  .logo-text { font-size: 26px; font-weight: 800; color: #ffffff; letter-spacing: -0.5px; }
  .header-tagline { color: #999; font-size: 12px; letter-spacing: 2px; text-transform: uppercase; margin-top: 4px; }

  /* Badge */
  .badge-wrap { text-align: center; margin: -14px 0 0; }
  .badge { display: inline-block; background: linear-gradient(135deg, #FF7518, #CC5500); color: #fff; font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; padding: 5px 18px; border-radius: 20px; box-shadow: 0 4px 12px rgba(255,117,24,0.4); }

  /* Body */
  .body { background: #ffffff; padding: 40px 40px 32px; }
  .greeting { font-size: 22px; font-weight: 700; color: #1a1a1a; margin-bottom: 8px; }
  .intro { font-size: 15px; color: #555; line-height: 1.7; margin-bottom: 28px; }

  /* Content card */
  .content-card { background: #fdfbf9; border: 1px solid #eaeaea; border-radius: 12px; padding: 28px 32px; margin-bottom: 28px; }
  .content-type { font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: #FF7518; margin-bottom: 8px; }
  .content-title { font-size: 20px; font-weight: 800; color: #1a1a1a; line-height: 1.3; margin-bottom: 16px; }
  .content-meta { margin-bottom: 20px; background: #ffffff; padding: 18px; border-radius: 8px; border: 1px solid #f0f0f0; box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
  .meta-item { font-size: 14px; color: #444; font-weight: 500; margin-bottom: 10px; display: block; line-height: 1.4; }
  .meta-item:last-child { margin-bottom: 0; }
  .meta-dot { width: 6px; height: 6px; background: #FF7518; border-radius: 50%; display: inline-block; vertical-align: middle; margin-right: 10px; margin-top: -2px; }
  .content-excerpt { font-size: 14px; color: #555; line-height: 1.7; }

  /* CTA */
  .cta-wrap { text-align: center; margin-bottom: 32px; }
  .cta-btn { display: inline-block; background: linear-gradient(135deg, #FF7518, #CC5500); color: #ffffff !important; text-decoration: none; font-size: 15px; font-weight: 700; padding: 14px 36px; border-radius: 50px; box-shadow: 0 6px 20px rgba(255,117,24,0.35); letter-spacing: 0.3px; }

  /* Divider */
  .divider { border: none; border-top: 1px solid #F0E8E0; margin: 28px 0; }

  /* Why section */
  .why { font-size: 13px; color: #999; line-height: 1.6; text-align: center; }

  /* Footer */
  .footer { background: #1a1a1a; border-radius: 0 0 16px 16px; padding: 28px 40px; text-align: center; }
  .footer-logo { font-size: 18px; font-weight: 800; background: linear-gradient(135deg, #FFB347, #FF7518); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 10px; }
  .footer-links { margin-bottom: 14px; }
  .footer-links a { color: #FF7518; text-decoration: none; font-size: 13px; margin: 0 10px; }
  .footer-copy { font-size: 12px; color: #555; line-height: 1.6; }
  .footer-copy a { color: #777; text-decoration: underline; }

  /* Accent strip */
  .accent-strip { height: 4px; background: linear-gradient(90deg, #FF7518, #FFB347, #CC5500, #FF7518); background-size: 200% 100%; border-radius: 0 0 4px 4px; }

  @media (max-width: 480px) {
    .header, .body, .footer { padding-left: 24px; padding-right: 24px; }
    .content-card { padding: 18px 20px; }
    .greeting { font-size: 19px; }
    .content-title { font-size: 17px; }
  }
</style>
</head>
<body>
<div class="wrapper">
  <div class="container">

    <!-- Header -->
    <div class="header">
      <div class="logo-wrap">
        @php $emailLogo = \App\Models\SiteSetting::getByKey('site_logo'); @endphp
        @if($emailLogo)
            <img src="{{ url('storage/' . $emailLogo) }}" alt="Animal IQ Logo" style="height: 42px; width: 42px; object-fit: cover; border-radius: 50%;">
        @else
            <span class="logo-icon"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg></span>
        @endif
        <span class="logo-text">Animal IQ</span>
      </div>
      <div class="header-tagline">Wildlife &amp; Environmental Education</div>
    </div>

    <!-- Badge -->
    <div class="badge-wrap">
      <span class="badge">{{ $badgeLabel ?? 'New Update' }}</span>
    </div>

    <!-- Body -->
    <div class="body">
      <div class="greeting">Hi {{ $recipientName ?? 'there' }},</div>
      <p class="intro">{{ $introText ?? 'We have something new and exciting to share with you from the Animal IQ community.' }}</p>

      <!-- Content card -->
      <div class="content-card">
        <div class="content-type">{{ $contentType ?? 'Update' }}</div>
        <div class="content-title">{{ $contentTitle }}</div>
        @if(!empty($metaItems))
          <div class="content-meta">
            @foreach($metaItems as $item)
              <span class="meta-item"><span class="meta-dot"></span>{{ $item }}</span>
            @endforeach
          </div>
        @endif
        @if(!empty($excerpt))
          <div class="content-excerpt">{{ $excerpt }}</div>
        @endif
      </div>

      <!-- CTA -->
      @if(!empty($ctaUrl) && !empty($ctaLabel))
        <div class="cta-wrap">
          <a href="{{ $ctaUrl }}" class="cta-btn">{{ $ctaLabel }} &rarr;</a>
        </div>
      @endif

      <hr class="divider">

      <p class="why">You're receiving this because you're a member of the Animal IQ community.<br>
        We send updates whenever new content is published on our platform.
      </p>
    </div>

    <!-- Footer -->
    <div class="footer">
      <div class="footer-logo">Animal IQ</div>
      <div class="footer-links">
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ url('/programs') }}">Programs</a>
        <a href="{{ url('/events') }}">Events</a>
        <a href="{{ url('/blog') }}">Blog</a>
        <a href="{{ url('/research') }}">Research</a>
      </div>
      <div class="footer-copy">
        &copy; {{ date('Y') }} Animal IQ. All rights reserved.<br>
        <span style="color:#444;">Educating, engaging, and empowering communities for wildlife conservation.</span>
      </div>
    </div>

    <!-- Accent strip -->
    <div class="accent-strip"></div>

  </div>
</div>
</body>
</html>
