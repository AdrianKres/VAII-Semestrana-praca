<?php
/** @var \App\Models\Hike|null $hike */
/** @var \Framework\Support\LinkGenerator $link */
/** @noinspection PhpUnhandledExceptionInspection */

if (!$hike) {
    echo '<p>Túra sa nenašla.</p>';
    return;
}

$photos = $hike->getPhotos();
$ratings = $hike->getRatings();
$avgRating = $hike->getAverageRating();
?>

<div class="detail-grid">
    <!-- ĽAVÁ KARTA: METRIKY, 3D INTERAKTÍVNA MAPA A REPORTY KOMUNITY -->
    <section aria-labelledby="hike-title">
        <div class="page-title-bar">
            <div class="hike-header">
                <h1 id="hike-title"><?= htmlspecialchars((string)$hike->getTitle()) ?></h1>
                <p class="hike-meta" style="margin-bottom: 0;">
                    <?= htmlspecialchars((string)$hike->getMountain()) ?> •
                    Náročnosť: <strong><?= htmlspecialchars((string)$hike->getDifficulty()) ?></strong> •
                    <?= htmlspecialchars((string)$hike->getStatus()) ?> (<?= htmlspecialchars($hike->getFormattedDate()) ?>)
                </p>
            </div>
            <div class="header-actions">
                <a href="<?= $link->url('hike.index') ?>" class="btn btn-secondary">← Späť na denník</a>
                <a href="<?= $link->url('hike.edit', ['id' => $hike->getId()]) ?>" class="btn btn-secondary">Upraviť túru</a>
                <form action="<?= $link->url('hike.delete') ?>" method="post" style="display: inline; margin: 0;" onsubmit="return confirm('Naozaj chcete vymazať túto túru?');">
                    <input type="hidden" name="id" value="<?= $hike->getId() ?>">
                    <button type="submit" class="btn btn-danger">Zmazať</button>
                </form>
            </div>
        </div>

        <div class="metrics-grid">
            <div class="metric-box">
                <span class="metric-label">Vzdialenosť</span>
                <strong class="metric-value"><?= number_format((float)$hike->getDistance(), 1) ?> km</strong>
            </div>
            <div class="metric-box">
                <span class="metric-label">Prevýšenie</span>
                <strong class="metric-value">+<?= number_format((int)$hike->getElevation(), 0, '.', ' ') ?> m</strong>
            </div>
            <div class="metric-box">
                <span class="metric-label">Odhadovaný čas</span>
                <strong class="metric-value"><?= $hike->getEstimatedDuration() ?></strong>
            </div>
            <div class="metric-box">
                <span class="metric-label">GPX podklad</span>
                <strong class="metric-value"><?= htmlspecialchars((string)$hike->getGpxFile()) ?></strong>
            </div>
        </div>

        <!-- 3D MapLibre Viewport -->
        <div class="map-viewport" role="region" aria-label="3D vizualizácia terénu" style="margin-bottom: 24px;">
            <svg class="map-svg-bg" viewBox="0 0 800 500" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="800" height="500" fill="#DDE8DF"/>
                <path d="M 0 380 L 180 210 L 340 290 L 540 95 L 690 230 L 800 170 L 800 500 L 0 500 Z" fill="#C7D9C9"/>
                <path d="M 0 430 L 220 310 L 410 350 L 610 190 L 800 280 L 800 500 L 0 500 Z" fill="#B5CCB8"/>
                <path d="M 110 440 Q 240 350 310 280 Q 430 190 540 98" fill="none" stroke="#E05429" stroke-width="6" stroke-linecap="round"/>
                <circle cx="110" cy="440" r="7" fill="#2E5238" stroke="#FFFFFF" stroke-width="2"/>
                <circle cx="540" cy="98" r="8" fill="#E05429" stroke="#FFFFFF" stroke-width="2"/>
            </svg>

            <div class="map-top-controls">
                <span class="floating-badge">3D Terén • <?= htmlspecialchars((string)$hike->getGpxFile()) ?></span>
                <button type="button" class="floating-btn">Prelet kamery ▶</button>
            </div>

            <div class="elevation-card">
                <div class="elevation-title">Výškový profil trasy (+<?= number_format((int)$hike->getElevation(), 0, '.', ' ') ?> m)</div>
                <svg width="100%" height="55" viewBox="0 0 700 55" preserveAspectRatio="none">
                    <path d="M 0 50 L 160 32 L 320 18 L 480 5 L 620 30 L 700 48" fill="none" stroke="#70A642" stroke-width="3.5" stroke-linecap="round"/>
                    <path d="M 0 50 L 160 32 L 320 18 L 480 5 L 620 30 L 700 48 L 700 55 L 0 55 Z" fill="rgba(112, 166, 66, 0.15)"/>
                </svg>
            </div>
        </div>

        <!-- KOMUNITNÉ REPORTY PODMIENOK A HODNOTENIA (Tabuľka ratings) -->
        <div style="border-top: 2px solid #E6F2F7; padding-top: 20px;">
            <h3>Aktuálne podmienky na trase a hodnotenia (<?= count($ratings) ?>)</h3>
            <?php foreach ($ratings as $r): ?>
                <div style="background: #f8faf9; padding: 12px 16px; border-radius: 8px; margin-bottom: 10px;">
                    <div style="display: flex; justify-content: space-between;">
                        <strong><?= htmlspecialchars((string)$r->getAuthorName()) ?></strong>
                        <span style="color: #d97706; font-weight: bold;"><?= str_repeat('★', (int)$r->getStars()) ?><?= str_repeat('☆', 5 - (int)$r->getStars()) ?></span>
                    </div>
                    <p style="margin: 6px 0;"><?= htmlspecialchars((string)$r->getComment()) ?></p>
                    <small style="color: #777;">Pridané: <?= htmlspecialchars((string)$r->getCreatedAt()) ?></small>
                </div>
            <?php endforeach; ?>

            <form action="<?= $link->url('hike.addRating') ?>" method="post" style="margin-top: 16px; background: #fff; border: 1px solid #dce5df; padding: 16px; border-radius: 10px;">
                <input type="hidden" name="hike_id" value="<?= $hike->getId() ?>">
                <h4 style="margin-top: 0;">Pridať report podmienok / hodnotenie</h4>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 10px;">
                    <input type="text" name="author_name" class="form-control" value="Adrián Kres" placeholder="Vaše meno" required>
                    <select name="stars" class="form-control">
                        <option value="5">★★★★★ Výborné podmienky (5/5)</option>
                        <option value="4">★★★★☆ Dobré podmienky (4/5)</option>
                        <option value="3">★★★☆☆ Priemerné / obmedzenia (3/5)</option>
                        <option value="2">★★☆☆☆ Zlé podmienky (2/5)</option>
                        <option value="1">★☆☆☆☆ Nebezpečné / nepriechodné (1/5)</option>
                    </select>
                </div>
                <textarea name="comment" rows="2" class="form-control" placeholder="Napr. Pod sedlom je súvislý ľad, reťaze sú pod snehom..." required style="margin-bottom: 10px;"></textarea>
                <button type="submit" class="btn btn-sm btn-primary">Odoslať report do DB</button>
            </form>
        </div>
    </section>

    <!-- PRAVÁ KARTA: DENNÍK, FOTOGALÉRIA Z DB A PREPÍNAČ STAVU -->
    <aside class="side-panel" aria-label="Záznam z denníka a fotogaléria">
        <div>
            <h2>Záznam z denníka</h2>
            <p class="diary-note">
                <?= nl2br(htmlspecialchars((string)$hike->getDescription())) ?>
            </p>
        </div>

        <div>
            <div class="section-header">
                <h2>Fotografie z výstupu (<?= count($photos) ?>)</h2>
            </div>

            <div class="photo-list">
                <?php if (empty($photos)): ?>
                    <p style="color: #666; font-size: 0.9em;">K tejto túre zatiaľ nie sú priradené žiadne fotografie.</p>
                <?php else: ?>
                    <?php foreach ($photos as $index => $photo): ?>
                        <article class="photo-item">
                            <div class="photo-thumb">FOTO <?= $index + 1 ?></div>
                            <div class="photo-info">
                                <h4><?= $index + 1 ?>. <?= htmlspecialchars((string)$photo->getCaption()) ?></h4>
                                <p class="photo-meta"><?= htmlspecialchars((string)$photo->getFileName()) ?> • <?= htmlspecialchars((string)$photo->getFileSize()) ?></p>
                                <div class="photo-actions">
                                    <form action="<?= $link->url('hike.deletePhoto') ?>" method="post" style="display: inline;">
                                        <input type="hidden" name="photo_id" value="<?= $photo->getId() ?>">
                                        <input type="hidden" name="hike_id" value="<?= $hike->getId() ?>">
                                        <button type="submit" style="background: none; border: none; color: #c0392b; cursor: pointer; padding: 0; font-size: 0.85em;">Zmazať fotku</button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Formulár na pridanie fotky do tabuľky hike_photos -->
            <form action="<?= $link->url('hike.addPhoto') ?>" method="post" style="margin-top: 14px; padding: 12px; background: #f8faf9; border-radius: 8px;">
                <input type="hidden" name="hike_id" value="<?= $hike->getId() ?>">
                <strong style="display: block; margin-bottom: 6px; font-size: 0.9em;">+ Pridať fotografiu k túre</strong>
                <input type="text" name="caption" class="form-control" placeholder="Popis (napr. Pohľad z hrebeňa)" required style="margin-bottom: 6px;">
                <input type="text" name="file_name" class="form-control" placeholder="Súbor (napr. IMG_04.jpg)" style="margin-bottom: 8px;">
                <button type="submit" class="btn btn-sm btn-primary" style="width: 100%;">Pridať foto do DB</button>
            </form>
        </div>

        <div class="ajax-box">
            <span class="ajax-label">Rýchla zmena stavu a súhrn hodnotenia:</span>
            <div class="ajax-controls" style="display: flex; gap: 8px; flex-wrap: wrap;">
                <form action="<?= $link->url('hike.updateStatus') ?>" method="post" style="margin: 0;">
                    <input type="hidden" name="id" value="<?= $hike->getId() ?>">
                    <input type="hidden" name="redirect_to" value="detail">
                    <input type="hidden" name="status" value="<?= ($hike->getStatus() === 'Absolvovaná') ? 'Plánovaná' : 'Absolvovaná' ?>">
                    <button type="submit" class="btn btn-primary">
                        <?= ($hike->getStatus() === 'Absolvovaná') ? '✓ Absolvovaná (Prepnúť na Plánovanú)' : '⏳ Plánovaná (Označiť ako Absolvovanú)' ?>
                    </button>
                </form>
                <span class="btn btn-secondary">Priemer: ★ <?= $avgRating > 0 ? $avgRating : 'Nehodnotené' ?></span>
            </div>
        </div>
    </aside>
</div>