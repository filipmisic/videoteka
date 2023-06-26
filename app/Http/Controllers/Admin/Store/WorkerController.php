<?php

namespace App\Http\Controllers\Admin\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWorker;
use App\Http\Requests\UpdateWorker;
use App\Models\Store;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WorkerController extends Controller
{
    public function __construct()
    {
        $this->worker=new Worker();
    }
    public function index()
    {
        $getWorker=$this->worker->paginate(5);
        return view('pages.admin.worker.index',['workers'=>$getWorker]);
    }
    public function create()
    {
        $getStores=Store::query()->get();
        return view('pages.admin.worker.create',['stores'=>$getStores]);
    }
    public function insert(CreateWorker  $request)
    {

        $params=$request->validated();
        $this->worker->create(array_merge($request->except('password'),
        ['password' => Hash::make($params['password'])]));

        return redirect('admin/worker');
    }
    public function getWorker($workerId)
    {
        return $this->worker->where('id',$workerId)->first();;
    }

    public function edit($workerId)
    {
        $getStores=Store::query()->get();
        $getWorker=$this->getWorker($workerId);
        return view('pages.admin.worker.edit', ['worker' =>$getWorker ,'stores'=>$getStores]);
    }
    public function update(UpdateWorker $request)
    {
        $params = $request->validated();

        $this->worker->where('id', $request->workerId)->update([
            'name' => $params['name'],
            'surname' => $params['surname'],
            'store_id' => $params['store_id'],
            'status' => $params['status'],
        ]);
        if($params['password']!== null)
        { 
            $this->worker->where('id', $request->workerId)->update([
                'password' => Hash::make($params['password']),
            ]);
        }

        return redirect('/admin/worker/');
    }

    public function delete($workerId)
    {
        
        $worker = $this->getWorker($workerId);
        $worker->delete();
        return redirect('/admin/worker/');
    }

}
