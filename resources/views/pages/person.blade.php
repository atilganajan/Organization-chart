<x-app-layout>
    <div class="container mt-4">
        <div class=" mt-3 mx-3 d-flex justify-content-between">
            <a href="{{route("home")}}" class="btn btn-danger" >
                &larr; Back to Home
            </a>

            <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#createPersonModal" >
                Create Person
            </button>

        </div>

        <div class="d-flex justify-content-center w-100">
            <h2 class="text-center">Persons</h2>
        </div>

        <x-person.person-datatable :departments="$departments" />

    </div>

    <x-person.create-person-modal :departments="$departments" />
    <x-person.update-person-modal :departments="$departments" />

    @section("script")
        <script src="{{asset("assets/js/person/person.js")}}"></script>
        <script>
            $(document).ready(function () {
                Person.initializeDataTable()
                Person.initializeCreatePerson();
                Person.initializeUpdatePerson();
            });
        </script>
    @endsection


</x-app-layout>
