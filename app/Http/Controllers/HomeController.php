<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Following;
use App\Invite;
use App\Pray;
use App\User;

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
    public function index(Request $request)
    {
        if (Session::get('lang')) {
            App::setLocale(Session::get('lang'));
        }
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return view('pages-404');
    }

    public function root()
    {
        $count = [
            User::where('is_admin', 0)->count(),
            Pray::count(),
            Invite::count(),
        ];

        $statistics = [];

        for ($month = 1; $month <= 12; $month++) {
            array_push($statistics, [
                User::where('is_admin', 0)->whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->count(),
                Pray::whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->count(),
                Invite::whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->count(),
            ]);
        }

        return view('index', ['count' => $count, 'statistics' => $statistics]);
    }
}
