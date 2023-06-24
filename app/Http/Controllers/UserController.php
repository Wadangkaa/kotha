<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Console\View\Components\Alert as ComponentsAlert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('active', 'login');
        return view('loginform');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::put('active', 'register');
        return view('signupForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        $user_preferences = [
            'district' => 'Kathmandu',
            'price' => [15000, 20000],
            'parking' => 'Yes'
        ];

        DB::transaction(function () use ($validatedData, $request) {
            $user = User::create([
                'fname' => $validatedData['fname'],
                'lname' => $validatedData['lname'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password']
            ]);

            $user->preferences()->create([
                'district' => $request->preferences_district,
                'min_price' => $request->preferences_max_price,
                'max_price' => $request->preferences_min_price,
                'parking' => $request->preferences_parking ? 1 : 0
            ]);
        });




        // $recommended_room_ids = (new RecommendationController)->recommendateRoom($user_preferences);

        return view('loginform');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('test', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = User::find($user);

        $user->fname = $request['fname'];
        $user->lname = $request['lname'];
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->password = $request['password'];

        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        echo 'from destroy method';
    }

    public function openPreferencesForm()
    {
        $NepalDistricts = [
            'Bhojpur', 'Dhankuta', 'Ilam', 'Jhapa', 'Khotang', 'Morang', 'Okhaldhunga', 'Panchthar', 'Sankhuwasabha', 'Solukhumbu', 'Sunsari', 'Taplejung', 'Terhathum', 'Udayapur',
            'Bara', 'Dhanusa', 'Mohattari', 'Parsa', 'Rautahat', 'Saptari', 'Sarlahi', 'Siraha',
            'Bhaktapur', 'Chitwan', 'Dhading', 'Dolakha', 'Kathmandu', 'Kavrepalanchok', 'Lalitpur', 'Makawanpur', 'Nuwakot', 'Ramechhap', 'Rasuwa', 'Sindhuli', 'Sindhupalchok',
            'Baglung', 'Gorkha', 'Kaski', 'Lamjung', 'Manang', 'Mustang', 'Mayagdi', 'Nawalpur', 'Parbat', 'Syangja', 'Tanahu',
            'Arghakhanchi', 'Banke', 'Bardiya', 'Dang', 'Gulmi', 'Kapilvastu', 'Parasi', 'Palpa', 'Pyuthan', 'Rolpa', 'Rukum', 'Rupandehi',
            'Dailekh', 'Dolpa', 'Humla', 'Jajarkot', 'Jumla', 'Kalikot', 'Mugu', 'Rukum', 'Salyan', 'Surkhet',
            'Achham', 'Baitadi', 'Bajhang', 'Bajura', 'Dadeldhura', 'Darchula', 'Doti', 'Kailali', 'Kanchanpur'
        ];
        return view('auth.userPerferences', compact('NepalDistricts'));
    }

    public function preferences(Request $request)
    {
        auth()->user()->preferences()->create([
            'district' => $request->user_perfered_district,
            'min_price' => $request->min_price ?? 0,
            'max_price' => $request->max_price,
            'parking' => $request->parking ? true :  false
        ]);

        return redirect()->route('kotha.index');
    }
}
