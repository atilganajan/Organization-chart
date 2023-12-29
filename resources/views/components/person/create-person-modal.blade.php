<div class="modal fade" id="createPersonModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Person</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route("person.create")}}" method="POST" id="personCreateForm" enctype="multipart/form-data">

                    <div>
                        <ul id="personCreateErrorContainer"></ul>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" maxlength="100" class="form-control shadow-sm" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Surname</label>
                        <input type="text" maxlength="100" class="form-control shadow-sm" name="surname">
                    </div>
                    <div class="mb-3">
                        <label for="department_id" class="form-label">Department</label>
                        <select class="form-control shadow-sm" name="department_id">
                            <option value="">Select department</option>
                            @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" maxlength="100" class="form-control shadow-sm" name="position">
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" maxlength="100" class="form-control shadow-sm" name="photo">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="personCreateBtn" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>

