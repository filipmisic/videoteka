<?php

namespace App\Http\Controllers\Admin\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStore;
use App\Http\Requests\UpdateStore;
use App\Models\Inventory;
use App\Models\RentLog;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->store=new Store();
    }

    public function index()
    {
        $getStore=$this->store->paginate(5);
        return view('pages.admin.store.index',['stores'=>$getStore]);
    }
    public function getStore($storeId)
    {
        return $this->store->where('id',$storeId)->first();;
    }

    public function insert(CreateStore  $request)
    {
        $this->store->create($request->validated());
        return redirect('admin/store');
    }

        public function edit($storeId)
    {
        $getStore=$this->getStore($storeId);
        return view('pages.admin.store.edit', ['store' =>$getStore ]);
    }
    
    public function update(UpdateStore $request)
    {
        $params = $request->validated();
        if(!$this->getStore($request->storeId)) return redirect('admin/store');

        $this->store->where('id', $request->storeId)->update([
            'name' => $params['name'],
            'city' => $params['city'],
            'adress' => $params['adress'],
        ]);
        return redirect('admin/store');
    }
    public function inventory ($storeId)
    {
        $inventory=Inventory::query()->where('store_id',$storeId)->with("stores")->with("movies")->paginate(10,['*'],"movies");
        $rentlogs=RentLog::query()->where('store_id',$storeId)->with("users")->with("movies")->paginate(10, ['*'], 'logs');
        return view('pages.admin.store.inventory', ["inventories"=>$inventory ,"rentlogs"=>$rentlogs]);
    }
    public function delete($storeId)
    {
        
        $store=$this->getStore($storeId);
        $store->delete();
        return redirect('/admin/store/');
    }
}
