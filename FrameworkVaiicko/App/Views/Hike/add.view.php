<?php
/** @var \App\Models\Hike $hike */
/** @var \App\Models\Mountain[] $mountains */
/** @var \Framework\Support\LinkGenerator $link */
/** @noinspection PhpUnhandledExceptionInspection */

$isEdit = isset($hike) && $hike->getId() !== null;
?>
<div class="form-container">
    <div class="page-title-bar">
        <div>
            <h1><?= $isEdit ? 'Upraviť záznam túry' : 'Pridať záznam túry' ?></h1>
            <p class="subtitle">Vyplňte parametre výstupu a priložte GPX súbor pre uloženie do databázy</p>
        </div>
        <a href="<?= $link->url('hike.index') ?>" class="btn btn-secondary">← Späť na denník</a>
    </div>

    <form action="<?= $link->url('hike.save') ?>" method="post">
        <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?= $hike->getId() ?>">
        <?php endif; ?>

        <div class="form-grid">
            <div class="form-group full-width">
                <label class="form-label" for="title">Názov túry / vrcholu *</label>
                <input type="text" id="title" name="title" class="form-control" value="<?= htmlspecialchars($hike->getTitle() ?? '') ?>" placeholder="napr. Výstup na Kriváň (2 494 m)" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="mountain_id">Pohorie (z číselníka DB) *</label>
                <select id="mountain_id" name="mountain_id" class="form-control" required>
                    <?php foreach ($mountains as $m): ?>
                        <option value="<?= $m->getId() ?>" <?= ($hike->getMountainId() === $m->getId() || $hike->getMountain() === $m->getName()) ? 'selected' : '' ?>>
                            <?= htmlspecialchars((string)$m->getName()) ?> (max. <?= $m->getElevation() ?> m)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="difficulty">Náročnosť v teréne *</label>
                <select id="difficulty" name="difficulty" class="form-control" required>
                    <?php foreach (['Ľahká', 'Stredná', 'Ťažká', 'Extrémna'] as $diff): ?>
                        <option value="<?= $diff ?>" <?= (($hike->getDifficulty() ?? 'Stredná') === $diff) ? 'selected' : '' ?>><?= $diff ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="hike_date">Dátum výstupu *</label>
                <input type="date" id="hike_date" name="hike_date" class="form-control" value="<?= htmlspecialchars($hike->getHikeDate() ?? date('Y-m-d')) ?>" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="distance">Vzdialenosť (km) *</label>
                <input type="number" step="0.1" min="0.1" id="distance" name="distance" class="form-control" value="<?= htmlspecialchars((string)($hike->getDistance() ?? '')) ?>" placeholder="napr. 15.8" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="elevation">Prevýšenie (m) *</label>
                <input type="number" step="1" min="0" id="elevation" name="elevation" class="form-control" value="<?= htmlspecialchars((string)($hike->getElevation() ?? '')) ?>" placeholder="napr. 1360" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="gpx_file">Názov GPX súboru *</label>
                <input type="text" id="gpx_file" name="gpx_file" class="form-control" value="<?= htmlspecialchars($hike->getGpxFile() ?? 'krivan_track.gpx') ?>" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="status">Stav túry *</label>
                <select id="status" name="status" class="form-control" required>
                    <?php $currentStatus = $hike->getStatus() ?? 'Absolvovaná'; ?>
                    <option value="Absolvovaná" <?= ($currentStatus === 'Absolvovaná') ? 'selected' : '' ?>>✓ Absolvovaná</option>
                    <option value="Plánovaná" <?= ($currentStatus === 'Plánovaná') ? 'selected' : '' ?>>Plánovaná</option>
                </select>
            </div>

            <div class="form-group full-width">
                <label style="cursor: pointer; display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" name="is_public" value="1" <?= (($hike->getIsPublic() ?? 1) == 1) ? 'checked' : '' ?>>
                    <strong>Zverejniť túto trasu na komunitnej nástenke „Inšpiruj sa“</strong>
                </label>
            </div>

            <div class="form-group full-width">
                <label class="form-label" for="description">Poznámky z denníka a podmienky na trase</label>
                <textarea id="description" name="description" rows="4" class="form-control" placeholder="Opíšte priebeh výstupu, počasie a orientačne náročné miesta..."><?= htmlspecialchars($hike->getDescription() ?? '') ?></textarea>
            </div>
        </div>

        <div class="form-actions" style="margin-top: 20px;">
            <a href="<?= $link->url('hike.index') ?>" class="btn btn-secondary">Zrušiť</a>
            <button type="submit" class="btn btn-primary">
                <?= $isEdit ? 'Uložiť zmeny v databáze' : 'Uložiť záznam do databázy' ?>
            </button>
        </div>
    </form>
</div>