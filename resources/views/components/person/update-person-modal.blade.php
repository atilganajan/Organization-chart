<div class="modal fade" id="updatePersonModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Person</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route("person.update")}}" method="POST"  id="personUpdateForm" enctype="multipart/form-data">
                    @method('PUT')
                    <div>
                        <ul id="personUpdateErrorContainer"></ul>
                    </div>
                    <div class="row justify-content-center">
                        <img src="" id="photo" style="width: 150px">
                    </div>
                    <input type="hidden" id="person_id" name="id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text"  maxlength="100" id="name" class="form-control shadow-sm" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Surname</label>
                        <input type="text" maxlength="100" id="surname" class="form-control shadow-sm" name="surname">
                    </div>
                    <div class="mb-3">
                        <label for="department_id" class="form-label">Department</label>
                        <select class="form-control shadow-sm" id="department_id" name="department_id">
                            <option value="">Select department</option>
                            @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" maxlength="100" class="form-control shadow-sm" id="position" name="position">
                    </div>
                    <div class="mb-4">
                        <label for="showPhoto" class="form-label">Change Image</label>

                            <input type="checkbox" id="showPhoto"  name="change_photo" class="shadow-sm" onchange="togglePhotoVisibility()">

                    </div>
                    <div class="mb-3 parentPhotoContainer" style="display: none">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" maxlength="100" class="form-control shadow-sm" name="photo">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="personUpdateBtn" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>
<script>
    function togglePhotoVisibility() {
        const showPhotoCheckbox = $("#showPhoto");
        const photoInputContainer = $(".parentPhotoContainer");

        if (showPhotoCheckbox.prop("checked")) {
            photoInputContainer.show();
        } else {
            photoInputContainer.hide();
        }
    }

</script>

