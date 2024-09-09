<?php

namespace Controller;

use App\Ads;
use App\Branch;
use App\Image;
use App\User;

class AdController
{
    private $pdo;

    public function index() {

    }

    public function create(): void
    {
        $title = $_POST['title'];
        $description = $_POST['desc'];
        $price = (float)$_POST['price'];
        $branch = (int)$_POST['branch_id'];
        $address = $_POST['address'];
        $rooms = (int)$_POST['rooms'];

        if ($_POST['title']
            && $_POST['desc']
            && $_POST['price']
            && $_POST['address']
            && $_POST['rooms']
        ) {
            $newAdsId = (new \App\Ads())->createAds(
                $title,
                $description,
                1,
                1,
                $branch,
                $address,
                $price,
                $rooms
            );

            if ($newAdsId) {
                $imageHandler = new \App\Image();
                $filename = $imageHandler->handleUpload();

                if (!$filename) {
                    exit('Rasm yuklanmadi!');
                }

                $imageHandler->addImage((int) $newAdsId, $filename);

                header('Location: /');

                exit();
            }
        }

        echo "Iltimos, barcha maydonlarni to'ldiring!";

    }

    public function show($id): void
    {

        /**
         * @var $id
         */

        $ad = (new \App\Ads())->getAdr($id);

        //$ad->image = "../assets/images/ads/$ad->image";

        loadView('single-ad', ['ad' => $ad]);

    }

    public function edit($id): void
    {
        /**
         * @var $id
         */

        $ad = (new \App\Ads())->getAdr($id);

        //$ad->image = "../assets/images/ads/$ad->image";

        loadView('update-ad', ['ad' => $ad], false);
    }

    public function update($id): void
    {
        $ad = (new \App\Ads())->getAdr($id);

        $title = $_POST['title'];
        $description = $_POST['desc'];
        $price = (float)$_POST['price'];
        $branch = (int)$_POST['branch_id'];
        $address = $_POST['address'];
        $rooms = (int)$_POST['rooms'];

        if ($_POST['title'] && $_POST['desc']
        && $_POST['price']
        && $_POST['address']
        && $_POST['rooms']) {

            $newAdsId = (new \App\Ads())->updateAds(
                $id,
                $title,
                $description,
                1,
                1,
                $branch,
                $address,
                $price,
                $rooms
            );
        }
    }

    public function search(): void
    {
        $searchPhrase  = $_REQUEST['search_phrase'];
        $branch = $_GET['branch'] ? $_GET['branch'] : null;

        $ads = (new \App\Ads())->search($searchPhrase, $branch);
        loadView('home', ['ads' => $ads]);
    }

    public function home(): void
    {
        $ads = (new \App\Ads())->getAds();

        $branches = (new Branch())->getBranches();

        loadView('home', ['ads' => $ads, 'branches' => $branches]);
    }
}