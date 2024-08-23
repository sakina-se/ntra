<?php

namespace Controller;
use App\Branch;

class BranchController
{
    public function index(): void
    {

        $branches = (new \App\Branch())->getBranches();


        loadView('dashboard/branches', ['ads' => $branches]);
    }

    public function create(): void
    {
        $branch = new Branch();
        if ($_POST['branchName'] && $_POST['branchAddress']) {
            $branchName = $_POST['branchName'];
            $branchAddress = $_POST['branchAddress'];

            $stmt = $branch->createBranch($branchName, $branchAddress);

            if ($stmt) {
                header('Location: /branch');
                exit();
            }
        }
    }
}