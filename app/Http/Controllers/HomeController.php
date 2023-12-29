<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $departments = Department::with([
            "subDepartments",
            "parentDepartment",
            "persons"
        ])->orderByRaw('parent_department_id IS NULL DESC')->get();
           // dd($departments);
        return view("pages.home")->with(["departments"=>$departments]);
    }
}
