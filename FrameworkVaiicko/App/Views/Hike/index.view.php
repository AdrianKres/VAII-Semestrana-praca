<?php
/** @var \App\Models\Hike[] $hikes */
/** @var \App\Models\Mountain[] $mountains */
/** @var string $selectedMountain */
/** @var string $search */
/** @var \Framework\Support\LinkGenerator $link */
/** @noinspection PhpUnhandledExceptionInspection */

$totalDistance = 0.0;
$totalElevation = 0;
$highestHikeTitle = 'Žiadny záznam';
$maxElev = -1;

foreach ($hikes as $item) {
    $totalDistance += (float)$item->getDistance();
    $totalElevation += (int)$item->getElevation();
    if ((int)$item->getElevation() > $maxElev) {
        $maxElev = (int)$item->getElevation();
        $highestHikeTitle = (string)$item->getTitle();
    }
}
?>
<div>
    <div class="page-title-bar">
        <div>
            <h1>Môj turistický denník</h1>
            <p class="subtitle">Správa vlastných záznamov, GPX trás a okamžitá zmena stavu priamo v tabuľke</p>
        </div>
        <a href="<?= $link->url('hike.add') ?>" class="btn btn-primary">+ Pridať novú túru</a>
    </div>

    <div class="metrics-grid">
        <div class="metric-box">
            <span class="metric-label">Zobrazených záznamov</span>
            <strong class="metric-value"><?= count($hikes) ?> túr</strong>
        </div>
        <div class="metric-box">
            <span class="metric-label">Celková vzdialenosť</span>
            <strong class="metric-value"><?= number_format($totalDistance, 1, '.', ' ') ?> km</strong>
        </div>
        <div class="metric-box">
            <span class="metric-label">Celkové prevýšenie</span>
            <strong class="metric-value">+<?= number_format($totalElevation, 0, '.', ' ') ?> m</strong>
        </div>
        <div class="metric-box">
            <span class="metric-label">Najväčšie prevýšenie</span>
            <strong class="metric-value"><?= htmlspecialchars($highestHikeTitle) ?></strong>
        </div>
    </div>

    <!-- Funkčná lišta filtrovania tabuľky -->
    <form action="<?= $link->url('hike.index') ?>" method="get" class="table-toolbar" style="display: flex; gap: 12px; margin-bottom: 16px;">
        <input type="hidden" name="c" value="hike">
        <input type="hidden" name="a" value="index">
        <input type="search" name="search" value="<?= htmlspecialchars($search ?? '') ?>" class="search-input" placeholder="Hľadať v denníku..." aria-label="Filtrovať v tabuľke">
        <div class="header-actions" style="display: flex; gap: 8px;">
            <select name="mountain_filter" class="inline-select" onchange="this.form.submit()" aria-label="Filtrovať podľa pohoria">
                <option value="Všetky pohoria">Všetky pohoria</option>
                <?php foreach ($mountains as $m): ?>
                    <option value="<?= htmlspecialchars((string)$m->getName()) ?>" <?= ($selectedMountain === $m->getName()) ? 'selected' : '' ?>>
                        <?= htmlspecialchars((string)$m->getName()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-sm btn-secondary">Filtrovať</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
            <tr>
                <th>Názov výstupu</th>
                <th>Pohorie</th>
                <th>Dátum</th>
                <th>Parametre</th>
                <th>GPX súbor</th>
                <th>Stav (Priamy zápis do DB)</th>
                <th>Akcie (CRUD)</th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($hikes)): ?>
                <tr>
                    <td colspan="7" style="text-align: center; padding: 24px;">
                        V denníku sa nenachádzajú žiadne zodpovedajúce túry.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($hikes as $hike): ?>
                    <tr>
                        <td>
                            <strong>
                                <a href="<?= $link->url('hike.detail', ['id' => $hike->getId()]) ?>" style="color: var(--text-dark); text-decoration: none;">
                                    <?= htmlspecialchars((string)$hike->getTitle()) ?>
                                </a>
                            </strong>
                            <br><small style="color: #666;">Náročnosť: <?= htmlspecialchars((string)$hike->getDifficulty()) ?></small>
                        </td>
                        <td class="cell-nowrap"><span class="badge badge-mountain"><?= htmlspecialchars((string)$hike->getMountain()) ?></span></td>
                        <td class="cell-nowrap"><?= htmlspecialchars($hike->getFormattedDate()) ?></td>
                        <td class="cell-nowrap"><?= number_format((float)$hike->getDistance(), 1) ?> km • +<?= number_format((int)$hike->getElevation(), 0, '.', ' ') ?> m</td>
                        <td><code><?= htmlspecialchars((string)$hike->getGpxFile()) ?></code></td>
                        <td class="cell-nowrap">
                            <form action="<?= $link->url('hike.updateStatus') ?>" method="post" style="margin: 0;">
                                <input type="hidden" name="id" value="<?= $hike->getId() ?>">
                                <select name="status" class="inline-select" onchange="this.form.submit()" aria-label="Stav túry">
                                    <option value="Absolvovaná" <?= ($hike->getStatus() === 'Absolvovaná') ? 'selected' : '' ?>>✓ Absolvovaná</option>
                                    <option value="Plánovaná" <?= ($hike->getStatus() === 'Plánovaná') ? 'selected' : '' ?>>Plánovaná</option>
                                </select>
                            </form>
                        </td>
                        <td class="cell-nowrap">
                            <div class="table-actions">
                                <a href="<?= $link->url('hike.detail', ['id' => $hike->getId()]) ?>" class="btn btn-sm btn-secondary">3D Mapa</a>
                                <a href="<?= $link->url('hike.edit', ['id' => $hike->getId()]) ?>" class="btn btn-sm btn-secondary">Upraviť</a>
                                <form action="<?= $link->url('hike.delete') ?>" method="post" style="display: inline; margin: 0;" onsubmit="return confirm('Naozaj chcete vymazať túto túru z databázy?');">
                                    <input type="hidden" name="id" value="<?= $hike->getId() ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Zmazať</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>