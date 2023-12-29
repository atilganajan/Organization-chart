<x-app-layout>
        <div class="container mt-4">
            <div class="d-flex justify-content-center w-100">
                <h2 class="text-center">Organization Chart</h2>
            </div>

            <ul class="list-group">
                @foreach ($departments->where('parent_department_id', null) as $department)
                    <li class="list-group-item">{{ $department->name }}
                        @if($department->subDepartments->isNotEmpty())
                            <ul class="list-group">

                                    @foreach ($department->subDepartments as $subDepartment)
                                        <li class="list-group-item">{{ $subDepartment->name }}
                                            @if($subDepartment->subDepartments->isNotEmpty())
                                                @include('partials.subdepartments', ['subDepartments' => $subDepartment->subDepartments])
                                            @endif
                                            @if($subDepartment->persons->isNotEmpty())
                                                <ul class="list-group">
                                                    @foreach($subDepartment->persons as $person)
                                                        <li class="list-group-item">{{$person->position}} ({{ $person->name }} {{ $person->surname }})</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach


                            </ul>
                        @endif
                        @if($department->persons->isNotEmpty())
                            <ul class="list-group">
                                @foreach($department->persons as $person)
                                    <li class="list-group-item">{{$person->position}} ({{ $person->name }} {{ $person->surname }})</li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

</x-app-layout>
