<?php

namespace App;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Logs
{
    protected $filePath;
    protected $logs;

    public function __construct()
    {
        $this->filePath = storage_path('app\statistics\logs.json');
        $this->logs = json_decode(File::get($this->filePath), true);
    }

    public function addRow($array = [])
    {
        $this->logs[] = $array;
        File::put($this->filePath, json_encode($this->logs));
    }

    public function getLastLogCount()
    {
        $count = $this->logs ? count($this->logs) - 1 : 0;
        return $this->logs[$count]['countAll'];
    }

    public function getLastNlogCount($n)
    {
        $number = [0];
        foreach ($this->logs ?: [] as $log) {
            if ($log['N'] === $n) $number[] = $log['countN'];
        }
        return $number[count($number) - 1];
    }

}
