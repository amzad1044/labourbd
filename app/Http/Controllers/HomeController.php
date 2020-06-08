<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use App\Area;
use App\Labour;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard.home');
    }

    public function GetType()
    {
        $typeGet = Type::all();
        return $typeGet->count();
    }
    public function GetArea()
    {
        $areaGet = Area::all();
        return $areaGet->count();
    }

}
