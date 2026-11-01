<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @noinspection PhpUnhandledExceptionInspection */
?>
<div class="detail-grid">
    <!-- Zoznam pohorí (CRUD Read/Update/Delete) -->
    <section class="card">
        <div class="page-title-bar">
            <div>
                <h1>Slovenské pohoria</h1>
                <p class="subtitle">Prehľad regiónov a správa druhej hlavnej databázovej entity (MountainRange)</p>
            </div>
            <span class="badge badge-admin">Rola: Administrátor</span>
        </div>

        <div class="table-responsive">
            <table class="data-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Názov pohoria</th>
                    <th>Najvyšší vrchol</th>
                    <th>Počet túr</th>
                    <th>Správa (Admin CRUD)</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>#1</td>
                    <td><strong>Vysoké Tatry</strong><br><span class="subtitle">Najvyššie pohorie Slovenska s ľadovcovým reliéfom</span></td>
                    <td>Gerlachovský štít (2 655 m)</td>
                    <td><span class="badge badge-mountain">12 túr</span></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-secondary">Upraviť</button>
                        <button type="button" class="btn btn-sm btn-danger">Zmazať</button>
                    </td>
                </tr>
                <!-- Pre stručnosť môžeš doplniť ostatné riadky z pôvodného HTML -->
                </tbody>
            </table>
        </div>
    </section>

    <!-- Formulár pre pridanie/úpravu pohoria -->
    <aside class="card side-panel">
        <div>
            <h2>Pridať / Upraviť pohorie</h2>
            <p class="subtitle" style="margin-bottom: 16px;">Sekcia prístupná pre rolu Administrátor</p>

            <form action="<?= $link->url('mountain.index') ?>" method="post" style="display: flex; flex-direction: column; gap: 14px;">
                <div class="form-group">
                    <label class="form-label" for="m_name">Názov pohoria *</label>
                    <input type="text" id="m_name" class="form-control" placeholder="napr. Veľká Fatra" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="m_peak">Najvyšší vrchol a výška</label>
                    <input type="text" id="m_peak" class="form-control" placeholder="napr. Ostredok (1 596 m)">
                </div>

                <div class="form-group">
                    <label class="form-label" for="m_desc">Charakteristika pohoria *</label>
                    <textarea id="m_desc" rows="4" class="form-control" placeholder="Stručný opis pohoria..." required></textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="margin-top: 6px;">+ Uložiť pohorie do DB</button>
            </form>
        </div>
    </aside>
</div>