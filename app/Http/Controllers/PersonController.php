<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\CreatePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Models\Person;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PersonController extends Controller
{
    use FileTrait;

    public function index(){
        $dapertments = Department::get();

        return view("pages.person")->with(["departments"=>$dapertments]);
    }

    public function list(){

        $query = Person::leftJoin("departments", "persons.department_id", "=", "departments.id")
            ->select("persons.*", "departments.name as department_name");


        return DataTables::of($query->get())->toJson();
    }

    public function create(CreatePersonRequest $request){

        $data = $request->only("name","surname","photo","position","department_id");


        if(isset($data["photo"])){
            $data["photo"] = $this->createfile($data["photo"]);
        }

        Person::create([
            "name"=> $data["name"],
            "surname"=> $data["surname"],
            "photo"=> $data["photo"] ?? null,
            "position"=> $data["position"],
            "department_id"=> $data["department_id"]
        ]);

        return response()->json(["status"=>"success","message"=>"Person created successfully"]);
    }

    public function edit($id)
    {
        $person = Person::where("id", $id)->first();

        if (!$person) {
            return response()->json(["status" => "error", "message" => "Person not found"], 404);
        }

        return response()->json(["status" => "success", "person" => $person]);

    }

    public function update(UpdatePersonRequest $request){

        $data = $request->only("name","surname","photo","position","department_id","id");

        $person = Person::where("id",$data["id"])->first();

        if(!$person){
            return response()->json(["status" => "error", "message" => "Person not found"], 404);
        }

        if(isset($data["photo"])){
            $data["photo"] = $this->updateFile($data["photo"],$person->photo);
        }

        $person->update([
            "name"=> $data["name"],
            "surname"=> $data["surname"],
            "photo"=> $data["photo"] ?? $person->photo,
            "position"=> $data["position"],
            "department_id"=> $data["department_id"]
        ]);

        return response()->json(["status"=>"success","message"=>"Person updated successfully"]);
    }

    public function delete(Request $request)
    {
        $id = $request->only("id");
        Person::where("id", $id)->delete();

        return response()->json(["status" => "success", "message" => "Person deleted successfully"]);
    }


}
