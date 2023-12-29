<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DepartmentController extends Controller
{
    public function index()
    {
        $dapertments = Department::get();

        return view("pages.department")->with(["departments" => $dapertments]);
    }

    public function list()
    {

        $query = Department::leftJoin('departments as parent', 'departments.parent_department_id', '=', 'parent.id')
            ->select('departments.*', 'parent.name as parent_department_name');

        return DataTables::of($query->get())->toJson();
    }

    public function create(CreateDepartmentRequest $request)
    {

        $data = $request->only("name", "parent_department_id");

        Department::create($data);

        return response()->json(["status" => "success", "message" => "Department created successfully"]);
    }

    public function edit($id)
    {
        $department = Department::where("id", $id)->with("parentDepartment")->first();

        if (!$department) {
            return response()->json(["status" => "error", "message" => "Department not found"], 404);
        }

        return response()->json(["status" => "success", "department" => $department]);

    }

    public function update(UpdateDepartmentRequest $request)
    {

        $data = $request->only("name", "parent_department_id", "id");

        Department::where("id", $data["id"])->update([
            "name" => $data["name"],
            "parent_department_id" => $data["parent_department_id"]
        ]);
        return response()->json(["status" => "success", "message" => "Department updated successfully"]);
    }

    public function delete(Request $request)
    {
        $id = $request->only("id");
        Department::where("id", $id)->delete();

        return response()->json(["status" => "success", "message" => "Department deleted successfully"]);
    }


}
