<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\CreatePersonRequest;
use App\Models\Person;
use App\Traits\FileTrait;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    use FileTrait;

    public function index(){
        $dapertments = Department::get();

        return view("pages.person")->with(["departments"=>$dapertments]);
    }

    public function create(CreatePersonRequest $request){

        $data = $request->only("name","surname","photo","position","department_id");


        if($data["photo"]){
            $data["photo"] = $this->createfile($data["photo"]);
        }

        Person::create([
            "name"=> $data["name"],
            "surname"=> $data["surname"],
            "photo"=> $data["photo"],
            "position"=> $data["position"],
            "department_id"=> $data["department_id"]
        ]);

        return response()->json(["status"=>"success","message"=>"Person created successfully"]);
    }

}
