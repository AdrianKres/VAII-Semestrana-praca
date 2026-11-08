<?php
/** @var \App\Models\Mountain[] $mountains */
/** @var \Framework\Support\LinkGenerator $link */
/** @noinspection PhpUnhandledExceptionInspection */
?>
<div>
    <div class="page-title-bar">
        <div>
            <h1>Slovenské pohoria (Číselník DB)</h1>
            <p class="subtitle">Prehľad horských oblastí, najvyšších vrcholov a počtu evidovaných trás v databáze</p>
        </div>
    </div>

    <div class="table-responsive" style="margin-bottom: 28px;">
        <table class="data-table">
            <thead>
            <tr>
                <th>Pohorie</th>
                <th>Najvyšší vrchol</th>
                <th>Nadmorská výška</th>
                <th>Charakteristika</th>
                <th>Počet túr v DB</th>
                <th>Akcie</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($mountains as $m): ?>
                <?php $count = $m->getHikeCount(); ?>
                <tr>
                    <td class="cell-nowrap"><strong><?= htmlspecialchars((string)$m->getName()) ?></strong></td>
                    <td class="cell-nowrap"><?= htmlspecialchars((string)$m->getHighestPeak()) ?></td>
                    <td class="cell-nowrap"><?= number_format((int)$m->getElevation(), 0, '.', ' ') ?> m n. m.</td>
                    <td><?= htmlspecialchars((string)$m->getDescription()) ?></td>
                    <td class="cell-nowrap"><span class="badge badge-mountain"><?= $count ?> trás</span></td>
                    <td class="cell-nowrap">
                        <div class="table-actions">
                            <a href="<?= $link->url('home.index', ['mountains' => [$m->getName()]]) ?>" class="btn btn-sm btn-secondary">Filtrovať túry</a>
                            <?php if ($count === 0): ?>
                                <form action="<?= $link->url('mountain.delete') ?>" method="post" style="display: inline; margin: 0;">
                                    <input type="hidden" name="id" value="<?= $m->getId() ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Zmazať</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pridanie nového pohoria do číselníka -->
    <div style="background: #f8faf9; padding: 20px; border-radius: 12px; border: 1px solid #dce5df;">
        <h3 style="margin-top: 0;">+ Pridať nové pohorie do databázy</h3>
        <form action="<?= $link->url('mountain.save') ?>" method="post" class="form-grid">
            <div class="form-group">
                <label class="form-label">Názov pohoria *</label>
                <input type="text" name="name" class="form-control" placeholder="napr. Chočské vrchy" required>
            </div>
            <div class="form-group">
                <label class="form-label">Najvyšší vrchol *</label>
                <input type="text" name="highest_peak" class="form-control" placeholder="napr. Veľký Choč" required>
            </div>
            <div class="form-group">
                <label class="form-label">Výška (m n. m.) *</label>
                <input type="number" name="elevation" class="form-control" placeholder="napr. 1611" required>
            </div>
            <div class="form-group full-width">
                <label class="form-label">Stručná charakteristika</label>
                <input type="text" name="description" class="form-control" placeholder="Krasové pohorie s výhľadovým hlavným vrcholom...">
            </div>
            <div class="form-group full-width">
                <button type="submit" class="btn btn-primary">Uložiť pohorie do číselníka</button>
            </div>
        </form>
    </div>
</div>