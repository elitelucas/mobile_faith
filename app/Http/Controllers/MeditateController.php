<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meditate;
use Str, Input, File;

class MeditateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->type;
        $records = Meditate::where('type', $type)->get();
        return view('faith.meditate.index', ['records' => $records, 'type' => $type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type = $request->type;
        return view('faith.meditate.create', ['type' => $type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = $request->type;

        $data = $request->all();

        $file = $request->file('file');
        $destinationPath = 'uploads/meditate/';
        $fileName = Str::random(5) . "." . $file->getClientOriginalExtension();
        $file->move($destinationPath, $fileName);

        if ($type == 'image')
            $data['image_path'] = $destinationPath . $fileName;
        if ($type == 'audio')
            $data['audio_path'] = $destinationPath . $fileName;

        Meditate::create($data);

        return redirect(url("/meditate?type=$type"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Meditate::find($id);
        return view('faith.meditate.edit', ['record' => $record]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['locked'] = $request->has('locked');       

        $record = Meditate::find($id);
        $record->update($data);

        return redirect(url("/meditate?type={$record->type}"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Meditate::find($id);
        File::delete(public_path($obj->image_path));
        File::delete(public_path($obj->audio_path));
        $obj->delete();

        return redirect(url("/meditate?type={$obj->type}"));
    }
}
