<?php

namespace App\Http\Controllers;

use App\Models\Kotha;
use App\Http\Controllers\esewaController;
use App\Http\Requests\KothaFilterRequest;
use App\Http\Requests\KothaStoreRequest;
use App\Models\Additional_info;
use App\Models\UserPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Traits\CheckOwnership;

class KothaController extends Controller
{
    use CheckOwnership;

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'filter']);
    }

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
        $kothas =  Kotha::where('status', 'approved')->paginate();
        sort($this->NepalDistrict);
        $NepalDistrict = $this->NepalDistrict;
        Session::put('active', 'allpost');

        if (auth()->user()) {
            $recommendated_kothas = null;
            $hasPerferences = UserPreference::where('user_id', auth()->user()->id)->count();

            if ($hasPerferences) {
                $user_preferences = UserPreference::where('user_id', auth()->user()->id)->first();

                if ($user_preferences) {
                    $recommendated_kothas = (new RecommendationController)->recommendateRoom($user_preferences);
                }
            }

            return view('dashboard', compact('NepalDistrict', 'kothas', 'recommendated_kothas'));
        } else {
            return view('dashboard', compact('NepalDistrict', 'kothas'));
        }
    }

    public function create()
    {
        sort($this->NepalDistrict);
        Session::put('active', 'create');
        return view('kothaform', ['NepalDistrict' => $this->NepalDistrict]);
    }

    public function store(KothaStoreRequest $request)
    {
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
                'user_id' => auth()->user()->id
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
        $ownership = $this->checkOwner(Kotha::class, $kotha->id);
        if ($ownership) {
            $status = $kotha->delete();
            return $status;
        }
        return redirect()->back();
    }

    public function showImages(Kotha $kotha)
    {
        $images = $kotha->images;
        return view('showImage', compact('images'));
    }

    public function filter(KothaFilterRequest $request)
    {
        sort($this->NepalDistrict);
        $district = $request['district'];
        $minPrice = $request->min_price;
        $maxPrice = $request->max_price;

        $kothas = Kotha::whereHas('location', function ($table) use ($district) {
            $table->where('district', $district);
        })->whereBetween('price', [$minPrice, $maxPrice])->paginate();
        return view('dashboard', ['NepalDistrict' => $this->NepalDistrict, 'kothas' => $kothas, 'selectedDistrict' => $district]);
    }
}
