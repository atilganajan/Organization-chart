<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use App\Http\Requests\CreateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(){
        $dapertments = Department::get();

        return view("pages.department")->with(["departments"=>$dapertments]);
    }

    public function list(){
        $query = Department::leftJoin('departments as parent', 'departments.parent_department_id', '=', 'parent.id')
            ->select('departments.*', 'parent.name as parent_department_name');


        return DataTables::of($query->get())->toJson();
    }

    public function create(CreateDepartmentRequest $request){

        $data =$request->only("name","parent_department_id");

        Department::create($data);

        return response()->json(["status"=>"success","message"=>"Department created successfully"]);
    }



}
