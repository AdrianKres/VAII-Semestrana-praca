<?php
namespace App\Controllers;

use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class AuthController extends BaseController
{
    // Povinná metóda pre každý kontrolér vo frameworku Vaííčko
    public function index(Request $request): Response
    {
        // Ak používateľ pristúpi na ?c=auth, presmerujeme ho na prihlásenie
        return $this->redirect($this->url('auth.login'));
    }

    public function login(Request $request): Response
    {
        // Zatiaľ nevyžadujeme reálne prihlasovanie, len vrátime náš statický pohľad
        return $this->html();
    }
}