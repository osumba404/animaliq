<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Password Reset Code — Animal IQ</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { background-color: #111111; font-family: 'Inter', Arial, sans-serif; color: #2C2C2C; -webkit-font-smoothing: antialiased; }
  .wrapper { background-color: #111111; padding: 40px 16px; }
  .container { max-width: 600px; margin: 0 auto; }
  .header { background: linear-gradient(135deg, #1a1a1a 0%, #2a1500 50%, #1a1a1a 100%); border-radius: 16px 16px 0 0; padding: 36px 40px 28px; text-align: center; border-bottom: 3px solid #FF7518; }
  .logo-wrap { display: inline-flex; align-items: center; gap: 10px; margin-bottom: 6px; }
  .logo-icon { width: 42px; height: 42px; background: linear-gradient(135deg, #FF7518, #CC5500); border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; }
  .logo-text { font-size: 26px; font-weight: 800; color: #ffffff; letter-spacing: -0.5px; }
  .header-tagline { color: #999; font-size: 12px; letter-spacing: 2px; text-transform: uppercase; margin-top: 4px; }
  .badge-wrap { text-align: center; margin: -14px 0 0; }
  .badge { display: inline-block; background: linear-gradient(135deg, #FF7518, #CC5500); color: #fff; font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; padding: 5px 18px; border-radius: 20px; box-shadow: 0 4px 12px rgba(255,117,24,0.4); }
  .body { background: #ffffff; padding: 40px 40px 32px; }
  .greeting { font-size: 22px; font-weight: 700; color: #1a1a1a; margin-bottom: 8px; }
  .intro { font-size: 15px; color: #555; line-height: 1.7; margin-bottom: 28px; }
  .otp-card { background: #fdfbf9; border: 1px solid #eaeaea; border-radius: 12px; padding: 32px; margin-bottom: 28px; text-align: center; }
  .otp-label { font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: #FF7518; margin-bottom: 16px; }
  .otp-code { font-size: 56px; font-weight: 800; color: #1a1a1a; letter-spacing: 12px; line-height: 1; margin-bottom: 16px; font-variant-numeric: tabular-nums; }
  .otp-expires { font-size: 13px; color: #999; }
  .warning { background: #fffbf0; border: 1px solid #ffe4a0; border-radius: 8px; padding: 14px 18px; margin-bottom: 28px; font-size: 13px; color: #7a5800; line-height: 1.6; }
  .divider { border: none; border-top: 1px solid #F0E8E0; margin: 28px 0; }
  .why { font-size: 13px; color: #999; line-height: 1.6; text-align: center; }
  .footer { background: #1a1a1a; border-radius: 0 0 16px 16px; padding: 28px 40px; text-align: center; }
  .footer-logo { font-size: 18px; font-weight: 800; background: linear-gradient(135deg, #FFB347, #FF7518); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 10px; }
  .footer-copy { font-size: 12px; color: #555; line-height: 1.6; }
  .accent-strip { height: 4px; background: linear-gradient(90deg, #FF7518, #FFB347, #CC5500, #FF7518); border-radius: 0 0 4px 4px; }
  @media (max-width: 480px) {
    .header, .body, .footer { padding-left: 24px; padding-right: 24px; }
    .otp-code { font-size: 40px; letter-spacing: 8px; }
  }
</style>
</head>
<body>
<div class="wrapper">
  <div class="container">
    <div class="header">
      <div class="logo-wrap">
        @php $emailLogo = \App\Models\SiteSetting::getByKey('site_logo'); @endphp
        @if($emailLogo)
          <img src="{{ url('storage/' . $emailLogo) }}" alt="Animal IQ Logo" style="height: 42px; width: 42px; object-fit: cover; border-radius: 50%;">
        @else
          <span class="logo-icon"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="24" height="24"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg></span>
        @endif
        <span class="logo-text">Animal IQ</span>
      </div>
      <div class="header-tagline">Wildlife &amp; Environmental Education</div>
    </div>

    <div class="badge-wrap">
      <span class="badge">Password Reset</span>
    </div>

    <div class="body">
      <div class="greeting">Password Reset Request</div>
      <p class="intro">We received a request to reset the password for your Animal IQ account. Use the code below to continue. If you did not request this, you can safely ignore this email.</p>

      <div class="otp-card">
        <div class="otp-label">Your One-Time Code</div>
        <div class="otp-code">{{ $otp }}</div>
        <div class="otp-expires">This code expires in <strong>10 minutes</strong>.</div>
      </div>

      <div class="warning">
        <strong>Security tip:</strong> Animal IQ staff will never ask for this code. Do not share it with anyone.
      </div>

      <hr class="divider">

      <p class="why">You're receiving this because a password reset was requested for your account.<br>
        If you didn't make this request, no action is needed.
      </p>
    </div>

    <div class="footer">
      <div class="footer-logo">Animal IQ</div>
      <div class="footer-copy">
        &copy; {{ date('Y') }} Animal IQ. All rights reserved.<br>
        <span style="color:#444;">Educating, engaging, and empowering communities for wildlife conservation.</span>
      </div>
    </div>

    <div class="accent-strip"></div>
  </div>
</div>
</body>
</html>
