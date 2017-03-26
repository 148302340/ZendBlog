<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class centerController extends Controller
{
   public function getCenter()
   {
        return view('home.index');
   }
}
