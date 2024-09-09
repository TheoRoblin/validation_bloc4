<?php $layout = 'admin/base.html.php'; ?>

<div class="container">
    <div class="row align-items-center">
        <div class="col">
            <h1>Tickets</h1>
            <p>Traitement des tickets.</p>
        </div>
        <div class="col-auto">
            <div class="form-check form-switch">
                <input class="form-check-input" 
                type="checkbox" role="switch" 
                id="flexSwitchCheckDefault" 
                onchange="window.location.href='<?= !isset($_GET['closed']) ? '/admin/ticket?closed' : '/admin/ticket' ?>'"
                <?= isset($_GET['closed']) ? 'checked' : ''; ?>
                >
                <label class="form-check-label" for="flexSwitchCheckDefault">Afficher les tickets fermés</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped" id="dashboard">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Titre</th>
                        <th>Créé le</th>
                        <th>Créé par</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($tickets)): ?>
                    <?php foreach ($tickets as $ticket): ?>
                    <tr>
                        <td><?= $ticket->getId() ?></td>
                        <td><?php if($ticket->getClosedat()): ?> 
                        <span class="badge bg-secondary">Fermé</span>
                        <?php elseif($ticket->getOpenedat()): ?>
                        <span class="badge bg-success">Ouvert</span>
                        <?php else: ?>
                        <span class="badge bg-info">Nouveau</span>
                        <?php endif; ?></td>
                        <td><span class="badge badge-pill" style="background-color: <?= $ticket->getColor() ?>;"><?= $ticket->getType() ?></span></td>
                        <td><?= $ticket->getTitle() ?></td>
                        <td><?= $ticket->getCreatedat()->format('d-m-Y à h:i') ?></td>
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