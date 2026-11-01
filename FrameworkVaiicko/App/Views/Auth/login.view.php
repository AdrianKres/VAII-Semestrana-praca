<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @var \Framework\Support\View $view */
/** @noinspection PhpUnhandledExceptionInspection */

// Zmazali sme $view->setLayout('auth'); aby sa použil náš štandardný root layout
?>
<main class="auth-grid">
    <!-- Prihlásenie -->
    <section class="card">
        <div class="page-title-bar">
            <div>
                <h1>Prihlásenie</h1>
                <p class="subtitle">Vstúpte do svojho osobného denníka túr</p>
            </div>
        </div>

        <form action="<?= $link->url('hike.index') ?>" method="post" style="display: flex; flex-direction: column; gap: 16px;">
            <div class="form-group">
                <label class="form-label" for="login_email">E-mail alebo používateľské meno *</label>
                <input type="email" id="login_email" class="form-control" value="adrian.kres@uniza.sk" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="login_pass">Heslo *</label>
                <input type="password" id="login_pass" class="form-control" value="••••••••••••" required>
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 8px;">Prihlásiť sa do aplikácie →</button>
        </form>
    </section>

    <!-- Registrácia -->
    <section class="card">
        <div class="page-title-bar">
            <div>
                <h1>Nová registrácia</h1>
                <p class="subtitle">Vytvorte si účet pre ukladanie GPX trás a 3D máp</p>
            </div>
        </div>

        <form action="<?= $link->url('home.index') ?>" method="post" style="display: flex; flex-direction: column; gap: 16px;">
            <div class="form-group">
                <label class="form-label" for="reg_name">Používateľské meno *</label>
                <input type="text" id="reg_name" class="form-control" placeholder="napr. adrian_tatry" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="reg_email">E-mailová adresa *</label>
                <input type="email" id="reg_email" class="form-control" placeholder="meno@domena.sk" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="reg_pass">Heslo (min. 8 znakov, bcrypt hash) *</label>
                <input type="password" id="reg_pass" class="form-control" placeholder="Zadajte bezpečné heslo" required>
            </div>

            <button type="submit" class="btn btn-secondary" style="margin-top: 8px;">Vytvoriť účet turistu</button>
        </form>
    </section>
</main>