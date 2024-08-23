<?php

namespace Controller;

use App\Image;
use App\User;

class AdController
{
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
}