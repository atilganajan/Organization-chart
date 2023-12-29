<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Models\Department;
use App\Models\Person;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class PersonController extends Controller
{
    use FileTrait;

    public function index()
    {
        try {
            $dapertments = Department::get();
            return view("pages.person")->with(["departments" => $dapertments]);
        } catch (\Exception $err) {
            Log::error("File: " . $err->getFile() . " Line: " . $err->getLine() . " Error: " . $err->getMessage());
            return response()->json(["status" => false, "message" => "unexpected error"]);
        }
    }

    public function list()
    {
        try {
            $query = Person::leftJoin("departments", "persons.department_id", "=", "departments.id")
                ->select("persons.*", "departments.name as department_name")->orderBy('persons.created_at', 'desc');

            return DataTables::of($query->get())->toJson();
        } catch (\Exception $err) {
            Log::error("File: " . $err->getFile() . " Line: " . $err->getLine() . " Error: " . $err->getMessage());
            return response()->json(["status" => false, "message" => "unexpected error"]);
        }
    }

    public function create(CreatePersonRequest $request)
    {
        try {
            $data = $request->only("name", "surname", "photo", "position", "department_id");


            if (isset($data["photo"])) {
                $data["photo"] = $this->createfile($data["photo"]);
            }

            Person::create([
                "name" => $data["name"],
                "surname" => $data["surname"],
                "photo" => $data["photo"] ?? null,
                "position" => $data["position"],
                "department_id" => $data["department_id"]
            ]);

            return response()->json(["status" => "success", "message" => "Person created successfully"]);
        } catch (\Exception $err) {
            Log::error("File: " . $err->getFile() . " Line: " . $err->getLine() . " Error: " . $err->getMessage());
            return response()->json(["status" => false, "message" => "unexpected error"]);
        }
    }

    public function edit($id)
    {
        try {
            $person = Person::where("id", $id)->first();

            if (!$person) {
                return response()->json(["status" => "error", "message" => "Person not found"], 404);
            }

            return response()->json(["status" => "success", "person" => $person]);
        } catch (\Exception $err) {
            Log::error("File: " . $err->getFile() . " Line: " . $err->getLine() . " Error: " . $err->getMessage());
            return response()->json(["status" => false, "message" => "unexpected error"]);
        }
    }

    public function update(UpdatePersonRequest $request)
    {
        try {
            $data = $request->only("name", "surname", "photo", "position", "department_id", "id", "change_photo");

            $person = Person::where("id", $data["id"])->first();

            $photo = $person->photo;

            if (!$person) {
                return response()->json(["status" => "error", "message" => "Person not found"], 404);
            }

            if (isset($data["change_photo"])) {
                $photo = $this->updateFile($data["photo"] ?? null, $person->photo);
            }

            $person->update([
                "name" => $data["name"],
                "surname" => $data["surname"],
                "photo" => $photo,
                "position" => $data["position"],
                "department_id" => $data["department_id"]
            ]);

            return response()->json(["status" => "success", "message" => "Person updated successfully"]);
        } catch (\Exception $err) {
            Log::error("File: " . $err->getFile() . " Line: " . $err->getLine() . " Error: " . $err->getMessage());
            return response()->json(["status" => false, "message" => "unexpected error"]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $id = $request->only("id");
            Person::where("id", $id)->delete();

            return response()->json(["status" => "success", "message" => "Person deleted successfully"]);
        } catch (\Exception $err) {
            Log::error("File: " . $err->getFile() . " Line: " . $err->getLine() . " Error: " . $err->getMessage());
            return response()->json(["status" => false, "message" => "unexpected error"]);
        }
    }


}
