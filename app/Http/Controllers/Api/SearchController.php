<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Service;

class SearchController extends Controller
{
  public function view() {
    $apartments = Apartment::all();
    // $services = Service::all();

    return response()->json(compact('apartments'));


  }
}
