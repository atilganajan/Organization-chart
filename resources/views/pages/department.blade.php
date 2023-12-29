<x-app-layout>


    <div class="container mt-4">

        <div class=" mt-3 mx-3 d-flex justify-content-between">
            <a href="{{route("home")}}" class="btn btn-danger" >
                &larr; Back to Home
            </a>

            <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#createDepartmentModal" >
                Create Department
            </button>

        </div>

        <div class="d-flex justify-content-center w-100">
            <h2 class="text-center">Departments</h2>
        </div>

        <x-department.department-datatable/>

    </div>

    <x-department.create-department-modal :departments="$departments" />

    @section("script")
        <script src="{{asset("assets/js/department/department.js")}}"></script>
        <script>
            $(document).ready(function () {
               Department.initializeDataTable("{{route("department.list")}}")
               Department.initializeCreateDepartment();
            });
        </script>
    @endsection


</x-app-layout>
