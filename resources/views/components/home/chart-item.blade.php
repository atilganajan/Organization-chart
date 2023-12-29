<ul class="list-group">
    @foreach ($subDepartments as $subDepartment)
        <li class="list-group-item">{{ $subDepartment->name }}
            @if($subDepartment->subDepartments->isNotEmpty())
                <x-home.chart-item :subDepartments="$subDepartment->subDepartments" />
            @endif
            @if($subDepartment->persons->isNotEmpty())
                <ul class="list-group">
                    @foreach($subDepartment->persons as $person)
                        <li class="list-group-item">@if($person->photo )<img src="{{$person->photo}}" style="width: 40px">@else <i class="fas fa-user-circle" style="font-size: 40px;"></i> @endif {{$person->position}} ({{ $person->name }} {{ $person->surname }}</li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
