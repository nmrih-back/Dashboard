<?php
$error = '';
$role = null;
$display = 'Usuário';
$cargo = 'Usuário';
$menuTitle = 'Home';
$dashboardMessage = 'Logue primeiro';

function cargoLabel($role) {
    if ($role === 'administrador') return 'Administrador';
    if ($role === 'cliente') return 'Cliente';
    if ($role === 'suporte') return 'Suporte';
    return 'Usuário';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $user = trim($_POST['user'] ?? '');
    $pass = trim($_POST['pass'] ?? '');

    if ($user === 'admin' && $pass === 'admin123') {
        $role = 'administrador';
        $display = 'Administrador';
    } elseif ($user === 'cliente' && $pass === 'cliente123') {
        $role = 'cliente';
        $display = 'Cliente';
    } elseif ($user === 'suporte' && $pass === 'suporte123') {
        $role = 'suporte';
        $display = 'Suporte';
    } else {
        echo '<!doctype html><html lang="pt-br"><head><meta charset="utf-8"></head><body><h1>Credenciais incorretas</h1></body></html>';
        exit;
    }

    $cargo = cargoLabel($role);
    $menuTitle = 'Menu do ' . $cargo;
    $dashboardMessage = 'Conteúdo do ' . $cargo;
}

?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Painel - <?php echo htmlspecialchars($cargo); ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="app <?php echo htmlspecialchars($role ?? ''); ?>">
    <header class="topbar">
        <div class="brand">Bem-vindo, <?php echo htmlspecialchars($display); ?></div>
        <div class="top-right">
            <?php if (!$role): ?>
                <form class="top-login" method="post" action="">
                    <input type="hidden" name="action" value="login">
                    <label class="top-label">Usuário</label>
                    <input type="text" name="user" required>
                    <label class="top-label">Senha</label>
                    <input type="password" name="pass" required>
                    <button type="submit">Entrar</button>
                </form>
                <?php if ($error): ?>
                    <div class="error-inline"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
            <?php else: ?>
                <nav class="user-actions"><a href="config.php?role=<?php echo urlencode($role); ?>">Configurações</a><a href="logout.php">Sair</a></nav>
            <?php endif; ?>
        </div>
    </header>

    <div class="container">
        <aside class="sidebar">
            <h2><?php echo htmlspecialchars($menuTitle); ?></h2>
            <div class="creds-footer">
                <strong>Credenciais</strong>
                <div>admin / admin123</div>
                <div>cliente / cliente123</div>
                <div>suporte / suporte123</div>
            </div>
        </aside>
        <main class="main">
            <?php
                echo '<div class="hero"><h1>' . htmlspecialchars($dashboardMessage) . '</h1></div>';
            ?>
        </main>
    </div>

</body>
</html>
