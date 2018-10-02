<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Criteria;
use Validator;
use DataTables;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function table()
    {
        $criterias = Criteria::get();

        return DataTables::of($criterias)
          ->addColumn('action', function ($criterias) {
            if (auth()->user()->role == 'operator')
            return '
              <button class="btn btn-info edit" data-id="'.$criterias->id.'"><i class="fa fa-pencil-alt"></i></button>
            ';
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
        $criteria = Criteria::find($id);

        return response()->json([
          'msg' => $criteria,
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
        $criteria = Criteria::find($id);

        $validator = Validator::make($request->all(), [
          'grade' => 'required|numeric|min:1|max:5',
        ]);

        if ($validator->fails()) {
          return response()->json([
            'errors' => $validator->getMessageBag()->toArray(),
          ]);
        } else {
          $criteria->grade = $request->grade;
          $criteria->save();

          return response()->json([
            'msg' => $criteria,
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
