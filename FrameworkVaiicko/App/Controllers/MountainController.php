<?php

namespace App\Controllers;

use App\Models\Mountain;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class MountainController extends BaseController
{
    public function index(Request $request): Response
    {
        $mountains = Mountain::getAll();
        return $this->html(['mountains' => $mountains]);
    }

    public function save(Request $request): Response
    {
        $name = trim((string)$request->value('name'));
        $peak = trim((string)$request->value('highest_peak'));
        $elevation = (int)$request->value('elevation');
        $desc = trim((string)$request->value('description'));

        if ($name !== '' && $peak !== '' && $elevation > 0) {
            $mountain = new Mountain();
            $mountain->setName($name);
            $mountain->setHighestPeak($peak);
            $mountain->setElevation($elevation);
            $mountain->setDescription($desc);
            $mountain->save();
        }

        return $this->redirect($this->url('mountain.index'));
    }

    public function delete(Request $request): Response
    {
        $id = (int)$request->value('id');
        $mountain = Mountain::getOne($id);

        if ($mountain !== null && $mountain->getHikeCount() === 0) {
            $mountain->delete();
        }

        return $this->redirect($this->url('mountain.index'));
    }
}