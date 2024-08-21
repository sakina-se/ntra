<?php


declare(strict_types=1);

$ads = (new \App\Branch())->getBranches();


loadView('admin/branches', ['ads' => $ads]);