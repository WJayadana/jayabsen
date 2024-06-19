<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaturan = Pengaturan::first();
        return view('website.pengaturan.index', compact('pengaturan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request)
    {
        Pengaturan::updateOrCreate([
            'id' => $request->id,
        ],[
            'mode' => $request->mode ? $request->mode : 'masuk',
            'secret_key' => $request->new_secret_key ? Pengaturan::quickRandom(16) : $request->secret_key
        ]);

        toastr('Setting Updated Successfully', 'success', 'Setting', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('pengaturans.index');
    }
}
