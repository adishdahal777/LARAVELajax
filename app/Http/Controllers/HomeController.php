<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return view('home');
    }

    public function store(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'fullname' => "required",
            "email" => "required",
            "phone" => "required",
            "address" => "required",
            "gender" => "required",
        ]);

        if ($validated->fails()) {
            return response()->json(['success' => false, 'message' => $validated->errors()], 200);
        }

        $data = new DataUser;
        $data->name = $request->fullname;
        $data->address = $request->address;
        $data->email = $request->email;
        $data->gender = $request->gender;
        $data->phone = $request->phone;
        if ($data->save()) {
            return response()->json(['success' => true, 'message' => "Data saved successfully"], 200);
        }
    }

    public function getData()
    {
        // dd(request()->all());
        $data = DataUser::orderBy('id', 'DESC');

        // for search
        if (request()->has('search') && request('search') != null) {
            $data->where('name', 'LIKE', '%' . request('search') . '%');
        }

        if(request()->has('emailSearch') && request('emailSearch') != null){
            $data->where('email', 'LIKE', '%' . request('emailSearch') . '%');
        }

        $result = $data->get();
        return response()->json(['success' => true, 'data' => $result], 200);
    }
}
