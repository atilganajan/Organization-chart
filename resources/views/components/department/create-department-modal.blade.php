<div class="modal fade" id="createDepartmentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Department</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route("department.create")}}" method="POST" id="departmentCreateForm">

                    <div>
                        <ul id="departmentErrorContainer"></ul>
                    </div>

                    <div class="mb-3">
                        <label for="parent_department_id" class="form-label">Parent Department</label>
                        <select class="form-control shadow-sm" name="parent_department_id">
                            <option value="">Select department</option>
                            @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" maxlength="100" class="form-control shadow-sm" name="name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="departmentCreateBtn" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>

