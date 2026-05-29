<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $subject ?? 'Four Square Design' }}</title>
<style>
    body { margin: 0; padding: 0; background: #f8fafc; font-family: 'Inter', Arial, sans-serif; color: #020617; }
    .wrapper { max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.07); }
    .header { background: #020617; padding: 28px 40px; text-align: center; }
    .header img { height: 40px; }
    .header-brand { color: #fab133; font-size: 1.4rem; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; }
    .header-tagline { color: #94a3b8; font-size: 0.78rem; margin-top: 4px; letter-spacing: 2px; text-transform: uppercase; }
    .banner { background: #fab133; height: 4px; }
    .body { padding: 40px; }
    .greeting { font-size: 1.15rem; font-weight: 700; color: #020617; margin-bottom: 12px; }
    .message { font-size: 0.95rem; color: #334155; line-height: 1.7; margin-bottom: 24px; }
    .info-box { background: #f8fafc; border-left: 4px solid #fab133; border-radius: 8px; padding: 20px 24px; margin-bottom: 28px; }
    .info-row { display: flex; gap: 8px; margin-bottom: 8px; font-size: 0.9rem; }
    .info-row:last-child { margin-bottom: 0; }
    .info-label { font-weight: 700; color: #020617; min-width: 140px; flex-shrink: 0; }
    .info-value { color: #475569; }
    .btn { display: inline-block; background: #fab133; color: #020617 !important; font-weight: 800; font-size: 0.9rem; padding: 14px 32px; border-radius: 8px; text-decoration: none; letter-spacing: 0.5px; text-transform: uppercase; margin-bottom: 28px; }
    .divider { border: none; border-top: 1px solid #e2e8f0; margin: 28px 0; }
    .footer { background: #f1f5f9; padding: 24px 40px; text-align: center; font-size: 0.78rem; color: #94a3b8; line-height: 1.6; }
    .footer a { color: #fab133; text-decoration: none; }
    @media (max-width: 600px) {
        .body { padding: 24px 20px; }
        .info-row { flex-direction: column; gap: 2px; }
    }
</style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <div class="header-brand">Four Square Design</div>
        <div class="header-tagline">Design Portal Notification</div>
    </div>
    <div class="banner"></div>
    <div class="body">
        @yield('email-body')
    </div>
    <div class="footer">
        <p>© {{ date('Y') }} Four Square Design. All rights reserved.</p>
        <p style="margin-top: 6px;">This is an automated notification from the Four Square Design Portal.</p>
        <p style="margin-top: 6px;"><a href="{{ url('/portal/dashboard') }}">Visit Portal</a></p>
    </div>
</div>
</body>
</html>
