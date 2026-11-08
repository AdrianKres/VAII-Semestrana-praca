<?php

namespace App\Controllers;

use App\Models\Hike;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class HomeController extends BaseController
{
    public function index(Request $request): Response
    {
        $allHikes = Hike::getAll('is_public = 1');

        $q = trim((string)$request->value('q'));
        $selectedMountains = $request->value('mountains') ?? [];
        $selectedDifficulties = $request->value('difficulties') ?? [];
        $lengthFilter = (string)$request->value('dlzka');
        $minRating = (int)$request->value('min_rating');

        if (!is_array($selectedMountains)) $selectedMountains = [$selectedMountains];
        if (!is_array($selectedDifficulties)) $selectedDifficulties = [$selectedDifficulties];

        // Praktické filtrovanie na základe požiadaviek používateľa
        $filteredHikes = array_filter($allHikes, function (Hike $hike) use ($q, $selectedMountains, $selectedDifficulties, $lengthFilter, $minRating) {
            if ($q !== '' && stripos((string)$hike->getTitle(), $q) === false && stripos((string)$hike->getDescription(), $q) === false) {
                return false;
            }
            if (!empty($selectedMountains) && !in_array($hike->getMountain(), $selectedMountains, true)) {
                return false;
            }
            if (!empty($selectedDifficulties) && !in_array($hike->getDifficulty(), $selectedDifficulties, true)) {
                return false;
            }
            $dist = (float)$hike->getDistance();
            if ($lengthFilter === 'under5' && $dist > 5) return false;
            if ($lengthFilter === '5to15' && ($dist < 5 || $dist > 15)) return false;
            if ($lengthFilter === '15to25' && ($dist < 15 || $dist > 25)) return false;
            if ($lengthFilter === 'over25' && $dist <= 25) return false;

            if ($minRating > 0 && $hike->getAverageRating() < $minRating) {
                return false;
            }
            return true;
        });

        return $this->html(['hikes' => $filteredHikes]);
    }
}