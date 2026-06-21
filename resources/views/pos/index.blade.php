<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>POS Till — MAMICAR</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&display=swap" rel="stylesheet"/>
    <style>
        body { background:#080000; color:#fff; font-family:'Syne',sans-serif; display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:100vh; gap:20px; }
        .logo-mark { width:54px; height:54px; border-radius:14px; background:#dc2626; display:flex; align-items:center; justify-content:center; font-size:26px; font-weight:800; box-shadow:0 0 28px rgba(220,38,38,0.4); }
        h1 { font-size:22px; color:#dc2626; }
        p  { font-size:13px; color:#6b2020; }
    </style>
</head>
<body>
    <div class="logo-mark">M</div>
    <h1>POS Till</h1>
    <p>Logged in as: <strong style="color:#fff">{{ auth()->user()->name }}</strong></p>
    <p>Full POS till coming next.</p>
    <form action="/logout" method="POST" style="margin-top:10px">
        @csrf
        <button type="submit" style="background:#3a0000;color:#ef4444;border:none;padding:8px 20px;border-radius:8px;font-family:'Syne',sans-serif;cursor:pointer;">
            Logout
        </button>
    </form>
</body>
</html>