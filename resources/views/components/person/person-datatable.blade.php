<table id="personDataTable" class="table table-striped cell-border w-100" style="text-align: center;vertical-align: middle;">
    <thead>
    <tr>
        <th>ID</th>
        <th>photo</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Department</th>
        <th>Position</th>
        <th>Action</th>
    </tr>
    </thead>
    <thead>
    <tr>
        <th><input type="text" class="form-control filter-input shadow-sm" placeholder="Search ID..." data-column="0"></th>
        <th></th>
        <th><input type="text" class="form-control filter-input shadow-sm" placeholder="Search Name..." data-column="2" ></th>
        <th><input type="text" class="form-control filter-input shadow-sm" placeholder="Search Surname..." data-column="3"></th>
        <th >
            <select type="text" class="form-control filter-input shadow-sm" data-column="4" >
                <option value="">Search Department...</option>
                @foreach($departments as $department)
                    <option value="{{$department->id}}">{{$department->name}}</option>
                @endforeach
            </select>
        </th>
        <th><input type="text" placeholder="Search Surname..." class="form-control filter-input shadow-sm" data-column="5"></th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>
