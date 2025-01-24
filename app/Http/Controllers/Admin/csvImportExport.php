<?php
namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Country;
use App\Models\State;
//use App\Models\GroupCode;
use App\Models\GroupUser;
use App\Models\School;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class csvImportExport extends Controller{
	
 function csvToArray($filename = '', $delimiter = ','){
    if(!file_exists($filename) || !is_readable($filename))
        return false;

    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false){
		 $c = 0;
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
        {
            if (!$header){
                $header = $row;
            }else{
                 //$data[] = array_combine($header, $row);
				$data[$c]['code'] = trim($row[0]);
				$data[$c]['school_name'] = trim($row[1]);
				$data[$c]['school_type'] = trim($row[2]);
				$data[$c]['address'] = trim($row[3]);
				$data[$c]['city'] = trim($row[4]);
				$data[$c]['state'] = trim($row[5]);
				$data[$c]['status'] = trim($row[6]);
				$c++;
			}
        }
        fclose($handle);
    }
    return $data;
}

    public function importSchool(){
        return view("admin/import/school_import");
    }
	
    public function putImportSchool(Request $request)
    {
		$request->validate([
					'csv_file'=> 'required|file'
				 //'csv_file'=> 'required|mimes:csv,txt'
                ]);
		$path = $request->file('csv_file')->getRealPath();

     $customerArr = $this->csvToArray($path);
     $total_data = sizeof($customerArr);
	 $t = 0;
	 foreach($customerArr as $ca){
		$chk_gc = School::where('school_code',$ca['code'])->select('id')->first();
	  if(!$chk_gc){
		 $state = State::where('country_id',231)->where('name',$ca['state'])->select('id')->first();
		if(!$state){
			$state = 3919; //Alabama
		} else {
			$state = $state->id;
		} 
		   School::create([
					"school_name"=>$ca['school_name'],
					"school_code"=>$ca['code'],
					"school_type"=>$ca['school_type'],
					"address" => $ca['address'],
					"city"=>$ca['city'],
					"state"=>$state,
					"country"=>231,
					"status"=>$ca['status']
				]);	
		  
		$t++;	   
	  }	
	 }
	  $import_data = $t;	
if($import_data==$total_data){	  
     return redirect()->back()->with('success',  "File imported successfully.")->with('total_data',$total_data)->with('total_import',$import_data);
    }else{
		return redirect()->back()->withErrors(['The School Code has already been taken.'])->with('total_data',$total_data)->with('total_import',$import_data);
	}		
}}