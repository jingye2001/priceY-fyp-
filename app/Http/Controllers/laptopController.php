<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\laptop;
use DB;

class laptopController extends Controller
{
    public function add(){
        $r=request();
        //$r=require//get all form input value
        if($r->file('imageName')!=''){
            $image=$r->file('imageName');  
            $image->move('images',$image->getClientOriginalName());                
            $imageName=$image->getClientOriginalName(); 
        }
        else{
            $imageName="empty.jpg";

        }
        $shopee = $r->shopee ?? '';
        $lazada = $r->lazada ?? '';
        $addproduct=laptop::create([
            'name'=>$r->laptopName,
            'manufacturer'=>$r->manufacturer,
            'price'=>$r->price,
            'process_model'=>$r->process_model,
            'graphics'=>$r->graphics,
            'display_technology'=>$r->display_technology,
            'screen_size'=>$r->screen_size,
            'screen_resolution'=>$r->screen_resolution,
            'storage'=>$r->storage,
            'memory'=>$r->memory,
            'operating_system'=>$r->operating_system,
            'connectivity' => $r->connectivity ?? 'default_value',
            'camera'=>$r->camera,
            'ports'=>$r->ports,
            'battery'=>$r->battery,
            'dimension'=>$r->dimension,
            'weight'=>$r->weight,
            'type'=>$r->type,
            'image'=>$imageName,
            'lazada' => $lazada,
            'shopee' => $shopee,
        ]);
        
        return redirect('addDone');
    }

    public function adddones()
    {
        return view('addDone');
    }

    public function showCategory($manufacturer){
        $showLaptop=laptop::all()->where('manufacturer',$manufacturer);
        return view('laptopCategory',  ['laptops' => $showLaptop, 'manufacturer' => $manufacturer]);
    }

    public function showCategorys($manufacturer){
        $showLaptop=laptop::all()->where('manufacturer',$manufacturer);
        return view('adminLaptopCategory',  ['laptops' => $showLaptop, 'manufacturer' => $manufacturer]);
    }

    public function view(){
        //$viewAll=Product::all();//run SQL select * from products
        $viewAll=laptop::paginate();
        return view('adminPage')->with('laptops',$viewAll);
    }

    public function views(){
        $viewAll=laptop::paginate();
        return view('selectLaptop')->with('laptops',$viewAll);
    }

    public function delete($id){
        $deleteLaptop=laptop::find($id); //delete from products where id=$id
        $deleteLaptop->delete();
        return redirect()->route('deleteDone');
    }
    public function deletedone()
    {
        return view('deleteDone');
    }

    public function edit($id){
        $editLaptop = Laptop::findOrFail($id); 
        return view('editLaptop', ['laptop' => $editLaptop]);
    }
    

    public function update() {
        $request = request();
        
        $laptop = Laptop::find($request->lid);
        if (!$laptop) {
            return redirect()->route('adminPage')->with('error', '找不到产品');
        }
    
        $this->validate($request, [
            'laptopName' => 'required',
            'price' => 'required|numeric',
            // Add validation rules for other fields
        ]);
    
        if ($request->hasFile('imageName')) {
            $image = $request->file('imageName');
            if ($image->isValid()) {
                $imageName = $image->getClientOriginalName();
                $image->store('images');
                $laptop->image = $imageName;
            }
        }
    
        $laptop->name = $request->laptopName;
        $laptop->manufacturer = $request->manufacturer;
        $laptop->price = $request->price;
        $laptop->process_model = $request->process_model;
        $laptop->graphics = $request->graphics;
        $laptop->display_technology = $request->display_technology;
        $laptop->screen_size = $request->screen_size;
        $laptop->screen_resolution = $request->screen_resolution;
        $laptop->storage = $request->storage;
        $laptop->memory = $request->memory;
        $laptop->operating_system = $request->operating_system;
        $laptop->connectivity = $request->connectivity ?? 'default_value';
        $laptop->camera = $request->camera;
        $laptop->ports = $request->ports;
        $laptop->battery = $request->battery;
        $laptop->dimension = $request->dimension;
        $laptop->weight = $request->weight;
        $laptop->type = $request->type;
    
        if ($request->lazada !== null) {
            $laptop->lazada = $request->lazada;
        }
    
        if ($request->shopee !== null) {
            $laptop->shopee = $request->shopee;
        }
    
        $laptop->save();
    
        return redirect()->route('editDone');
    }
    

    public function editdones()
    {
        return view('editDone');
    }

    public function details($id){
        $laptopDetails=laptop::find($id);
        return view('laptopDetails', ['laptops' => $laptopDetails]);
    }

    public function laptopDetail($id){
        $laptopDetails=laptop::find($id);
        return view('adminLaptopDetails', ['laptops' => $laptopDetails]);
    }

    public function laptopList(){
        $showLaptop=Laptop::all();
        return view('showAllLaptop')->with('laptops',$showLaptop);
    }

    public function adminLaptopList(){
        $showLaptop=Laptop::all();
        return view('adminShowAllLaptop')->with('laptops',$showLaptop);
    }

    public function search(){
        $r=request();
        $keyword=$r->keyword;
        $laptop=DB::table('laptops')->where('name','like','%'.$keyword.'%')->paginate(10);
        return view('showAllLaptop')->with(['laptops' => $laptop, 'keyword' => $keyword]);   //Select * from products where name like '%$keyword%'
    }
    
    public function adminSearch(){
        $r=request();
        $keyword=$r->keyword;
        $laptop=DB::table('laptops')->where('name','like','%'.$keyword.'%')->paginate(10);
        return view('adminShowAllLaptop')->with(['laptops' => $laptop, 'keyword' => $keyword]);   //Select * from products where name like '%$keyword%'
    }
}


?>