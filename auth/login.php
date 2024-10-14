<?php
// Vérifiez si une session est déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once './config/variables.php';
require_once('./functions/messsage.php');
?>



<?php if (!isset($_SESSION['LOGGED_USER'])) : ?>
    <form class="login mx-auto border rounded px-4 py-5 mt-20" action="<?php echo BASE_URL; ?>auth/post_login.php" method="POST">

        <h3 class="my-4 text-center">Connectez-vous</h3>

        <!-- si message d'erreur on l'affiche -->
        <?php if (isset($_SESSION['LOGIN_ERROR_MESSAGE'])) : ?><div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['LOGIN_ERROR_MESSAGE'];
                unset($_SESSION['LOGIN_ERROR_MESSAGE']); ?>
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" class="form-control" id="email" name="email" />
            <div id="emailHelp" class="form-text">Nous ne partagerons jamais votre adresse e-mail.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" />
        </div>

        <div class="mt-5 text-center">
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </div>

        <p class="mt-10 text-center text-sm ">
            Vous n'avez pas de compte?
            <a href="<?php echo BASE_URL; ?>auth/register.php" class="">Inscrivez-vous !</a>
        </p>
    </form>

    <!-- Si utilisateur/trice bien connectée on affiche un message de succès -->
<?php else : ?>

    

    <?php
    // Afficher un message de succès de déconnexion et rediriger
    showToastWithRedirect('connexion réussie !', 'success', 3000);
    ?>
<?php endif; ?>

<!-- <div class="alert alert-success" role="alert">
        Bonjour  et bienvenue sur le site !
    </div> -->