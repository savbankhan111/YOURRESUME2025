<?php
namespace App\Http\Controllers;

//use App\Http\Requests\UserValidation;
use App\Models\Skill;
use App\User;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class AjaxController extends Controller{	
    public function skillData(){
        $skills = Skill::get();
        return view("ajax/skills", compact("skills"));
    }
}