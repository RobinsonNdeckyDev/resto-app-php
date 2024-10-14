<?php
require_once __DIR__ . '/../config/variables.php';

?>

<?php if (isset($_SESSION['LOGGED_USER'])) : ?>
    <nav class="navbar navbar-expand-lg sticky-top shadow">
        <div class="container-fluid">
            <a class="navbar-brand d-none d-lg-block" href="#">
                <img src="/images/bootstrap-logo.svg" width="36" alt="Logo" />
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav gap-2">
                    <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL; ?>index.php">Accueil</a>
                    <a class="nav-link" href="<?php echo BASE_URL; ?>pages/about.php">A propos</a>
                    <a class="nav-link" href="<?php echo BASE_URL; ?>pages/create_recette.php">+ recette</a>
                </div>
            </div>

            <ul class="navbar-nav ms-auto"> <!-- ms-auto pour aligner à droite -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="/images/avatar/1.jpg" alt="User Avatar" width="36" class="rounded-circle" />
                        <span class="avatar-badge bg-red-300 p-1"></span>
                    </a>
                    <ul class="dropdown-menu drp" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Paramétre</a></li>
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>auth/logout.php">Deconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
<?php endif;  ?>