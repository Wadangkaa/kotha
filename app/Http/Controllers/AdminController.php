<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminKothaResource;
use App\Models\Kotha;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $kothaCount = Kotha::count();
        $userCount = User::count();
        $approvedKothaCount = Kotha::where('status', 'approved')->count();
        $pendingKothaCount = Kotha::where('status', 'pending')->count();
        $rejectedKothaCount = Kotha::where('status', 'rejected')->count();
        return view('admin.dashboard', compact('kothaCount', 'userCount', 'approvedKothaCount', 'pendingKothaCount', 'rejectedKothaCount'));
    }
    public function index(){
        $kothas = Kotha::where('status', 'pending')->get();
        return view('admin.pendingKotha', compact('kothas'));
    }

    public function show(Kotha $kotha){
        return view('admin.adminKothaPerview', compact('kotha'));
    }

    public function approve(Kotha $kotha){
        $kotha->update([
            'status' => 'approved'
        ]);
        return redirect()->route('admin.index');
    }

    public function reject(Kotha $kotha){
        $kotha->update([
            'status' => 'rejected'
        ]);
        return redirect()->route('admin.index');
    }
}
