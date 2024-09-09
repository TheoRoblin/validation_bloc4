<?php $layout = 'admin/base.html.php'; ?>

<div class="container">
    <div class="row align-items-center">
        <div class="col">
            <h1>Tickets n°<?= $ticket->getId() ?></h1>
        </div>
        <div class="col-auto">
            <?php if($ticket->getClosedat()): ?> 
                <a href="#" class="btn btn-secondary disabled"><i class="bi bi-check-square me-2"></i>Ticket fermé</a>
            <?php else: ?>
                <a href="/admin/ticket/close?id=<?= $ticket->getId() ?>" class="btn btn-outline-primary"><i class="bi bi-square me-2"></i>Clôturer le ticket</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <tr>
                    <th>Status</th>
                    <td>
                        <?php if($ticket->getClosedat()): ?> 
                        <span class="badge bg-secondary">Fermé</span>
                        <?php elseif($ticket->getOpenedat()): ?>
                        <span class="badge bg-success">Ouvert</span>
                        <?php else: ?>
                        <span class="badge bg-info">Nouveau</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td><span class="badge badge-pill" style="background-color: <?= $ticket->getColor() ?>;"><?= $ticket->getType() ?></span></td>
                </tr>

                <tr>
                    <th>Créé le</th>
                    <td><?= $ticket->getCreatedat()->format('d-m-Y h:i') ?></td>
                </tr>

                <tr>
                    <th>Contenu</th>
                    <td><?= $ticket->getContent() ?></td>
                </tr>

                <tr>
                    <th>Créé par</th>
                    <td><?= $ticket->getCreatedby() ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>