<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @noinspection PhpUnhandledExceptionInspection */
?>
<main class="card form-container">
    <div class="page-title-bar">
        <div>
            <h1>Pridať / Upraviť záznam túry</h1>
            <p class="subtitle">Vyplňte parametre výstupu a priložte GPX súbor pre vygenerovanie 3D trasy</p>
        </div>
        <a href="<?= $link->url('hike.index') ?>" class="btn btn-secondary">← Späť na denník</a>
    </div>

    <form action="<?= $link->url('hike.index') ?>" method="post">
        <div class="form-grid">
            <div class="form-group full-width">
                <label class="form-label" for="title">Názov túry / vrcholu *</label>
                <input type="text" id="title" class="form-control" value="Výstup na Kriváň (2 494 m n. m.)" required>
                <span class="form-hint">Povinné pole (min. 5 znakov, kontrolované na strane klienta aj servera).</span>
            </div>

            <!-- Pre stručnosť sú tu vynechané ostatné inputy formulára z pôvodného html (Pohorie, Dátum, atď.).
                 Môžeš si ich sem nakopírovať podľa vzoru z hike-form.html -->

            <div class="form-group full-width">
                <label class="form-label" for="description">Poznámky z denníka a podmienky na trase</label>
                <textarea id="description" rows="4" class="form-control">Skvelé jesenné počasie...</textarea>
            </div>
        </div>

        <div class="form-actions">
            <a href="<?= $link->url('hike.index') ?>" class="btn btn-secondary">Zrušiť</a>
            <button type="submit" class="btn btn-primary">Uložiť záznam a zobraziť 3D mapu</button>
        </div>
    </form>
</main>