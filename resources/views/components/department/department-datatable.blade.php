<table id="departmentDataTable" class="table table-striped cell-border w-100" style="text-align: center;vertical-align: middle;">
    <thead>
    <tr>
        <th>ID</th>
        <th>Department Name</th>
        <th>Parent Department</th>
        <th>Action</th>
    </tr>
    </thead>
    <thead>
    <tr>
        <th><input type="text" class="form-control filter-input shadow-sm" data-column="0" ></th>
        <th>
            <select type="text" class="form-control filter-input shadow-sm" data-column="1" >
                <option value="">Select department</option>
                @foreach($departments as $department)
                    <option value="{{$department->id}}">{{$department->name}}</option>
                @endforeach
            </select>
        </th>
        <th>
            <select type="text" class="form-control filter-input shadow-sm" data-column="2" >
                <option value="">Select department</option>
                @foreach($departments as $department)
                    <option value="{{$department->id}}">{{$department->name}}</option>
                @endforeach
            </select>
        </th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>
