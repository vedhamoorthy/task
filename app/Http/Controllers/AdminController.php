<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Admin;
use Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/login');
    }
    public function login_process(Request $request){
		$data = array();
        $validator=Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $data = array(
                'email' => $request->input('email'),
                'password' => md5($request->input('password')),
                'status' => 1,
				'is_admin' => 1
            );
            $checkLogin=Admin::getLog($data);
            // dd($checkLogin);
            $je = json_decode(json_encode ( $checkLogin ) , true);
            // print_r($je['is_admin']);die('cc');
            if($je['is_admin'] == 1){
                Session::put('isUserLoggedIn', TRUE);
                Session::put('User_info', $checkLogin);
                return redirect('dashboard');
            }else{
                return back()->with('login_res','Wrong email or password, please try again.');
                $data['error_msg'] = 'Wrong email or password, please try again.';
            }
            return redirect('login');
        }
	}
    public function dashboard(Request $request){
		if($request->session()->get('isUserLoggedIn')){
            return view('admin/dashboard');
		}else{
			redirect('login');
		}
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
        //
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
        //
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
