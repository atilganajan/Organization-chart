<ul class="list-group">
    @foreach ($subDepartments as $subDepartment)
        <li class="list-group-item">{{ $subDepartment->name }}
            @if($subDepartment->subDepartments->isNotEmpty())
                <x-home.chart-item :subDepartments="$subDepartment->subDepartments" />
            @endif
            @if($subDepartment->persons->isNotEmpty())
                <ul class="list-group">
                    @foreach($subDepartment->persons as $person)
                        <li class="list-group-item">{{ $person->name }}</li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
