<?php $layout = 'admin/base.html.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Dashboard</h1>
            <p>Consulter tous les ticket en cours de traitement (OUVERTS).</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped" id="dashboard">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Type</th>
                        <th>Titre</th>
                        <th>Créé le</th>
                        <th>Ouvert le</th>
                        <th>Créé par</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($tickets)): ?>
                    <?php foreach ($tickets as $ticket): ?>
                    <tr>
                        <td><?= $ticket->getId() ?></td>
                        <td><span class="badge badge-pill" style="background-color: <?= $ticket->getColor() ?>;"><?= $ticket->getType() ?></span></td>
                        <td><?= $ticket->getTitle() ?></td>
                        <td><?= $ticket->getCreatedat()->format('d-m-Y à h:i') ?></td>
                        <td><?= $ticket->getOpenedat()->format('d-m-Y à h:i') ?></td>
                        <td><?= $ticket->getCreatedby() ?></td>
                        <td>
                            <a href="/admin/ticket/show?id=<?= $ticket->getId() ?>" class="btn btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="text-center">Aucun ticket ouvert pour le moment</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>