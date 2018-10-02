<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\Grade;
use Validator;
use DataTables;
use DB;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function table()
    {
        $grades = DB::table('grades')
          ->join('teachers', 'grades.teacher_id', '=', 'teachers.id')
          ->select('grades.*', 'teachers.nip as nip', 'teachers.nama as nama')
          ->get();

        return DataTables::of($grades)
          ->addColumn('action', function ($grades) {
            if (auth()->user()->role == 'penyeleksi') {
              return '
                <button class="btn btn-default show" data-id="'.$grades->id.'"><i class="fa fa-eye"></i></button>
                <button class="btn btn-info edit" data-id="'.$grades->id.'"><i class="fa fa-pencil-alt"></i></button>
              ';
            } else {
              return '
                <button class="btn btn-default show" data-id="'.$grades->id.'"><i class="fa fa-eye"></i></button>
              ';
            }
          })
          ->make(true);
    }

    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grade = DB::table('grades')
          ->join('teachers', 'grades.teacher_id', '=', 'teachers.id')
          ->select('grades.*', 'teachers.nip as nip', 'teachers.nama as nama')
          ->where('grades.id', '=', $id)
          ->first();

        return response()->json([
          'msg' => $grade,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grade = DB::table('grades')
          ->join('teachers', 'grades.teacher_id', '=', 'teachers.id')
          ->select('grades.*', 'teachers.nip as nip', 'teachers.nama as nama')
          ->where('grades.id', '=', $id)
          ->first();

        return response()->json([
          'msg' => $grade,
        ]);
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
        $grade = Grade::find($id);

        $validator = Validator::make($request->all(), [
          'c1' => 'required|numeric|min:1|max:5',
          'c2' => 'required|numeric|min:1|max:5',
          'c3' => 'required|numeric|min:1|max:5',
          'c4' => 'required|numeric|min:1|max:5',
          'c5' => 'required|numeric|min:1|max:5',
          'c6' => 'required|numeric|min:1|max:5',
          'c7' => 'required|numeric|min:1|max:5',
          'c8' => 'required|numeric|min:1|max:5',
          'c9' => 'required|numeric|min:1|max:5',
          'c10' => 'required|numeric|min:1|max:5',
          'c11' => 'required|numeric|min:1|max:5',
          'c12' => 'required|numeric|min:1|max:5',
          'c13' => 'required|numeric|min:1|max:5',
          'c14' => 'required|numeric|min:1|max:5',
        ]);

        if ($validator->fails()) {
          return response()->json([
            'errors' => $validator->getMessageBag()->toArray(),
          ]);
        } else {
          $grade->c1 = $request->c1;
          $grade->c2 = $request->c2;
          $grade->c3 = $request->c3;
          $grade->c4 = $request->c4;
          $grade->c5 = $request->c5;
          $grade->c6 = $request->c6;
          $grade->c7 = $request->c7;
          $grade->c8 = $request->c8;
          $grade->c9 = $request->c9;
          $grade->c10 = $request->c10;
          $grade->c11 = $request->c11;
          $grade->c12 = $request->c12;
          $grade->c13 = $request->c13;
          $grade->c14 = $request->c14;
          $grade->save();

          return response()->json([
            'msg' => $grade,
          ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
