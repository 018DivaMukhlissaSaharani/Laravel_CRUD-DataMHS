<?php

namespace App\Http\Controllers;

use App\Major;
use Illuminate\Http\Request;

class MajorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = 4;
        $search = $request->text_search;
        $majors = Major::where('major_code', 'like', "%" . $search . "%")->orwhere('major_name', 'like', "%" . $search . "%")->orderBy('major_code', 'asc')->paginate($limit);
        $major_count = Major::count();
        $no = $limit * ($majors->currentPage() - 1);
        return view('majors.index', compact('majors', 'major_count', 'search', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'major_code' => 'required',
            'major_name' => 'required'
        ]);

        Major::create($request->all());
        return redirect('/majors')->with('message', 'Data Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function show(Major $major)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function edit(Major $major)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Major $major)
    {
        $request->validate([
            'major_code' => 'required',
            'major_name' => 'required'
        ]);

        Major::where('id', $major->id)
            ->update([
                'major_code' => $request->major_code,
                'major_name' => $request->major_name

            ]);
        return redirect('/majors')->with('message', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function destroy(Major $major)
    {
        Major::destroy($major->id);
        return redirect('/majors')->with('message', 'Data deleted successfully');
    }
}
