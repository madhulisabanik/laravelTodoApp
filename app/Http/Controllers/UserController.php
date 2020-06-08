<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //Learning laravel
    public function index(){

        // $user = new User();
        // //dd($user);
        // $user->name = 'Subha';
        // $user->email = 'subha@g.com';
        // $user->password = bcrypt('123456');
        // $user->save();

        //User::where('id', 1)->delete();

        //User::where('id', 2)->update(['email' => 'das@g.com']);

        // $data = [
        //     'name' => 'Bibhu',
        //     'email' => 'bibhu@g.com',
        //     'password' => bcrypt('123456')
        // ];

        $data = [
            'name' => 'ria',
            'email' => 'ria@g.com',
            'password' => '123456'
        ];

        //User::create($data);

        $user = User::all();
        return $user;
        
    }
    
    public function upload(Request $request){
        
        if($request->hasFile('image')){

            //$request->image->store('images');
            $fileName = $request->image->getClientOriginalName();
            if(auth()->user()->avatar){
                Storage::delete('/public/images/'.auth()->user()->avatar);
            }
            $request->image->storeAs('images', $fileName, 'public');
            auth()->user()->update(['avatar' => $fileName]);
            return redirect()->back()->with('message', 'Avatar Uploaded!');
        }
        
        return redirect()->back()->with('error', 'Avatar Not Uploaded!');
    }
    
}
