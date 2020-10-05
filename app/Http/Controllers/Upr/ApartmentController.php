<?php

namespace App\Http\Controllers\Upr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Apartment;
use App\User;
use App\Service;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::all();
        $user = Auth::user();
        // dd('sono dentro appartamenti upr');
        return view('upr.apartments.index', compact('apartments', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $apartments = Apartment::all();
      $services = Service::all();

      return view('upr.apartments.create', compact('apartments', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
          abort('404');
        }

        // Validazione
        $request->validate($this->validationData());

        $request_data = $request->all();
        // dd($request_data);



        // Nuova istanza Appartamento
        $newApartment = new Apartment();
        $newApartment->user_id = Auth::id();
        $newApartment->fill($request_data);

        // dd($newApartment->user_id);

        if (isset($request_data['image'])) {
          $path = $request->file('image')->store('images', 'public');
          $newApartment->image = $path;
        } else {
          $newApartment->image = '';
        }
        $newApartment->save();


        if (isset($request_data['services'])) {
          $newApartment->services()->sync($request_data['services']);
        }

        // Mail::to($new_post->user->email)->send(new PostCreatedMail());

        return redirect()->route('upr.apartments.show', $newApartment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
      $users = User::all();
      $services = Service::all();
      $user_auth = Auth::user();
      // dd($users)
      return view('upr.apartments.show', compact('apartment', 'users', 'services', 'user_auth'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
      $services = Service::all();

      return view('upr.apartments.edit', compact('apartment', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
      if (!Auth::check()) {
      abort('404');
    }

    // Validazione
    $request->validate($this->validationData());

    $request_data = $request->all();

    if (isset($request_data['services'])) {
      $apartment->services()->sync($request_data['services']);
    } else {
      $apartment->services()->detach();
    }

    if (isset($request_data['image'])) {
      $path = $request->file('image')->store('images', 'public');
      $request_data['image'] = $path;
    } else {
      $request_data['image'] = '';
    }
    $apartment->update($request_data);

    $apartment->update($request_data);

    // Mail::to($post->user->email)->send(new PostEditedMail());

    return redirect()->route('upr.apartments.show', $apartment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
      $apartment->services()->detach();
      $apartment->sponsorships()->detach();
      $apartment->delete();
       // Mail::to($post->user->email)->send(new PostDeletedMail());
       return redirect()->route('upr.apartments.index');
    }

    public function validationData() {
       return [
         'title' => 'required|max:255',
         'content' => 'max:1000',
         'rooms' => 'required|min:1|max:10',
         'beds' => 'required|min:1|max:10',
         'baths' => 'required|min:1|max:5',
         'square_meters' => 'required|numeric|min:50|max:350',
         'address' => 'required|max:300',
         'image' => 'image',
       ];
     }
}
