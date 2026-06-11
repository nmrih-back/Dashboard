<?php
$role = $_GET['role'] ?? null;
$display = 'Usuário';
$menuTitle = 'Home';
$dashboardMessage = 'Logue primeiro';
$cargo = 'Usuário';

function cargoLabel($role) {
    if ($role === 'administrador') return 'Administrador';
    if ($role === 'cliente') return 'Cliente';
    if ($role === 'suporte') return 'Suporte';
    return 'Usuário';
}

if ($role) {
    $display = cargoLabel($role);
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
    <title>Configurações - <?php echo htmlspecialchars($cargo); ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="app <?php echo htmlspecialchars($role ?? ''); ?>">
    <header class="topbar">
        <div class="brand">Bem-vindo, <?php echo htmlspecialchars($display); ?></div>
        <div class="top-right">
            <nav class="user-actions"><a href="config.php?role=<?php echo urlencode($role); ?>">Configurações</a><a href="logout.php">Sair</a></nav>
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
            <div class="hero">
                <h1><?php echo htmlspecialchars($dashboardMessage); ?></h1>
            </div>
        </main>
    </div>

</body>
</html>
