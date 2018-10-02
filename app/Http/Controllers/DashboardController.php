<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Criteria;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function teacher()
    {
        return view('dashboard.teacher');
    }

    public function criteria()
    {
        return view('dashboard.criteria');
    }

    public function grade()
    {
        $criterias = Criteria::get();

        return view('dashboard.grade')
          ->with('criterias', $criterias);
    }
}
