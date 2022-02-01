<?php

namespace App\Http\Controllers;

// use auth;
use App\Models\Movers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;

class MoversController extends Controller
{
    //
    public function create()
    {
        return view('layouts.create');
    }
    private function secure_random_string($length)
    {
        $random_string = '';
        for ($i = 0; $i < $length; $i++) {
            $number = random_int(0, 36);
            $character = base_convert($number, 10, 36);
            $random_string .= $character;
        }

        return $random_string;
    }
    public function store(Request $request)
    {
        $movers = new Movers();
        // $validated = $request->validate([
        //     'name' => 'required|max:50',
        //     'pnumber' => 'min:10|max:10',
        //     'email' => 'required',
        //     'apttype' => 'required',
        //     'apartmentNo' => 'required|numeric',
        //     'movingtype' => 'required',
        //     'moverscompany' => 'required',
        //     'movingItems' => 'required',
        // ]);


        //Generate Confirm Code
        $confirmCode = MoversController::secure_random_string(6);
        $movers->name = $request->input('name');
        $movers->pnumber = $request->input('pnumber');
        $movers->email = $request->input('email');
        $movers->apttype = $request->input('apttype');
        $movers->apartmentNo = $request->input('apartmentNo');
        $movers->movingtype = $request->input('movingtype');
        $movers->date_time = $request->input('date');
        $movers->moverscompany = $request->input('moverscompany');
        $movers->movingItems = $request->input('movingItems');
        $movers->permissionStatus = 'Pending';
        $movers->ccode = $confirmCode;
        $movers->save();
        // dd($movers);
        session(['ccode' => $movers->ccode]);
        return redirect()->route('thankyou');
    }


    public function confirm()

    {
        return view('layouts.confirm');
    }

    public function dashboard()

    {
        // dd(auth->user());
        $movers = Movers::all();
        // $movers = Movers::latest()->get();
        // $movers = DB::table('movers')
        // ->select()
        // ->orderBy('created_at', 'desc')
        // ->get();
        $movers = Movers::latest()->simplePaginate(10);
        // ->orderByDesc('membership.start_date');
        // ->paginate(10)
        // ->orderBy('created_at')
        // ->get();
        // ->orderby('created_at', 'desc')
        // ->get();
        return view('layouts.dashboard', ['movers' => $movers]);
    }

    //Show single user details    
    public function details($ccode)
    {
        $movers = Movers::where('ccode', '=', $ccode)->first();
        return view('layouts.details', ['singleMover' => $movers]);
    }

    //Status Check with CCODE
    public function statusq(Request $request)
    {
        $validated = $request->validate(['ccode' => 'required']);
        $movers = DB::table('movers as mv')
            ->select('usr.name as usr_name',  'mv.*', 'mv.name as mv_name')
            ->join('users as usr', 'usr.id', 'mv.user_incharge')
            ->where('mv.ccode', $request->ccode)
            ->first();


        // $movers = DB::table('movers as mv')
        //     ->join('users as usr.name', 'usr.id', 'mv.user_incharge')
        //     ->where('mv.ccode', $request->ccode)
        //     ->first();
        // if (!$movers) {
        //     return redirect()->back()->with(['error' => 'Error message']);
        // } else {
        return view('layouts.status', ['singleMover' => $movers]);
        // }
    }
    public function status()
    {
        return view('layouts.status');
    }

    public function thankyou()

    {
        return view('layouts.thankyou');
    }

    public function update(Request $request)
    {
        // dd(Auth::user()->id);
        $status = Movers::find($request->id);
        $status->permissionStatus = $request->statusValue;
        $status->user_incharge = Auth::user()->id;
        $status->save();

        return response()->json($status);
        // $status = Movers::findOrfail($id);
        // return view('layouts.details', ['singleMover' =>  $status]);
        // return view('layouts.details');
    }
}
