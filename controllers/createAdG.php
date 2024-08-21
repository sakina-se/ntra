<?php

$branches = (new App\Branch())->getBranches();
$ads = (new \App\Ads())->getAds();

loadView('admin/create-ad', ['branches' => $branches, 'ads' => $ads]);
?>
