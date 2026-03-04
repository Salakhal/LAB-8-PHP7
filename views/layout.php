<?php // views/layout.php ?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mini MVC — Gestion Étudiants</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
  <style>
    .container{max-width: 980px; margin: 2rem auto;}
    .pagination a{margin: 0 .25rem;}
    .error{color: #b00020;}
    table{width:100%;}
    /* Style bach l-bouton dyal logout y-ji m9add m3a les liens */
    .logout-btn { padding: 0.2rem 0.8rem; font-size: 0.9rem; }
  </style>
</head>
<body>
  <main class="container">
    
    <?php 
      // 1. Kan-chekiw wach l'URL fih "login"
      $isLoginPage = (strpos($_SERVER['REQUEST_URI'], 'login') !== false); 
    ?>

    <?php if (!$isLoginPage): ?>
        <nav>
            <ul>
                <li><strong><a href="/">Gestion Étudiants</a></strong></li>
            </ul>
            <ul>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="/etudiants">Liste</a></li>
                    <li>
                        <form action="/logout" method="POST" style="display:inline; margin:0; padding:0;">
                            <button type="submit" class="secondary logout-btn">Déconnexion</button>
                        </form>
                    </li>
                <?php else: ?>
                    <li><a href="/login" class="contrast">Déconnexion</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    <?php endif; ?>

    <section>
      <?php echo $content; ?>
    </section>

  </main>
</body>
</html>