<?php

namespace App\Controllers;

use App\Models\Hike;
use App\Models\HikePhoto;
use App\Models\Mountain;
use App\Models\Rating;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class HikeController extends BaseController
{
    public function index(Request $request): Response
    {
        $hikes = Hike::getAll();
        $mountainFilter = trim((string)$request->value('mountain_filter'));
        $search = trim((string)$request->value('search'));

        if ($mountainFilter !== '' && $mountainFilter !== 'Všetky pohoria') {
            $hikes = array_filter($hikes, fn(Hike $h) => $h->getMountain() === $mountainFilter);
        }
        if ($search !== '') {
            $hikes = array_filter($hikes, fn(Hike $h) => stripos((string)$h->getTitle(), $search) !== false);
        }

        $mountains = Mountain::getAll();
        return $this->html([
            'hikes' => $hikes,
            'mountains' => $mountains,
            'selectedMountain' => $mountainFilter,
            'search' => $search
        ]);
    }

    public function detail(Request $request): Response
    {
        $id = (int)$request->value('id');
        $hike = $id > 0 ? Hike::getOne($id) : null;

        if ($hike === null) {
            $all = Hike::getAll();
            $hike = $all[0] ?? null;
        }

        return $this->html(['hike' => $hike]);
    }

    public function add(Request $request): Response
    {
        $hike = new Hike();
        $hike->setHikeDate(date('Y-m-d'));
        $hike->setStatus('Absolvovaná');
        $hike->setDifficulty('Stredná');

        return $this->html([
            'hike' => $hike,
            'mountains' => Mountain::getAll()
        ]);
    }

    public function edit(Request $request): Response
    {
        $id = (int)$request->value('id');
        $hike = Hike::getOne($id);

        if ($hike === null) {
            return $this->redirect($this->url('hike.index'));
        }

        return $this->html([
            'hike' => $hike,
            'mountains' => Mountain::getAll()
        ], 'add');
    }

    public function save(Request $request): Response
    {
        $id = (int)$request->value('id');

        if ($id > 0) {
            $hike = Hike::getOne($id);
            if ($hike === null) {
                return $this->redirect($this->url('hike.index'));
            }
        } else {
            $hike = new Hike();
            $hike->setUserId(1);
        }

        $mountainId = (int)$request->value('mountain_id');
        $mountainObj = $mountainId > 0 ? Mountain::getOne($mountainId) : null;
        if ($mountainObj === null) {
            $firstM = Mountain::getAll()[0] ?? null;
            $mountainId = $firstM ? (int)$firstM->getId() : 1;
            $mountainName = $firstM ? (string)$firstM->getName() : 'Vysoké Tatry';
        } else {
            $mountainName = (string)$mountainObj->getName();
        }

        $title = trim((string)$request->value('title'));
        $hikeDate = trim((string)$request->value('hike_date'));
        $gpxFile = trim((string)$request->value('gpx_file'));
        $status = trim((string)$request->value('status'));
        $difficulty = trim((string)$request->value('difficulty'));

        $hike->setMountainId($mountainId);
        $hike->setMountain($mountainName);
        $hike->setTitle($title !== '' ? $title : 'Nepomenovaná túra');
        $hike->setHikeDate($hikeDate !== '' ? $hikeDate : date('Y-m-d'));
        $hike->setDistance((float)$request->value('distance'));
        $hike->setElevation((int)$request->value('elevation'));
        $hike->setDifficulty($difficulty !== '' ? $difficulty : 'Stredná');
        $hike->setGpxFile($gpxFile !== '' ? $gpxFile : 'trasa.gpx');
        $hike->setStatus($status !== '' ? $status : 'Absolvovaná');
        $hike->setIsPublic($request->value('is_public') !== null ? 1 : 0);
        $hike->setDescription((string)$request->value('description'));

        $hike->save();

        return $this->redirect($this->url('hike.detail', ['id' => $hike->getId()]));
    }

    public function delete(Request $request): Response
    {
        $id = (int)$request->value('id');
        $hike = Hike::getOne($id);

        if ($hike !== null) {
            $hike->delete();
        }

        return $this->redirect($this->url('hike.index'));
    }

    // Praktická funkcia: Okamžitá zmena stavu túry priamo z tabuľky alebo detailu
    public function updateStatus(Request $request): Response
    {
        $id = (int)$request->value('id');
        $status = trim((string)$request->value('status'));
        $hike = Hike::getOne($id);

        if ($hike !== null && in_array($status, ['Absolvovaná', 'Plánovaná'], true)) {
            $hike->setStatus($status);
            $hike->save();
        }

        $back = (string)$request->value('redirect_to');
        if ($back === 'detail') {
            return $this->redirect($this->url('hike.detail', ['id' => $id]));
        }
        return $this->redirect($this->url('hike.index'));
    }

    // Praktická funkcia: Skopíruje cudziu túru z "Inšpiruj sa" do môjho denníka ako Plánovanú
    public function cloneToPlan(Request $request): Response
    {
        $id = (int)$request->value('id');
        $source = Hike::getOne($id);

        if ($source !== null) {
            $copy = new Hike();
            $copy->setUserId(1);
            $copy->setMountainId((int)$source->getMountainId());
            $copy->setMountain((string)$source->getMountain());
            $copy->setTitle($source->getTitle() . ' (Môj plán)');
            $copy->setHikeDate(date('Y-m-d'));
            $copy->setDistance((float)$source->getDistance());
            $copy->setElevation((int)$source->getElevation());
            $copy->setDifficulty((string)$source->getDifficulty());
            $copy->setGpxFile((string)$source->getGpxFile());
            $copy->setStatus('Plánovaná');
            $copy->setIsPublic(1);
            $copy->setDescription('Skopírované z komunitnej nástenky: ' . $source->getDescription());
            $copy->save();
        }

        return $this->redirect($this->url('hike.index'));
    }

    // Pridanie fotografie k túre v 3D detaile
    public function addPhoto(Request $request): Response
    {
        $hikeId = (int)$request->value('hike_id');
        $caption = trim((string)$request->value('caption'));
        $fileName = trim((string)$request->value('file_name'));

        if ($hikeId > 0 && $caption !== '') {
            $photo = new HikePhoto();
            $photo->setHikeId($hikeId);
            $photo->setCaption($caption);
            $photo->setFileName($fileName !== '' ? $fileName : 'IMG_' . rand(100, 999) . '.jpg');
            $photo->setFileSize(number_format(rand(22, 48) / 10, 1) . ' MB');
            $photo->save();
        }

        return $this->redirect($this->url('hike.detail', ['id' => $hikeId]));
    }

    public function deletePhoto(Request $request): Response
    {
        $photoId = (int)$request->value('photo_id');
        $hikeId = (int)$request->value('hike_id');
        $photo = HikePhoto::getOne($photoId);

        if ($photo !== null) {
            $photo->delete();
        }

        return $this->redirect($this->url('hike.detail', ['id' => $hikeId]));
    }

    // Pridanie komunitného hodnotenia a reportu podmienok
    public function addRating(Request $request): Response
    {
        $hikeId = (int)$request->value('hike_id');
        $stars = (int)$request->value('stars');
        $comment = trim((string)$request->value('comment'));
        $author = trim((string)$request->value('author_name'));

        if ($hikeId > 0 && $comment !== '') {
            $rating = new Rating();
            $rating->setHikeId($hikeId);
            $rating->setAuthorName($author !== '' ? $author : 'Adrián Kres');
            $rating->setStars($stars);
            $rating->setComment($comment);
            $rating->setCreatedAt(date('Y-m-d'));
            $rating->save();
        }

        return $this->redirect($this->url('hike.detail', ['id' => $hikeId]));
    }
}