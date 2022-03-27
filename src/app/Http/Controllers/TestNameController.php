<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TestName;

class TestNameController extends Controller
{
    public function create() {
        return view('testname');
    }

    public function store(Request $request) {
        $test = new TestName();
        $test->name = $request->name;
        $test->save();
        return redirect('/home');
    }
}