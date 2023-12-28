<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(){
        return view("pages.department");
    }

    public function create(CreateDepartmentRequest $request){

        $data =$request->only("name","parent_department_id");

        Department::create($data);

        return response()->json(["status"=>"success","message"=>"Department created successfully"]);
    }

}
