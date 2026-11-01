<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @noinspection PhpUnhandledExceptionInspection */
?>
<main class="card">
    <div class="page-title-bar">
        <div>
            <h1>Môj turistický denník</h1>
            <p class="subtitle">Správa vlastných záznamov, GPX trás a priama úprava stavov v tabuľke (AJAX in-place editing)</p>
        </div>
        <a href="<?= $link->url('hike.add') ?>" class="btn btn-primary">+ Pridať novú túru</a>
    </div>

    <!-- Štatistický prehľad -->
    <div class="metrics-grid">
        <div class="metric-box">
            <span class="metric-label">Celkovo záznamov</span>
            <strong class="metric-value">23 túr</strong>
        </div>
        <div class="metric-box">
            <span class="metric-label">Celková vzdialenosť</span>
            <strong class="metric-value">284.5 km</strong>
        </div>
        <div class="metric-box">
            <span class="metric-label">Celkové prevýšenie</span>
            <strong class="metric-value">18 450 m</strong>
        </div>
        <div class="metric-box">
            <span class="metric-label">Najvyšší bod</span>
            <strong class="metric-value">Ľadový štít (2 627 m)</strong>
        </div>
    </div>

    <!-- Lišta filtrovania tabuľky -->
    <div class="table-toolbar">
        <input type="search" class="search-input" placeholder="Filtrovať v tabuľke (AJAX)..." aria-label="Filtrovať v tabuľke">
        <div class="header-actions">
            <select class="inline-select" aria-label="Filtrovať podľa pohoria">
                <option>Všetky pohoria</option>
                <option>Vysoké Tatry</option>
                <option>Západné Tatry</option>
                <option>Nízke Tatry</option>
            </select>
        </div>
    </div>

    <!-- Dátová tabuľka -->
    <div class="table-responsive">
        <table class="data-table">
            <thead>
            <tr>
                <th>Názov výstupu</th>
                <th>Pohorie</th>
                <th>Dátum</th>
                <th>Parametre</th>
                <th>GPX súbor</th>
                <th>Stav (In-place AJAX)</th>
                <th>Akcie (CRUD)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><strong><a href="<?= $link->url('hike.detail') ?>" style="color: var(--text-dark); text-decoration: none;">Výstup na Kriváň (2 494 m)</a></strong></td>
                <td><span class="badge badge-mountain">Vysoké Tatry</span></td>
                <td>12. 09. 2026</td>
                <td>15.8 km • +1 360 m</td>
                <td><code>krivan_track.gpx</code></td>
                <td>
                    <select class="inline-select" aria-label="Stav túry">
                        <option selected>✓ Absolvovaná</option>
                        <option>Plánovaná</option>
                    </select>
                </td>
                <td>
                    <a href="<?= $link->url('hike.detail') ?>" class="btn btn-sm btn-secondary">3D Mapa</a>
                    <a href="<?= $link->url('hike.add') ?>" class="btn btn-sm btn-secondary">Upraviť</a>
                    <button type="button" class="btn btn-sm btn-danger">Zmazať</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</main>