<?php
/** @var \App\Models\Hike[] $hikes */
/** @var \Framework\Support\LinkGenerator $link */
/** @noinspection PhpUnhandledExceptionInspection */
?>
<div>
    <div class="page-title-bar">
        <div>
            <h1>Turistom sa páči</h1>
            <p class="subtitle">Prezri si komunitou zverejnené trasy z databázy a ulož si ich do svojho plánu!</p>
        </div>
        <a href="<?= $link->url('hike.add') ?>" class="btn btn-primary">+ Pridať záznam túry</a>
    </div>

    <?php if (empty($hikes)): ?>
        <div style="padding: 32px; text-align: center; background: #f8faf9; border-radius: 12px;">
            <h3>Žiadne túry nezodpovedajú zvoleným filtrom</h3>
            <p>Skús upraviť kritériá v ľavom bočnom paneli alebo pridaj novú trasu.</p>
            <a href="<?= $link->url('home.index') ?>" class="btn btn-secondary">Zobraziť všetky trasy</a>
        </div>
    <?php else: ?>
        <div class="hikes-grid">
            <?php foreach ($hikes as $hike): ?>
                <?php $avg = $hike->getAverageRating(); ?>
                <article class="hike-card">
                    <div class="card-preview" style="background: #E2ECE4; padding: 16px; border-radius: 12px 12px 0 0; position: relative; height: 140px;">
                        <span class="badge badge-mountain" style="background: white; padding: 4px 10px; border-radius: 16px; font-weight: 600; font-size: 0.8em;">
                            <?= htmlspecialchars((string)$hike->getMountain()) ?> • <?= htmlspecialchars((string)$hike->getDifficulty()) ?>
                        </span>
                        <svg viewBox="0 0 300 90" style="width: 100%; height: 90px; margin-top: 10px;" preserveAspectRatio="none">
                            <path d="M 10 80 L 90 30 L 160 55 L 260 15 L 290 40 L 290 90 L 10 90 Z" fill="rgba(46, 82, 56, 0.18)"/>
                            <path d="M 10 80 L 90 30 L 160 55 L 260 15" fill="none" stroke="#E05429" stroke-width="4" stroke-linecap="round"/>
                        </svg>
                    </div>

                    <div class="card-body" style="padding: 16px;">
                        <h3 style="margin-top: 0; margin-bottom: 8px;">
                            <a href="<?= $link->url('hike.detail', ['id' => $hike->getId()]) ?>" style="color: var(--text-dark); text-decoration: none;">
                                <?= htmlspecialchars((string)$hike->getTitle()) ?>
                            </a>
                        </h3>

                        <p style="font-size: 0.9em; color: #555; margin-bottom: 10px;">
                            📏 <?= number_format((float)$hike->getDistance(), 1) ?> km &nbsp;•&nbsp;
                            ⛰️ +<?= number_format((int)$hike->getElevation(), 0, '.', ' ') ?> m &nbsp;•&nbsp;
                            ⏱️ <?= $hike->getEstimatedDuration() ?>
                        </p>

                        <p style="font-size: 0.9em; color: #444; margin-bottom: 14px;">
                            <?= htmlspecialchars(mb_strimwidth((string)$hike->getDescription(), 0, 110, '...')) ?>
                        </p>

                        <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #eee; padding-top: 12px;">
                            <span style="font-size: 0.85em; font-weight: bold; color: #d97706;">
                                <?= $avg > 0 ? "★ {$avg} / 5" : 'Nová trasa' ?>
                            </span>
                            <div style="display: flex; gap: 6px;">
                                <a href="<?= $link->url('hike.detail', ['id' => $hike->getId()]) ?>" class="btn btn-sm btn-secondary">3D Detail</a>
                                <form action="<?= $link->url('hike.cloneToPlan') ?>" method="post" style="margin: 0;">
                                    <input type="hidden" name="id" value="<?= $hike->getId() ?>">
                                    <button type="submit" class="btn btn-sm btn-primary" title="Skopíruje túto trasu do Moje túry ako Plánovanú">+ Do plánu</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>