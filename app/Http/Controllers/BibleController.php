<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bible;
use Str, File, Config;

class BibleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Bible::get();
        return view('faith.bible.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faith.bible.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $file = $request->file('audio_file');
        $destinationPath = 'uploads/bible/';
        $fileName = "{$request->damID}_{$request->bookID}_{$request->chapterID}" . "." . $file->getClientOriginalExtension();
        $file->move($destinationPath, $fileName);
        $data['audio_path'] = $destinationPath . $fileName;

        Bible::create($data);

        return redirect(url("/bible"));
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
        $record = Bible::find($id);
        return view('faith.bible.edit', ['record' => $record]);
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

        $record = Bible::find($id);

        $destinationPath = 'uploads/bible/';
        $fileName = "{$request->damID}_{$request->bookID}_{$request->chapterID}"  . ".mp3";
        if ($request->file('audio_file')) {
            File::delete(public_path($record->audio_path));

            $file = $request->file('audio_file');
            $file->move($destinationPath, $fileName);
        } else {
            File::move(public_path($record->audio_path), public_path($destinationPath . $fileName));
        }
        $data['audio_path'] =   $destinationPath . $fileName;

        $record->update($data);

        return redirect(url("/bible"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Bible::find($id);
        File::delete(public_path($obj->audio_path));
        $obj->delete();

        return redirect(url("/bible"));
    }
}
