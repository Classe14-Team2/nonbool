<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;


class ApartmentController extends Controller
{
    public function index(Request $request) {
      $apartments = Apartment::all();

      $id = $request->id;
      $user_id = $request->user_id;
      $title = $request->title;
      $description = $request->description;
      $rooms = $request->rooms;
      $beds = $request->beds;
      $baths = $request->baths;
      $square_meters = $request->square_meters;


      $query = Apartment::query();

      if ($id != null) {
        $query = $query->whereIn('id', $id);
      }
      if ($user_id != null) {
        $query = $query->whereIn('user_id', $user_id);
      }
      if ($title != null) {
        $query = $query->where('title', 'LIKE','%'.$title.'%');
      }
      if ($description != null) {
        $query = $query->where('description', 'LIKE', '%'.$description.'%');
      }

      if ($rooms != null) {
        $query = $query->where('rooms', $rooms);
      }
      if ($beds != null) {
        $query = $query->where('beds', $beds);
      }
      if ($baths != null) {
        $query = $query->where('baths', $baths);
      }
      if ($square_meters != null) {
        $query = $query->where('square_meters', $square_meters);
      }
      if ($square_meters != null) {
        $query = $query->where('city', $city);
      }

      $apartments = $query->get();




      return response()->json(compact('apartments'));
    }
}
