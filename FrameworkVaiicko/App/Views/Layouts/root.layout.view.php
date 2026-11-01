<?php
/** @var string $contentHTML */
/** @var \Framework\Auth\AppUser $user */
/** @var \Framework\Support\LinkGenerator $link */
/** @noinspection PhpUnhandledExceptionInspection */
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExploreSlovakia</title>
    <link rel="stylesheet" href="<?= $link->asset('css/style.css') ?>">
</head>
<body>
<div class="app-container">
    <header class="app-header">
        <a href="<?= $link->url('home.index') ?>" class="brand">
            <svg class="brand-logo" viewBox="0 0 44 44" xmlns="http://www.w3.org/2000/svg">
                <rect width="44" height="44" rx="12" fill="#E6F2F7"/>
                <path d="M 2 34 L 11 19 L 19 27 L 33 15 L 42 34 Z" fill="#87BAD1"/>
                <path d="M 5 36 L 14 20 L 19 8 L 23 5 L 24 11 L 30 16 L 39 36 Z" fill="#266178"/>
                <path d="M 14 20 L 19 8 L 23 5 L 21 14 L 18 19 L 20 24 L 14 20 Z" fill="#FFFFFF"/>
                <path d="M 0 35 Q 15 26 30 34 L 44 37 L 44 44 L 0 44 Z" fill="#2E5238"/>
                <path d="M 8 44 Q 26 29 44 33 L 44 44 Z" fill="#70A642"/>
            </svg>
            <span class="brand-title">ExploreSlovakia</span>
        </a>

        <nav class="main-nav" aria-label="Hlavná navigácia">
            <a href="<?= $link->url('home.index') ?>" class="nav-link active">Inšpiruj sa</a>
            <a href="<?= $link->url('hike.index') ?>" class="nav-link">Moje túry</a>
            <a href="<?= $link->url('hike.detail') ?>" class="nav-link">3D Detail</a>
            <a href="<?= $link->url('mountain.index') ?>" class="nav-link">Pohoria</a>
        </nav>

        <div class="header-actions">
            <a href="<?= $link->url('hike.add') ?>" class="btn btn-primary">+ Nová túra</a>
            <a href="<?= $link->url('auth.login') ?>" class="user-pill" title="Prejsť na prihlásenie / profil">Adrián K.</a>
        </div>
    </header>

    <div class="shell-grid">
        <aside class="card sidebar-section" aria-label="Bočný panel">
            <!-- 1. VIZUÁLNE ODDELENÉ ŠTATISTIKY -->
            <div class="user-stats-widget" style="border-bottom: 2px solid #E6F2F7; padding-bottom: 20px; margin-bottom: 20px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: #266178; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.1em;">
                        AK
                    </div>
                    <div>
                        <strong style="display: block; color: #2E5238;">Adrián Kres</strong>
                        <span style="font-size: 0.85em; color: #555;">Moje štatistiky sezóny</span>
                    </div>
                </div>
                <div style="font-size: 0.9em; display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div><small style="color: #666;">Túry</small><br><strong style="font-size: 1.1em;">23</strong></div>
                    <div><small style="color: #666;">Vzdialenosť</small><br><strong style="font-size: 1.1em;">284 km</strong></div>
                    <div style="grid-column: span 2;"><small style="color: #666;">Celkové prevýšenie</small><br><strong style="font-size: 1.1em;">18 450 m</strong></div>
                </div>
            </div>

            <!-- 2. PREPRACOVANÉ FILTRE -->
            <div class="filters-section">
                <h2 style="margin-bottom: 16px; font-size: 1.2em;">Filtrovanie trás</h2>

                <form action="#" method="GET" class="filter-form">
                    <!-- Vyhľadávanie -->
                    <div style="margin-bottom: 20px;">
                        <input type="search" class="search-input" placeholder="Hľadať túru podľa názvu..." style="width: 100%;">
                    </div>

                    <!-- Pohorie (Checkbox) -->
                    <div class="filter-group" style="margin-bottom: 20px;">
                        <h3 style="font-size: 1em; margin-bottom: 8px; color: #266178;">Pohorie</h3>
                        <label style="display: block; margin-bottom: 6px; cursor: pointer;"><input type="checkbox"> Vysoké Tatry</label>
                        <label style="display: block; margin-bottom: 6px; cursor: pointer;"><input type="checkbox"> Západné Tatry</label>
                        <label style="display: block; margin-bottom: 6px; cursor: pointer;"><input type="checkbox"> Nízke Tatry</label>
                        <label style="display: block; margin-bottom: 6px; cursor: pointer;"><input type="checkbox"> Malá Fatra</label>
                    </div>

                    <!-- Náročnosť (Checkbox) -->
                    <div class="filter-group" style="margin-bottom: 20px;">
                        <h3 style="font-size: 1em; margin-bottom: 8px; color: #266178;">Náročnosť</h3>
                        <label style="display: block; margin-bottom: 6px; cursor: pointer;"><input type="checkbox"> Ľahká (rodinná)</label>
                        <label style="display: block; margin-bottom: 6px; cursor: pointer;"><input type="checkbox"> Stredná</label>
                        <label style="display: block; margin-bottom: 6px; cursor: pointer;"><input type="checkbox"> Ťažká (celodenná)</label>
                        <label style="display: block; margin-bottom: 6px; cursor: pointer;"><input type="checkbox"> Extrémna (ferraty/lezenie)</label>
                    </div>

                    <!-- Dĺžka túry (Radio buttons - lebo zvyčajne hľadáš jeden interval) -->
                    <div class="filter-group" style="margin-bottom: 20px;">
                        <h3 style="font-size: 1em; margin-bottom: 8px; color: #266178;">Dĺžka túry</h3>
                        <label style="display: block; margin-bottom: 6px; cursor: pointer;"><input type="radio" name="dlzka"> Do 5 km</label>
                        <label style="display: block; margin-bottom: 6px; cursor: pointer;"><input type="radio" name="dlzka"> 5 - 15 km</label>
                        <label style="display: block; margin-bottom: 6px; cursor: pointer;"><input type="radio" name="dlzka"> 15 - 25 km</label>
                        <label style="display: block; margin-bottom: 6px; cursor: pointer;"><input type="radio" name="dlzka"> Nad 25 km</label>
                    </div>

                    <button type="button" class="btn btn-secondary" style="width: 100%;">Aplikovať filtre</button>
                </form>
            </div>
        </aside>

        <main class="card">
            <?= $contentHTML ?>
        </main>
    </div>

    <footer class="app-footer">
        ExploreSlovakia 2026 • Semestrálna práca VAII (UNIZA FRI) • Autor: Adrián Kres •
        <a href="<?= $link->url('auth.login') ?>">Prihlásenie</a>
    </footer>
</div>
</body>
</html>