<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Request;
use App\Country;
use App\Continent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller {

    public function datatables() {

        $result = DB::table('Continent_Country')->get();
        $data = json_encode($result);
//echo "<pre>";var_dump(json_encode($result));
       return view('pages/tables/data', ['data' => $data]);
       
    }

    public function tabletwo() {

        $result1 = DB::table('Continent_Country')->get();
        $data1 = json_encode(["data" => $result1]);

//$data=['Id'=>1,'ContinentId'=>'2','Name'=>'Pavan','Code'=>'IND','Alias'=>'IND','DialCode'=>11,'CreatedAT'=>null,'IsActive'=>1];
        echo $data1;
    }

    public function deleteRow() {
        $row = Input::get('word');
        DB::table('Continent_Country')->where('Id', $row)->decrement('IsActive');
        echo $row;
    }

    public function editRow($id) {
        $result = DB::table('Continent_Country')->where('Id', $id)->get();
        $data = json_decode(json_encode($result), true);
        $continent = Continent::select('ConName', 'Id')->get();
        $continentid = $data[0]['ContinentId'];
        
        return view('pages/tables/editdata', ['data' => $data, 'continent' => $continentid, 'continentname' => $continent]);
    }
    
    public function editcontinent($id) {
        $result = DB::table('Continent')->where('Id', $id)->get();
        $data = json_decode(json_encode($result), true);
        return view('pages/tables/editcontinent', ['data' => $data]);
    }
    
    
    public function editedRow(Request $request) {

        $validator = Validator::make($request->all(), [
                    'ContinentId' => 'required',
                    'Name' => 'required|max:255',
                    'Code' => 'required|max:2',
                    'Alias' => 'required|max:3',
                    'DialCode' => 'required',
                    'IsActive' => 'required',
        ]);

        if ($validator->fails()) {
            
            $ReturnId = $request->Id;
            return redirect("edit/{$ReturnId}")
                            ->withErrors($validator)
                            ->withInput();
        } else {



            $Id = $request->Id;
            $ContinentId = $request->ContinentId;
            $Name = $request->Name;
            $Code = $request->Code;
            $Alias = $request->Alias;
            $DialCode = $request->DialCode;
            $isActive = $request->IsActive;


        $result = DB::table('Continent_Country')->where('Id', $Id)->update([

            'ContinentId' => $ContinentId,
            'Name' => $Name,
            'Code' => $Code,
            'Alias' => $Alias,
            'DialCode' => $DialCode,
            'IsActive' => $isActive,
        ]);

       
        return redirect('country');
        }
    }

//ajax call processing-------------------------------------------------------------------

    public function ajaxcall(Request $request) {
       
//        var_dump($request);
        $length = $request->input("length");
        $offset = $request->input("start");
        $search=$request->input('search');
        $order=$request->input('order');
        $column=$request->input('columns');
        if($search['value']=="" && $order[0]['dir']==""){
       
        //$data = Country::limit($length)->offset($offset)->get();
        $join=DB::table('Continent_Country')->join('Continent','Continent_Country.ContinentId','=','Continent.Id')
             ->select('Continent_Country.Id','Continent.ConName','Continent_Country.Name'
                      ,'Continent_Country.Code', 'Continent_Country.Alias', 
                     'Continent_Country.DialCode', 'Continent_Country.CreatedAt','Continent_Country.IsActive'
                     )
               ->limit($length)->offset($offset)->get();
        $data=  json_encode($join);
        $count=DB::table('Continent_Country')->count();
       echo "{\"recordsTotal\":".$count.",\"recordsFiltered\":".$count.", \"data\":" . $data . "}";
       
    }
     if($order[0]['dir']!="" && $search['value']=="" ){
         $data=$column[$order[0]['column']]['data'];
         $asc=$order[0]['dir'];
        if($column[$order[0]['column']]['data']=='ConName'){
             $join=DB::table('Continent_Country')->join('Continent','Continent_Country.ContinentId','=','Continent.Id')
             ->select('Continent_Country.Id','Continent.ConName','Continent_Country.Name'
                      ,'Continent_Country.Code', 'Continent_Country.Alias', 
                     'Continent_Country.DialCode', 'Continent_Country.CreatedAt','Continent_Country.IsActive'
                     )->orderBy("Continent."."$data","$asc")
                     
               ->limit($length)->offset($offset)->get();
        $data=  json_encode($join);
        $count=DB::table('Continent_Country')->count();
       echo "{\"recordsTotal\":".$count.",\"recordsFiltered\":".$count.", \"data\":" . $data . "}";
        }
        else{
             $join=DB::table('Continent_Country')->join('Continent','Continent_Country.ContinentId','=','Continent.Id')
             ->select('Continent_Country.Id','Continent.ConName','Continent_Country.Name'
                      ,'Continent_Country.Code', 'Continent_Country.Alias', 
                     'Continent_Country.DialCode', 'Continent_Country.CreatedAt','Continent_Country.IsActive'
                     )
               ->orderBy("Continent_Country."."$data","$asc")
                     ->limit($length)->offset($offset)
                ->get();
        $data=  json_encode($join);
        $count=DB::table('Continent_Country')->count();
       echo "{\"recordsTotal\":".$count.",\"recordsFiltered\":".$count.", \"data\":" . $data . "}";
            
        }
        
    }
    
    else{
         $data=$column[$order[0]['column']]['data'];
         $asc=$order[0]['dir'];
         if($column[$order[0]['column']]['data']=='ConName'){
              $join=DB::table('Continent_Country')->join('Continent','Continent_Country.ContinentId','=','Continent.Id')
             ->select('Continent_Country.Id','.ConName','Continent_Country.Name'
                      ,'Continent_Country.Code', 'Continent_Country.Alias', 
                     'Continent_Country.DialCode', 'Continent_Country.CreatedAt','Continent_Country.IsActive'
                     )
               ->limit($length)->offset($offset)->where('Continent_Country.Id','like',$search['value'].'%')
                ->orwhere('Continent_Country.Name','like',$search['value'].'%')
                ->orwhere('Continent_Country.Code','like',$search['value'].'%')
                ->orwhere('Continent.ConName','like',$search['value'].'%')
                ->orwhere('Continent_Country.Alias','like',$search['value'].'%')
                ->orwhere('Continent_Country.DialCode','like',$search['value'].'%')
                ->orderBy("Continent."."$data","$asc")
                ->get();
        $data=  json_encode($join);
        $count=DB::table('Continent_Country')->count();
       echo "{\"recordsTotal\":".$count.",\"recordsFiltered\":".$count.", \"data\":" . $data . "}";
        
             
         }
         
         else{
        $join=DB::table('Continent_Country')->join('Continent','Continent_Country.ContinentId','=','Continent.Id')
             ->select('Continent_Country.Id','.ConName','Continent_Country.Name'
                      ,'Continent_Country.Code', 'Continent_Country.Alias', 
                     'Continent_Country.DialCode', 'Continent_Country.CreatedAt','Continent_Country.IsActive'
                     )
               ->limit($length)->offset($offset)->where('Continent_Country.Id','like',$search['value'].'%')
                ->orwhere('Continent_Country.Name','like',$search['value'].'%')
                ->orwhere('Continent_Country.Code','like',$search['value'].'%')
                ->orwhere('Continent.ConName','like',$search['value'].'%')
                ->orwhere('Continent_Country.Alias','like',$search['value'].'%')
                ->orwhere('Continent_Country.DialCode','like',$search['value'].'%')
                ->orderBy("Continent_Country."."$data","$asc")
                ->get();
        $data=  json_encode($join);
        $count=DB::table('Continent_Country')->count();
       echo "{\"recordsTotal\":".$count.",\"recordsFiltered\":".$count.", \"data\":" . $data . "}";
         }
    }
   
        }

        public function continent(){
            
       return view('pages/tables/continent');
       
        }
        
       
        // Continent table 
        
        public function continentcall(Request $request) {
       
//        var_dump($request);
        $length = $request->input("length");
        $offset = $request->input("start");
        $search=$request->input('search');
        $order=$request->input('order');
        $column=$request->input('columns');
        
        if($search['value']=="" && $order[0]['dir']==""){
       
        //$data = Country::limit($length)->offset($offset)->get();
        $join=DB::table('Continent') ->limit($length)->offset($offset)->get();
        $data=  json_encode($join);
        $count=DB::table('Continent')->count();
       echo "{\"recordsTotal\":".$count.",\"recordsFiltered\":".$count.", \"data\":" . $data . "}";
       
    }
     if($order[0]['dir']!="" && $search['value']=="" ){
         $data=$column[$order[0]['column']]['data'];
         $asc=$order[0]['dir'];
        $join=DB::table('Continent') ->select('Continent.Id','Continent.ConName','Continent.Code','Continent.IsActive')
               ->orderBy("Continent."."$data","$asc")
                     ->limit($length)->offset($offset)->get();
        
        $data=  json_encode($join);
        $count=DB::table('Continent')->count();
       echo "{\"recordsTotal\":".$count.",\"recordsFiltered\":".$count.", \"data\":" . $data . "}";
        }
        
    
    
    else{
         $data=$column[$order[0]['column']]['data'];
         $asc=$order[0]['dir'];
        $join=$join=DB::table('Continent') ->select('Continent.Id','Continent.ConName','Continent.Code','Continent.IsActive')
                      ->limit($length)->offset($offset)->where('Continent.Id','like',$search['value'].'%')
                ->orwhere('Continent.ConName','like',$search['value'].'%')
                ->orwhere('Continent.Code','like',$search['value'].'%')
                ->orwhere('Continent.IsActive','like',$search['value'].'%')
                ->orderBy("Continent."."$data","$asc")
                ->get();
        $data=  json_encode($join);
        $count=DB::table('Continent')->count();
       echo "{\"recordsTotal\":".$count.",\"recordsFiltered\":".$count.", \"data\":" . $data . "}";
        
        
    }
   
        }
        
        public function editedContinent(Request $request) {

        $validator = Validator::make($request->all(), [
                    'Id' => 'required',
                    'ConName' => 'required|max:255',
                    'Code' => 'required|max:2',
                    'IsActive'=>'required'
        ]);

        if ($validator->fails()) {
            
            $ReturnId = $request->Id;
            return redirect("editcontinent/{$ReturnId}")
                            ->withErrors($validator)
                            ->withInput();
        } else {



            $Id = $request->Id;
            $Name = $request->ConName;
            $Code = $request->Code;
            $IsActive=$request->IsActive;


        $result = DB::table('Continent')->where('Id', $Id)->update([

            'Id' => $Id,
            'ConName' => $Name,
            'Code' => $Code,
            'IsActive'=>$IsActive
            
        ]);

       
        return redirect('continent');
        }
    }
    
        public function deletecontinent() {
        $row = Input::get('word');
        DB::table('Continent')->where('Id', $row)->decrement('IsActive');
        echo $row;
    }

    public function modal(){
        $phone = Country::find(5)->continent;
        echo $phone;
        echo "<br><br><br>";
        $data=  Continent::find(1)->country;
        echo $data;
    }
        
        
}

 