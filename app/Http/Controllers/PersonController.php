<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\CreatePersonRequest;
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

        $photo = $this->createPersonPhoto($data["photo"]);

        Department::create($data);

        return response()->json(["status"=>"success","message"=>"Department created successfully"]);
    }

}
