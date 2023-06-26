<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUser;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
 public $model;

 public function __construct()
 {
    $this->model=new User();
    $this->rent=new Rent();
 }
 public function getUser($userId)
 {
     return $this->model->where('id', $userId)->first();

 }
 public function index()
 {
     $getUser=$this->model->paginate(10);
     return view('pages.admin.user.index',['users'=> $getUser]);
 }
 public function rent ($userId)
 {
    $rents=$this->rent->where('user_id',$userId)->with("movies")->with("stores")->paginate(10);
    return view('pages.admin.user.rent',['rents'=> $rents]);
 }
 public function edit($userId)
 {
    return view('pages.admin.user.edit',['user'=> $this->getUser($userId)]);
 }
 public function update(UpdateUser $request)
 {
    $params = $request->validated();
    if(! $User=$this->getUser($request->userId)) return redirect('/admin/user/');

        $this->model->where('id', $request->userId)->update([
            'admin' => $params['admin'],
            'blocked' => ($User->admin)? 0: $params['blocked'],
            'premium' => $params['premium'],
            'oib'=> $params['oib']
        ]);
        
    return redirect('/admin/user/');

 }

}
