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

        <x-department.department-datatable :departments="$departments" />

    </div>

    <x-department.create-department-modal :departments="$departments" />
    <x-department.update-department-modal :departments="$departments" />

    @section("script")
        <script src="{{asset("assets/js/department/department.js")}}"></script>
        <script>
            $(document).ready(function () {
                Department.initializeDataTable()
                Department.initializeCreateDepartment();
                Department.initializeUpdateDepartment();
            });
        </script>
    @endsection


</x-app-layout>
