<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{

    public function getUpdate()
    {

    }

    public function action(Request $request)
    {
        // Move or Shoot or Pickup Item
    }

    public function status()
    {
        // you have {x] health
    }

    public function log()
    {
        // You got shot by {x}
    }


}
