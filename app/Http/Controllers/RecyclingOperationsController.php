<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\RecyclingOperations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class RecyclingOperationsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recyclings = Auth::user()->recycling()->orderBy('created_at', 'desc')->get();
        return view('recycling.index', compact('recyclings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recycling.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg|max:5120',
        ]);

        $user = User::find(Auth::user()->id);
        $recycling = new RecyclingOperations();
        $recycling->recycling_photo = asset(Storage::url($request->file('image')->store('public/recycling_photo')));
        $recycling->user_id = $user->id;
        $recycling->save();

        return redirect()->route('recycling.update', $recycling->id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, RecyclingOperations $recycling)
    {
        if(Auth::user()->id != $recycling->user->id){
            abort(403);
        }

        return view('recycling.update', compact('recycling'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecyclingOperations $recycling)
    {
        if($recycling->verified != 'bin_image_wait' || Auth::user()->id != $recycling->user->id){
            abort(403);
        }

        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg|max:10240',
            ]);

        $recycling->recycling_bin_photo = asset(Storage::url($request->file('image')->store('public/recycling_photo')));
        $recycling->verified = 'approved_wait';
        $recycling->save();

        return Redirect::to(route('recycling.index'))->with('message', 'Geri dönüşüm katkın sisteme kayıt edildi. Yakın zaman içinde yetkili kullanıcılar kontrol ettikten sonra onaylıyacaktır.');
    }

    public function waiting_approved(Request $request)
    {
        $recyclings = RecyclingOperations::where('verified', 'approved_wait')->get();
        return view('recycling.wait', compact('recyclings'));
    }

    public function confirm(Request $request, RecyclingOperations $recycling, $confirm)
    {
        if (!auth()->user()->can('recycling confirm')) {
            abort(403);
        }

        if($confirm == 'approved'){
            $recycling->verified = 'approved';
        }
        elseif($confirm == 'not_approved'){
            $recycling->verified = 'not_approved';
        }
        $recycling->save();

        return redirect()->route('recycling.waiting_approved');
    }

}
