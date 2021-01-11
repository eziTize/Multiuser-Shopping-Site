<?php

namespace App\Http\Controllers\Admin;

use App\Seller;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellerController extends Controller
{
    /*
    |------------------------------------------------------------------
    |   Seller List Page
    |------------------------------------------------------------------
    */
    public function index(Request $request){


        $query = $request->input('seller_name');

    
        if($request->get('seller_name'))
        {

            $data = Seller::where('name', 'like', "%$query%")->paginate(8); //search
        }

        else{

            $data = Seller::orderBy('created_at', 'desc')->paginate(8); //normal
        }


        $data = [
            'data' => $data,
            'sellers' => Seller::get(),
            'link' => env('admin').'/seller/'
        ];

        return View('admin.seller.index',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Seller Add Page
    |------------------------------------------------------------------
    */
    public function create(){
        $data = [
            'data' => new Seller,
           // 'branch' => Branch::where('is_deleted','0')->pluck('name','id'),
            'link' => env('admin').'/seller/'
        ];

        return View('admin.seller.create',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Seller Data Store
    |------------------------------------------------------------------
    */
    public function store(Request $request){

        //$uid = rand(11,999);
        $data = new Seller;

        if($data->validate($request->all(),"add")){
            return Redirect(env('admin').'/seller/create')->withErrors($data->validate($request->all(),"add"))->withInput();
        }elseif($data->duplicateChk("add",$request)){
            return Redirect(env('admin').'/seller/create')->with('error','Sorry! '.$data->duplicateChk("add",$request).' Already Exists')->withInput();
        }

        $data->name = $request->get('name');
        $data->gender = $request->get('gender');
        $data->email = strtolower($request->get('email'));
        $data->phone = $request->get('phone');
        $data->address = $request->get('address');
        $data->password = bcrypt($request->get('password'));
        $data->status = $request->get('status');
        //$data->profit_percent = $request->get('profit_percent');
        $data->save();

        $data->ref_id = 'ac_'.uniqid().$data->id;
        $data->save();

        return Redirect(env('admin').'/seller')->with('message','New Seller Added Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   Edit Seller Page
    |------------------------------------------------------------------
    */
    public function edit($id){
        $data = [
            'id' => $id,
            'data' => Seller::find($id),
            'link' => env('admin').'/seller/'
        ];

        return View('admin.seller.edit',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Seller Data Update
    |------------------------------------------------------------------
    */
    public function update(Request $request,$id){
        $data = Seller::find($id);

        if($data->validate($request->all(),"edit")){
            return Redirect(env('admin').'/seller/'.$id.'/edit')->withErrors($data->validate($request->all(),"edit"))->withInput();
        }elseif($data->duplicateChk("edit",$request,$id)){
            return Redirect(env('admin').'/seller/'.$id.'/edit')->with('error','Sorry! '.$data->duplicateChk("edit",$request,$id).' Already Exists')->withInput();
        }

        $data->name = $request->get('name');
        $data->gender = $request->get('gender');
        $data->email = strtolower($request->get('email'));
        $data->phone = $request->get('phone');
        $data->address = $request->get('address');
        $data->password = bcrypt($request->get('password'));
        $data->status = $request->get('status');
        //$data->profit_percent = $request->get('profit_percent');
       //$data->ref_id = $request->get('ref_id');

        
        if($request->get('password')){
            $data->password = bcrypt($request->get('password'));
        }

        $data->save();

        return Redirect(env('admin').'/seller')->with('message','Seller Updated Successfully.');
    }


    /*
    |------------------------------------------------------------------
    |   Seller Data Delete Permanently
    |------------------------------------------------------------------
    */
    public function destroy($id){
        $data = Seller::find($id);
        $data->delete();

        return Redirect(env('admin').'/seller')->with('message','Seller Deleted Successfully.');
    }


    /*
    |------------------------------------------------------------------
    |   Seller Data Delete Permanently
    |------------------------------------------------------------------
    */
    public function e_reset($id){

        $data = Seller::find($id);
        $data->r_earnings = 0;
        $data->save();

        return Redirect(env('admin').'/seller')->with('message','Seller Earnings Reset Successful.');
    }
   

}
