<?php

declare(strict_types=1);

$statuses        = (new \App\Status())->getStatuses();

loadView('admin/statuses', ['statuses' => $statuses]);

