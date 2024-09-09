<?php $layout = 'base.html.php'; ?>
<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1>Traquer les bugs n'a jamais été aussi facile !</h1>
            <p>Une application web elle même buggée</p>
            <?php if(!isset($_SESSION['user'])): ?>
            <a href="/login" class="btn btn-primary btn-lg">Me connecter</a>
            <a href="/register" class="btn btn-outline-primary btn-lg">Créer mon compte</a>
            <?php else: ?>
            <a href="/user/ticket" class="btn btn-primary btn-lg">Accéder à mes tickets</a>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <img src="/images/undraw_fixing_bugs_w7gi.svg" alt="" class="img-fluid" />
        </div>
    </div>
</div>