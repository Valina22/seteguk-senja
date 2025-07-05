<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Seteguk Senja</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #8b4513;
            --primary-dark: #6f3510;
            --bg: #fdf9f4;
            --text-dark: #3e2a1a;
            --border: #e0d1c2;
            --white: #fff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            background: var(--bg);
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            background: var(--white);
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeIn 0.5s ease;
        }

        .branding {
            font-size: 1.4em;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 8px;
            font-family: 'Lora', serif;
        }

        .login-box h2 {
            color: var(--text-dark);
            margin-bottom: 25px;
            font-weight: 600;
        }

        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 18px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 1em;
            transition: all 0.3s ease;
        }

        .login-box input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(139, 69, 19, 0.1);
        }

        .login-box button {
            background-color: var(--primary);
            color: var(--white);
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .login-box button:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .login-box button:active {
            transform: scale(0.98);
        }

        .error-message {
            color: #d10000;
            background-color: #fcebea;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 0.9em;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-15px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @media screen and (max-width: 480px) {
            .login-box {
                padding: 30px 20px;
            }

            .branding {
                font-size: 1.2em;
            }

            .login-box h2 {
                font-size: 1.4em;
            }
        }
    </style>
</head>
<body>

<div class="login-box">
    <div class="branding">☕ Seteguk Senja</div>
    <h2>Login Admin</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="error-message">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('/admin/login-process') ?>" method="post">
        <?= csrf_field() ?>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Masuk</button>
    </form>
</div>

</body>
</html>
