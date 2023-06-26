<?php

namespace App\Http\Controllers\Termilan;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryCreate;
use App\Models\Inventory;
use App\Models\InventoryLog;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public $inventory;
    public $inventorylog;

    public function __construct()
    {
       $this->inventory=new Inventory();
       $this->inventorylog=new InventoryLog();
    }
    public function deliveryIndex()
    {
        $logs=$this->inventorylog->where('store_id',Auth::guard('worker')->user()->store_id)->orderby('created_at','desc')->get();
        $movies=Movie::query()->get();
        return view('pages.terminal.delivery',['movies'=> $movies ,'logs'=>$logs]);
    }
    public function inventoryIndex()
    {
        $inventory=Inventory::query()->where('store_id',Auth::guard('worker')->user()->store_id)->get();
        return view('pages.terminal.inventory',['inventories'=> $inventory]);
    }
    public function insert(InventoryCreate $request)
    {
       
        for ($i=0 ; $i<count($request->amount);$i++)
        {
            $exists=$this->inventory->where('movie_id',$request->movie_id[$i])->where('store_id',Auth::guard('worker')->user()->store_id)->first();
            if($exists!==null)
            {
                $exists->update(
                    [
                        'amount'=> $exists->amount + $request->amount[$i],
                    ]
                );
            }
            else
            {
                $this->inventory->create([
                    'store_id' => Auth::guard('worker')->user()->store_id,
                    'amount' => $request->amount[$i],
                    'movie_id' => $request->movie_id[$i],        
                ]);
            }
            $this->inventorylog->create([
                'store_id' => Auth::guard('worker')->user()->store_id,
                'amount' => $request->amount[$i],
                'action'=>'ulaz',
                'worker_id'=> Auth::guard('worker')->user()->id,
                'movie_id' => $request->movie_id[$i],       
                
            ]);
        }
        return redirect('/terminal/dashboard/delivery');
    }
    public function update(InventoryCreate $request)
    {
        for ($i=0 ; $i<count($request->amount);$i++)
        {
            $exists=$this->inventory->where('movie_id',$request->movie_id[$i])->where('store_id',Auth::guard('worker')->user()->store_id)->first();
            if($exists!==null)
            {
                $exists->update(
                    [
                        'amount'=> $exists->amount - $request->amount[$i],
                    ]
                );
            
                $this->inventorylog->create([
                    'store_id' => Auth::guard('worker')->user()->store_id,
                    'amount' => $request->amount[$i],
                    'action'=>'izlaz',
                    'worker_id'=> Auth::guard('worker')->user()->id,
                    'movie_id' => $request->movie_id[$i],  
                ]);
            }
            if($exists->amount <= 0 && $exists->rented<=0 )
            {
                $exists->delete();
            }
            return redirect('/terminal/dashboard/inventory');
        }
    }
    public function availability ($movieId)
    {
        $inventory=$this->inventory->where('movie_id',$movieId)->get();
        return view('pages.terminal.availability',['inventories'=> $inventory]);
    }
}
