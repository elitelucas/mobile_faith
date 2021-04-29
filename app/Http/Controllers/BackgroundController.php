<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Background;
use Str, Input, File;

class BackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = Background::get();
        return view('faith.background.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('faith.background.create');
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

        $file = $request->file('file');
        $destinationPath = 'uploads/background/';
        $fileName = Str::random(5) . "." . $file->getClientOriginalExtension();
        $file->move($destinationPath, $fileName);

        $data['path'] = $destinationPath . $fileName;
        $data['origin_name'] = $file->getClientOriginalName();

        Background::create($data);

        return redirect(url("/background"));
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
        $record = Background::find($id);
        return view('faith.background.edit', ['record' => $record]);
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

        $record = Background::find($id);
        $record->update($data);

        return redirect(url("/background"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Background::find($id);
        File::delete(public_path($obj->path));
        $obj->delete();

        return redirect(url("/background"));
    }
}
