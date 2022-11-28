<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class HomeController extends Controller
{
    public function get_repo($name){
        //dd($name);
        $response = Http::get('https://api.github.com/users/'.$name.'/repos');
        $repo_object = (array)$response->object();

        return response()->json([
            'success' => true,
            'data' => array_column($repo_object, 'name')
        ]);
    }

    public function get_repo_list(Request $request){
        //dd($request->all());
        $input = $request->all();
        $response = Http::get('https://api.github.com/users/'.$input['name'].'/repos');

        $repo_object = $response->object();

        return view('list', ['repo_object' => $repo_object]);

    }
}
