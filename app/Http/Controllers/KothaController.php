<?php

namespace App\Http\Controllers;

use App\Models\Kotha;
use App\Http\Controllers\esewaController;
use App\Models\Additional_info;
use App\Models\UserPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KothaController extends Controller
{
    private $NepalDistrict = [
        'Bhojpur', 'Dhankuta', 'Ilam', 'Jhapa', 'Khotang', 'Morang', 'Okhaldhunga', 'Panchthar', 'Sankhuwasabha', 'Solukhumbu', 'Sunsari', 'Taplejung', 'Terhathum', 'Udayapur',
        'Bara', 'Dhanusa', 'Mohattari', 'Parsa', 'Rautahat', 'Saptari', 'Sarlahi', 'Siraha',
        'Bhaktapur', 'Chitwan', 'Dhading', 'Dolakha', 'Kathmandu', 'Kavrepalanchok', 'Lalitpur', 'Makawanpur', 'Nuwakot', 'Ramechhap', 'Rasuwa', 'Sindhuli', 'Sindhupalchok',
        'Baglung', 'Gorkha', 'Kaski', 'Lamjung', 'Manang', 'Mustang', 'Mayagdi', 'Nawalpur', 'Parbat', 'Syangja', 'Tanahu',
        'Arghakhanchi', 'Banke', 'Bardiya', 'Dang', 'Gulmi', 'Kapilvastu', 'Parasi', 'Palpa', 'Pyuthan', 'Rolpa', 'Rukum', 'Rupandehi',
        'Dailekh', 'Dolpa', 'Humla', 'Jajarkot', 'Jumla', 'Kalikot', 'Mugu', 'Rukum', 'Salyan', 'Surkhet',
        'Achham', 'Baitadi', 'Bajhang', 'Bajura', 'Dadeldhura', 'Darchula', 'Doti', 'Kailali', 'Kanchanpur'
    ];


    public function index()
    {
        $kothas =  Kotha::with(
            'location',
            'map',
            'images',
            'contact',
            'location',
            'additionalInfo',
            'payment'
        )->get();

        $recommendated_kothas = null;
        $hasPerferences = UserPreference::where('user_id', auth()->user()->id)->count();

        if($hasPerferences){
            $user_preferences = UserPreference::where('user_id', auth()->user()->id)->first();

            if($user_preferences){
                $recommendated_kothas = (new RecommendationController)->recommendateRoom($user_preferences);
            }
        }

        
        sort($this->NepalDistrict);
        $NepalDistrict = $this->NepalDistrict;
        Session::put('active', 'allpost');
        return view('dashboard', compact('NepalDistrict','kothas', 'recommendated_kothas'));
    }

    public function create()
    {
        sort($this->NepalDistrict);
        Session::put('active', 'create');
        return view('kothaform', ['NepalDistrict' => $this->NepalDistrict]);
    }

    public function store(Request $request)
    {
        //validate form here
        $request = $request->validate(
            [
                'images' => 'required',
                'description' => 'required',
                'price' => 'required|numeric',
                'phone_no' => 'required|digits:10',
                'email' => 'required|email',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'district' => 'required',
                'city' => 'required',
                'street' => 'required',
                'additionalInfo' => 'nullable',
                'bedroom' => 'required_if:additionalInfo,1',
                'kitchen' => 'required_if:additionalInfo,1',
                'livingroom' => 'required_if:additionalInfo,1',
                'toilet' => 'required_if:additionalInfo,1',
                'parking' => 'nullable',
            ],
            [
                'phone_no' => [
                    'digits' => 'Must be 10 digits',
                    'required' => 'required'
                ],
                'district' => 'required',
                'city' => 'required',
                'street' => 'required',
            ]
        );
        //validation end


        DB::transaction(function () use ($request) {

            $kotha = Kotha::create([
                'description' => $request['description'],
                'price' => $request['price'],
                'user_id' => auth()->user()->id
            ]);

            $kotha->location()->create([
                'district' => $request['district'],
                'city' => $request['city'],
                'street' => $request['street']
            ]);

            $kotha->contact()->create([
                'phone_no' => $request['phone_no'],
                'email' => $request['email']
            ]);

            $kotha->map()->create([
                'longitude' => $request['longitude'],
                'latitude' => $request['latitude']
            ]);

            if (isset($request['additionalInfo'])) {
                $kotha->additionalInfo()->create([
                    'bedroom' => $request['bedroom'],
                    'kitchen' => $request['kitchen'],
                    'living_room' => $request['livingroom'],
                    'parking' => (isset($request['parking'])) ? true : false,
                    'toilet' => $request['toilet']
                ]);
            }

            if (isset($request['images'])) {
                foreach ($request['images'] as $image) {
                    $image_name =  $image->getClientOriginalName();

                    $kotha->images()->create([
                        'image_url' => $image_name,
                    ]);

                    $image->storeAs('public/uploads', $image_name);
                }
            }

            Session::put('new_kotha_id', $kotha->id);
        });
        return (new esewaController)->esewaPay();
    }

    public function show(Kotha $kotha)
    {
        $kotha->load([
            'location',
            'contact',
            'map',
            'additionalInfo',
            'images'
        ]);

        return view('detail', compact('kotha'));
    }

    public function edit(Kotha $kotha)
    {
    }

    public function update(Request $request, Kotha $kotha)
    {
        DB::transaction(function () use ($request, $kotha) {
            $kotha = Kotha::find($kotha->id);

            $kotha->update([
                'description' => $request['description'],
                'price' => $request['price'],
                'user_id' => Session::get('user_id')
            ]);

            $kotha->location->update([
                'district' => $request['district'],
                'city' => $request['city'],
                'street' => $request['street']
            ]);

            $kotha->contact->update([
                'phone_no' => $request['phone_no'],
                'email' => $request['email']
            ]);

            $kotha->map->update([
                'longitude' => $request['longitude'],
                'latitude' => $request['latitude']
            ]);

            if (isset($request['bedroom'])) {
                $kotha->additionalInfo->update([
                    'bedroom' => $request['bedroom'],
                    'kitchen' => $request['kitchen'],
                    'living_room' => $request['livingroom'],
                    'parking' => (isset($request['parking'])) ? true : false,
                    'toilet' => $request['toilet']
                ]);
            }
        });
        return true;
    }

    public function destroy(Kotha $kotha)
    {
        $status = $kotha->delete();
        return $status;
    }

    public function showImages(Kotha $kotha)
    {
        $images = $kotha->images;
        return view('showImage', compact('images'));
    }

    public function filter(Request $request)
    {
        sort($this->NepalDistrict);
        $district = $request['district'];
        $kothas = Kotha::whereHas('location', function ($table) use ($district) {
            $table->where('district', $district);
        })->get();
        return view('dashboard', ['NepalDistrict' => $this->NepalDistrict, 'kothas' => $kothas]);
    }
}
