<?php

namespace App\Http\Controllers;

use App\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LogsController
{
    protected $logs;

    public function __construct()
    {
        $this->logs = new Logs();
    }

    public function storePageVisit($n, $cats)
    {
        $array = [
            'datetime' => Carbon::now()->toDateTimeString(),
            'N' => $n,
            'cats' => $cats,
            'countAll' => $this->logs->getLastLogCount() + 1,
            'countN' => $this->logs->getLastNlogCount($n) + 1,
        ];

        $this->logs->addRow($array);
    }

    public function getCountAll()
    {
        return $this->logs->getLastLogCount();
    }

    public function getCountN($n)
    {
        return $this->logs->getLastNlogCount($n);
    }
}
