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

        // $test = $request->file('image')->getSize();

        // dd($test);
        // dd($request->all());
        $movers = new Movers();
        $request->validate([
            'name' => 'required|max:50',
            'pnumber' => 'min:10|max:10',
            'email' => 'required',
            'apttype' => 'required',
            'apartmentNo' => 'required|numeric',
            'movingtype' => 'required',
            'date_time' => 'required',
            'moverscompany' => 'required',
            'movingItems' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5045'
        ]);
        $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
        //Move image to different Folder
        $request->image->move(public_path('images'), $newImageName);

        //Generate Confirm Code
        $confirmCode = MoversController::secure_random_string(6);
        $movers->name = $request->input('name');
        $movers->pnumber = $request->input('pnumber');
        $movers->email = $request->input('email');
        $movers->apttype = $request->input('apttype');
        $movers->apartmentNo = $request->input('apartmentNo');
        $movers->movingtype = $request->input('movingtype');
        $movers->date_time = $request->input('date_time');
        $movers->moverscompany = $request->input('moverscompany');
        $movers->movingItems = $request->input('movingItems');
        $movers->permissionStatus = 'Pending';
        $movers->ccode = $confirmCode;
        $movers->image_path = $newImageName;
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
        $movers = Movers::latest()->simplePaginate(10);
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
        // $movers = DB::table('movers as mv')
        //     ->select('usr.name as usr_name',  'mv.*', 'mv.name as mv_name')
        //     ->join('users as usr', 'usr.id', 'mv.user_incharge')
        //     ->where('mv.ccode', $request->ccode)
        //     ->get();
        // ->first();
        $movers = DB::table('movers as mv')
            ->select('usr.name as usr_name',  'mv.*', 'mv.name as mv_name')
            ->join('users as usr', 'usr.id', 'mv.user_incharge')
            ->where('mv.ccode', $request->ccode)
            ->first();
        if ($movers) {
            // dd($movers);
            return view('layouts.status', ['singleMover' => $movers]);
        } elseif ($movers_2 = Movers::where('ccode', '=', $request->ccode)->first()) {
            return view('layouts.status', ['singleMover' => $movers_2]);
        } else {
            // dd($movers);
            // $movers['error'] = '';
            // dd($movers);
            return view('layouts.error', ['singleMover' => $movers]);
        }


        // return view('layouts.status', ['singleMover' => $movers]);
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
    }
    public function dashboardSearch(Request $request)
    {
        // dd($request->value);
        $movers = DB::table('movers')
            ->where('ccode', 'LIKE', '%' . $request->value . '%')->get();
        return  response()->json($movers);
        // return json_decode($movers);
        // $data = Movers::where('ccode', 'LIKE',  $request->ccode . '%')->get();
        // dd($data);
        //     $output = '';

        //     if (count($data) > 0) {

        //         $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';

        //         foreach ($data as $row) {

        //             $output .= '<li class="list-group-item">' . $row->name . '</li>';
        //         }

        //         $output .= '</ul>';
        //     } else {

        //         $output .= '<li class="list-group-item">' . 'No results' . '</li>';
        //     }

        //     return $output;
        // }

        // dd($request);
        // dd(Auth::user()->id);
        // dd($request->ccode);
        // $ccode = $request->ccode;
        // $status = Movers::where('ccode', '=', $ccode)->first();
        // dd($status);
        // $status->permissionStatus = $request->statusValue;
        // $status->user_incharge = Auth::user()->id;
        // $status->save();

        // return response()->json($status);
    }
}
