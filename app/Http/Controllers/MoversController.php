<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Movers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $validated = $request->validate([
            'name' => 'required|max:50',
            'pnumber' => 'min:10|max:10',
            'email' => 'required',
            'apttype' => 'required',
            'apartmentNo' => 'required|numeric',
            'movingtype' => 'required',
            'moverscompany' => 'required',
            'movingItems' => 'required',
        ]);


        //Generate Confirm Code
        $confirmCode = MoversController::secure_random_string(6);
        $movers->name = $request->input('name');
        $movers->pnumber = $request->input('pnumber');
        $movers->email = $request->input('email');
        $movers->apttype = $request->input('apttype');
        $movers->apartmentNo = $request->input('apartmentNo');
        $movers->movingtype = $request->input('movingtype');
        $movers->moverscompany = $request->input('moverscompany');
        $movers->movingItems = $request->input('movingItems');
        $movers->permissionStatus = 'Pending';
        $movers->ccode = $confirmCode;
        $movers->save();

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
        $movers = Movers::simplePaginate(10);
        // ->paginate(10)
        // ->orderBy('created_at')
        // ->get();
        // ->orderby('created_at', 'desc')
        // ->get();
        return view('layouts.dashboard', ['movers' => $movers]);
    }

    public function details($ccode)
    {
        $movers = Movers::where('ccode', '=', $ccode)->first();
        return view('layouts.details', ['singleMover' => $movers]);
    }

    public function statusq(Request $request)
    {
        $validated = $request->validate(['ccode' => 'required']);
        $movers = Movers::where('ccode', '=', $request->ccode)->firstOrFail();
        if (!$movers) {
            return redirect()->back()->with(['error' => 'Error message']);
        } else {
            // dd($movers);
            return view('layouts.status', ['singleMover' => $movers]);
        }
    }
    public function status()
    {
        return view('layouts.status');
    }

    public function thankyou(Request $request)

    {
        // $movers = new Movers();
        // $movers->ccode = $request->$confirmCode;
        return view('layouts.thankyou');
    }

    public function update(Request $request)
    {
        $status = Movers::find($request->id);
        $status->permissionStatus = $request->statusValue;
        $status->save();

        return response()->json($status);
        // $status = Movers::findOrfail($id);
        // return view('layouts.details', ['singleMover' =>  $status]);
        // return view('layouts.details');
    }
}
