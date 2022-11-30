<?php

namespace App\Http\Controllers;

use App\Student;
use App\Major;
use App\Course;
//use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class StudentsController extends Controller
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
        $students = Student::where('name', 'like', "%" . $search . "%")->orwhere('nim', 'like', "%" . $search . "%")->orderBy('id', 'asc')->paginate($limit);
        $student_count = Student::count();
        $major_list = Major::all()->sortBy('major_code');
        $course_list = Course::all();
        $no = $limit * ($students->currentPage() - 1);
        return view('students.index', compact('students', 'student_count', 'major_list', 'course_list', 'no', 'search'));
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
            'nim' => 'required',
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'images' => 'required|image|mimes:jpeg,jpg,png',
            'course_id' => 'required',
            'major_id' => 'required',
        ]);

        $students = new Student;
        $students->nim = $request->nim;
        $students->name = $request->name;
        $students->email = $request->email;
        $students->address = $request->address;
        $students->course_id = $request->course_id;
        $students->major_id = $request->major_id;
        $students->name_seo = Str::slug($request->name);

        $images = $request->images;
        $filename = time() . '.' . $images->getClientOriginalExtension();

        //Image::make($images)->resize(180, 130)->save('thumb/' . $filename);
        $images->move('images/', $filename);

        $students->images = $filename;
        $students->save();

        // Student::create($request->all());
        return redirect('/students')->with('message', 'Data Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $major_list = Major::all()->sortBy('major_code');
        $course_list = Course::all();
        return view('students.show', compact('student', 'major_list', 'course_list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required',
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'images' => 'image|mimes:jpeg,jpg,png',
            'course_id' => 'required',
            'major_id' => 'required'
        ]);

        $students = Student::find($id);
        if ($request->has('images')) {
            $students->nim = $request->nim;
            $students->name = $request->name;
            $students->email = $request->email;
            $students->address = $request->address;
            $students->course_id = $request->course_id;
            $students->major_id = $request->major_id;
            $students->name_seo = Str::slug($request->name);

            $images = $request->images;
            $filename = time() . '.' . $images->getClientOriginalExtension();
            $images->move('images/', $filename);
            $students->images = $filename;
        } else {
            $students->nim = $request->nim;
            $students->name = $request->name;
            $students->email = $request->email;
            $students->address = $request->address;
            $students->course_id = $request->course_id;
            $students->major_id = $request->major_id;

            $students->name_seo = Str::slug($request->name);
        }

        $students->update();
        return redirect('/students')->with('message', 'Data Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Student $student)
    {
        $students = Student::find($student->id);

        $students->nim = $request->nim;
        $students->name = $request->name;
        $students->email = $request->email;
        $students->address = $request->address;
        $students->course_id = $request->course_id;
        $students->major_id = $request->major_id;

        $filename = $students->images;
        File::delete('images/' . $filename);
        $students->delete();
        return redirect('/students')->with('message', 'Data student deleted successfully');
    }
}
