<?php $layout = 'base.html.php'; ?>

<div class="container py-4">
    <div class="row align-items-center">
        <div class="col">
            <h1>Nouveau ticket</h1>
        </div>
        <div class="col-auto">
            <a href="/user/ticket" class="btn btn-outline-secondary">Annuler</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">

            <div class="card">
                <div class="card-body">
                    <form action="/user/ticket/new" method="post" enctype="multipart/form" role="form">
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" name="ticket[type_id]" id="type">
                                <option selected disabled>Choisir un type</option>
                                <?php foreach($types as $type): ?>
                                <option value="<?= $type->getId() ?>"><?= $type->getLabel() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" class="form-control" name="ticket[title]" id="titre" aria-describedby="titreHelp" placeholder="ex: Problème d'export de fichier">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Contenu</label>
                            <textarea class="form-control" name="ticket[content]" id="content" aria-describedby="contentHelp" placeholder="Une courte description du problème ou de la demande"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>