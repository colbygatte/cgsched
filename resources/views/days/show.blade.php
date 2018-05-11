@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($shifts as $shift)
                    <div class="card">
                        <div class="card-header">
                            <strong>{{ $shift->definition->name }}</strong>

                            @admin
                                <a href="{{ route('shifts.edit', $shift) }}" class="badge badge-secondary badge-secondary ml-1">Edit</a>
                                <a href="#" class="badge badge-secondary badge-danger ml-1">Delete</a>
                            @endadmin
                        </div>

                        <div class="card-body">
                            <p>
                                Start time: {{ $shift->definition->start_time->toTimeString() }}
                            </p>
                            <p>
                                End time: {{ $shift->definition->end_time->toTimeString() }}
                            </p>
                        </div>
                    </div>
                @endforeach

                @if ($definitionsMissing)
                    <ul class="pt-4">
                        @foreach ($definitionsMissing as $definition)
                            <li>
                                <form action="{{ route('shifts.makeShift', $definition) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="date" value="{{ $date }}">

                                    <button>Add {{ $definition->name }} shift</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection