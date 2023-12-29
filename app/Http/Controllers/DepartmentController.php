<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class DepartmentController extends Controller
{
    public function index()
    {
        try {
            $dapertments = Department::get();

            return view("pages.department")->with(["departments" => $dapertments]);
        } catch (\Exception $err) {
            Log::error("File: " . $err->getFile() . " Line: " . $err->getLine() . " Error: " . $err->getMessage());
            return response()->json(["status" => false, "message" => "unexpected error"]);
        }
    }

    public function list()
    {
        try {
            $query = Department::leftJoin('departments as parent', 'departments.parent_department_id', '=', 'parent.id')
                ->select('departments.*', 'parent.name as parent_department_name')->orderBy('departments.created_at', 'desc');

            return DataTables::of($query->get())->toJson();
        } catch (\Exception $err) {
            Log::error("File: " . $err->getFile() . " Line: " . $err->getLine() . " Error: " . $err->getMessage());
            return response()->json(["status" => false, "message" => "unexpected error"]);
        }
    }

    public function create(CreateDepartmentRequest $request)
    {
        try {
            $data = $request->only("name", "parent_department_id");

            Department::create($data);

            return response()->json(["status" => "success", "message" => "Department created successfully"]);
        } catch (\Exception $err) {
            Log::error("File: " . $err->getFile() . " Line: " . $err->getLine() . " Error: " . $err->getMessage());
            return response()->json(["status" => false, "message" => "unexpected error"]);
        }
    }

    public function edit($id)
    {
        try {
            $department = Department::where("id", $id)->with("parentDepartment")->first();

            if (!$department) {
                return response()->json(["status" => "error", "message" => "Department not found"], 404);
            }

            return response()->json(["status" => "success", "department" => $department]);
        } catch (\Exception $err) {
            Log::error("File: " . $err->getFile() . " Line: " . $err->getLine() . " Error: " . $err->getMessage());
            return response()->json(["status" => false, "message" => "unexpected error"]);
        }

    }

    public function update(UpdateDepartmentRequest $request)
    {
        try {
            $data = $request->only("name", "parent_department_id", "id");

            $department = Department::where("id", $data["id"])->first();

            if (!$department) {
                return response()->json(["status" => "error", "message" => "Department not found"], 404);
            }

            $department->update([
                "name" => $data["name"],
                "parent_department_id" => $data["parent_department_id"]
            ]);

            return response()->json(["status" => "success", "message" => "Department updated successfully"]);
        } catch (\Exception $err) {
            Log::error("File: " . $err->getFile() . " Line: " . $err->getLine() . " Error: " . $err->getMessage());
            return response()->json(["status" => false, "message" => "unexpected error"]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $id = $request->only("id");
            Department::where("id", $id)->delete();

            return response()->json(["status" => "success", "message" => "Department deleted successfully"]);
        } catch (\Exception $err) {
            Log::error("File: " . $err->getFile() . " Line: " . $err->getLine() . " Error: " . $err->getMessage());
            return response()->json(["status" => false, "message" => "unexpected error"]);
        }
    }


}
