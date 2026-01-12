<?php

namespace App;

use Illuminate\Support\Facades\Log;

trait TestTrait
{
/*************  ✨ Windsurf Command ⭐  *************/
/*******  3da39bb7-5e57-49be-8e0c-b4ee5aed742a  *******/    //


    protected function uploadImage($file)
    {
        Log::info("ADfas");
        $this->upload($file);
    }
}
