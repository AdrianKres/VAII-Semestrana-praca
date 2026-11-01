<?php

/** @var \Framework\Support\LinkGenerator $link */
?>

<main class="card">
    <div class="page-title-bar">
        <div>
            <h1>Turistom sa páči</h1>
            <p class="subtitle">Prezri si komunitou zverejnené trasy a naplánuj si svoje daľšie dobrodružstvo!</p>
        </div>
        <a href="<?= $link->url('hike.form') ?>" class="btn btn-primary">+ Pridať záznam túry</a>
    </div>

    <div class="hikes-grid">
        <!-- Karta 1 -->
        <article class="hike-card">
            <div class="hike-card-thumb">
                <span class="hike-card-badge">Vysoké Tatry</span>
                <svg viewBox="0 0 400 160" preserveAspectRatio="none">
                    <rect width="400" height="160" fill="#DDE8DF"/>
                    <path d="M 0 140 L 110 55 L 210 95 L 310 25 L 400 110 L 400 160 L 0 160 Z" fill="#B5CCB8"/>
                    <path d="M 50 145 Q 150 90 310 28" fill="none" stroke="#E05429" stroke-width="4"
                          stroke-linecap="round"/>
                </svg>
            </div>
            <div class="hike-card-body">
                <h3>Výstup na Kriváň (2 494 m)</h3>
                <div class="hike-card-stats">
                    <span>📏 15.8 km</span>
                    <span>⛰️ +1 360 m</span>
                    <span>⏱️ 6h 15m</span>
                </div>
                <p class="subtitle">Klasická hrebeňová trasa z Troch studničiek s 3D GPX záznamom.</p>
                <div class="hike-card-footer">
                    <span>12. sep 2026 • Adrián K.</span>
                    <a href="<?= $link->url('hike.detail') ?>" class="btn btn-sm btn-primary">3D Detail →</a>
                </div>
            </div>
        </article>

        <!-- Karta 2 -->
        <article class="hike-card">
            <div class="hike-card-thumb">
                <span class="hike-card-badge">Vysoké Tatry</span>
                <svg viewBox="0 0 400 160" preserveAspectRatio="none">
                    <rect width="400" height="160" fill="#E3EDF2"/>
                    <path d="M 0 135 L 95 70 L 245 30 L 340 85 L 400 60 L 400 160 L 0 160 Z" fill="#9BBCD0"/>
                    <path d="M 40 140 Q 160 75 245 32" fill="none" stroke="#E05429" stroke-width="4"
                          stroke-linecap="round"/>
                </svg>
            </div>
            <div class="hike-card-body">
                <h3>Prechod cez Rysy (2 503 m)</h3>
                <div class="hike-card-stats">
                    <span>📏 21.4 km</span>
                    <span>⛰️ +1 290 m</span>
                    <span>⏱️ 7h 10m</span>
                </div>
                <p class="subtitle">Výstup od Štrbského plesa okolo Chaty pod Rysmi s výhľadom na Morskie
                    Oko.</p>
                <div class="hike-card-footer">
                    <span>28. aug 2026 • Adrián K.</span>
                    <a href="<?= $link->url('hike.detail') ?>" class="btn btn-sm btn-primary">3D Detail →</a>
                </div>
            </div>
        </article>

        <!-- Karta 3 -->
        <article class="hike-card">
            <div class="hike-card-thumb">
                <span class="hike-card-badge">Vysoké Tatry</span>
                <svg viewBox="0 0 400 160" preserveAspectRatio="none">
                    <rect width="400" height="160" fill="#E6EBE4"/>
                    <path d="M 0 145 L 140 40 L 220 65 L 310 20 L 400 125 L 400 160 L 0 160 Z" fill="#A7C0AC"/>
                    <path d="M 70 135 L 140 42 L 310 22" fill="none" stroke="#E05429" stroke-width="4"
                          stroke-linecap="round"/>
                </svg>
            </div>
            <div class="hike-card-body">
                <h3>Ľadový štít cez Koňarčinu (2 627 m)</h3>
                <div class="hike-card-stats">
                    <span>📏 18.2 km</span>
                    <span>⛰️ +1 580 m</span>
                    <span>⏱️ 8h 00m</span>
                </div>
                <p class="subtitle">Vysokohorský hrebeňový výstup na tretí najvyšší vrchol Tatier.</p>
                <div class="hike-card-footer">
                    <span>04. aug 2026 • Adrián K.</span>
                    <a href="<?= $link->url('hike.detail') ?>" class="btn btn-sm btn-primary">3D Detail →</a>
                </div>
            </div>
        </article>

        <!-- Karta 4 -->
        <article class="hike-card">
            <div class="hike-card-thumb">
                <span class="hike-card-badge">Nízke Tatry</span>
                <svg viewBox="0 0 400 160" preserveAspectRatio="none">
                    <rect width="400" height="160" fill="#E8F0E4"/>
                    <path d="M 0 120 Q 120 50 220 65 Q 320 35 400 90 L 400 160 L 0 160 Z" fill="#B5D1A3"/>
                    <path d="M 30 125 Q 190 55 350 65" fill="none" stroke="#E05429" stroke-width="4"
                          stroke-linecap="round"/>
                </svg>
            </div>
            <div class="hike-card-body">
                <h3>Hrebeňovka: Ďumbier a Chopok</h3>
                <div class="hike-card-stats">
                    <span>📏 16.5 km</span>
                    <span>⛰️ +1 040 m</span>
                    <span>⏱️ 5h 40m</span>
                </div>
                <p class="subtitle">Panoramatická hrebeňová túra cez najvyššie vrcholy Nízkych Tatier.</p>
                <div class="hike-card-footer">
                    <span>19. júl 2026 • Nikola</span>
                    <a href="<?= $link->url('hike.detail') ?>" class="btn btn-sm btn-primary">3D Detail →</a>
                </div>
            </div>
        </article>
    </div>
</main>