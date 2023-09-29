<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Checkin;
use App\Models\Checkout;

class EditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function editin($id)
    {
        $data = Checkin::find($id); 
        return response()->json($data);
    }

    public function editout($id)
    {
        $data = Checkout::find($id); 
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function updatein(Request $request) 
    {
        $request->validate([
            'id' => 'required',
            'timein' => 'required'
        ]);

        $data = Checkin::find($request['id']);
        $data->timein = $request['timein'];
        $data->update();

        return response()->json($data);        

    }

    public function updateout(Request $request) 
    {
        $request->validate([
            'id' => 'required',
            'timeout' => 'required'
        ]);

        $data = Checkout::find($request['id']);
        $data->timeout = $request['timeout'];
        $data->update();

        return response()->json($data);        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
