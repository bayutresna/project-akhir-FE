<?php

namespace App\Http\Controllers;

use App\Helpers\HttpClient;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function login(Request $req){
        // dd($req);
        $payload = $req->all();
        $link = "http://127.0.0.1:8000/api/login";

        $user = HttpClient::fetch('POST',$link,$payload);
        // dd($user);
        $datauser = $user['data'];
        // dd($datauser);
        if(!$datauser){
            $msg = $user['message'];
            return redirect()
            ->back()
            ->withErrors([
                'msg' =>$msg
                ]);
        }
        if(!session()->isStarted()) session()->start();

        session()->put('logged',true);
        session()->put('IdUser',$datauser['user']['id']);
        session()->put('role', $datauser['user']['role']['nama']);

        return redirect()->route('home');

    }

    function register(Request $req){

        $payload = $req->all();
        $link = "http://127.0.0.1:8000/api/register";
        $user = HttpClient::fetch('POST',$link,$payload);
        // dd($user);
        // $datauser = $user['data'];
        return redirect()->route('formlogin');

    }

    function Logout(Request $request){
        session()->flush();
        return redirect()->route('formlogin');
    }
}
