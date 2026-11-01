<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @noinspection PhpUnhandledExceptionInspection */
?>

<main class="detail-grid">
    <!-- ĽAVÁ KARTA: METRIKY A 3D INTERAKTÍVNA MAPA -->
    <section class="card" aria-labelledby="hike-title">
        <div class="page-title-bar">
            <div class="hike-header">
                <h1 id="hike-title">Výstup na Kriváň (2 494 m n. m.)</h1>
                <p class="hike-meta" style="margin-bottom: 0;">Vysoké Tatry • Absolvované 12. septembra 2026 • Nahral: Adrián Kres</p>
            </div>
            <div class="header-actions">
                <a href="<?= $link->url('hike.index') ?>" class="btn btn-secondary">← Späť na denník</a>
                <a href="<?= $link->url('hike.add') ?>" class="btn btn-secondary">Upraviť túru</a>
                <button type="button" class="btn btn-danger">Zmazať</button>
            </div>
        </div>

        <div class="metrics-grid">
            <div class="metric-box">
                <span class="metric-label">Vzdialenosť</span>
                <strong class="metric-value">15.8 km</strong>
            </div>
            <div class="metric-box">
                <span class="metric-label">Prevýšenie</span>
                <strong class="metric-value">1 360 m</strong>
            </div>
            <div class="metric-box">
                <span class="metric-label">Čas výstupu</span>
                <strong class="metric-value">6 h 15 min</strong>
            </div>
            <div class="metric-box">
                <span class="metric-label">GPX záznam</span>
                <strong class="metric-value">krivan_track.gpx</strong>
            </div>
        </div>

        <!-- 3D MapLibre Viewport -->
        <div class="map-viewport" role="region" aria-label="3D vizualizácia terénu">
            <svg class="map-svg-bg" viewBox="0 0 800 500" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="800" height="500" fill="#DDE8DF"/>
                <path d="M 0 380 L 180 210 L 340 290 L 540 95 L 690 230 L 800 170 L 800 500 L 0 500 Z" fill="#C7D9C9"/>
                <path d="M 0 430 L 220 310 L 410 350 L 610 190 L 800 280 L 800 500 L 0 500 Z" fill="#B5CCB8"/>
                <path d="M 110 440 Q 240 350 310 280 Q 430 190 540 98" fill="none" stroke="#E05429" stroke-width="6" stroke-linecap="round"/>
                <circle cx="110" cy="440" r="7" fill="#2E5238" stroke="#FFFFFF" stroke-width="2"/>
                <circle cx="540" cy="98" r="8" fill="#E05429" stroke="#FFFFFF" stroke-width="2"/>
            </svg>

            <div class="map-top-controls">
                <span class="floating-badge">3D Terén (MapLibre GL) • Aktívny</span>
                <button type="button" class="floating-btn">Prelet kamery ▶</button>
            </div>

            <div class="elevation-card">
                <div class="elevation-title">Výškový profil trasy (1 134 m ➔ 2 494 m n. m.)</div>
                <svg width="100%" height="55" viewBox="0 0 700 55" preserveAspectRatio="none">
                    <path d="M 0 50 L 160 32 L 320 18 L 480 5 L 620 30 L 700 48" fill="none" stroke="#70A642" stroke-width="3.5" stroke-linecap="round"/>
                    <path d="M 0 50 L 160 32 L 320 18 L 480 5 L 620 30 L 700 48 L 700 55 L 0 55 Z" fill="rgba(112, 166, 66, 0.15)"/>
                </svg>
            </div>
        </div>
    </section>

    <!-- PRAVÁ KARTA: DENNÍK, FOTOGALÉRIA A SPRÁVA STAVU -->
    <aside class="card side-panel" aria-label="Záznam z denníka a fotogaléria">
        <div>
            <h2>Záznam z denníka</h2>
            <p class="diary-note">
                Skvelé jesenné počasie, ráno mierny mráz v kosodrevine. Záver výstupu cez Daxnerov žľab náročný na orientáciu a prudké stúpanie po skale, ale kruhový výhľad z vrcholu Kriváňa na Západné a Vysoké Tatry stál za to.
            </p>
        </div>

        <div>
            <div class="section-header">
                <h2>Fotografie z výstupu (3)</h2>
                <a href="<?= $link->url('hike.add') ?>" class="btn btn-sm btn-primary">+ Nahrať foto</a>
            </div>

            <div class="photo-list">
                <article class="photo-item">
                    <div class="photo-thumb">FOTO 1</div>
                    <div class="photo-info">
                        <h4>1. Ranný pohľad na Kriváň od Jamského plesa</h4>
                        <p class="photo-meta">IMG_2026_01.jpg • 3.4 MB</p>
                        <div class="photo-actions">
                            <a href="<?= $link->url('hike.add') ?>">Upraviť popis</a>
                            <a href="<?= $link->url('hike.delete') ?>">Zmazať</a>
                        </div>
                    </div>
                </article>

                <article class="photo-item">
                    <div class="photo-thumb">FOTO 2</div>
                    <div class="photo-info">
                        <h4>2. Stúpanie cez Malú Krivánsku priehybu</h4>
                        <p class="photo-meta">IMG_2026_02.jpg • 4.1 MB</p>
                        <div class="photo-actions">
                            <a href="<?= $link->url('hike.add') ?>">Upraviť popis</a>
                            <a href="<?= $link->url('hike.delete') ?>">Zmazať</a>
                        </div>
                    </div>
                </article>

                <article class="photo-item">
                    <div class="photo-thumb">FOTO 3</div>
                    <div class="photo-info">
                        <h4>3. Vrcholový dvojkríž (2 494 m n. m.)</h4>
                        <p class="photo-meta">IMG_2026_03.jpg • 2.9 MB</p>
                        <div class="photo-actions">
                            <a href="<?= $link->url('hike.add') ?>">Upraviť popis</a>
                            <a href="<?= $link->url('hike.delete') ?>">Zmazať</a>
                        </div>
                    </div>
                </article>
            </div>
        </div>

        <div class="ajax-box">
            <span class="ajax-label">Rýchla úprava stavu (AJAX bez reloadu):</span>
            <div class="ajax-controls">
                <button type="button" class="btn btn-primary">✓ Absolvovaná túra</button>
                <button type="button" class="btn btn-secondary">Hodnotenie: ★★★★★</button>
            </div>
        </div>
    </aside>
</main>