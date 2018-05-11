@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h2>Your Shifts</h2>

                @foreach ($shifts as $shift)
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <strong>{{ $shift->date->format('M d, Y') }}</strong>

                            <span>{{ $shift->definition->name }}</span>

                            @admin
                                <div>
                                    <span class="badge badge-secondary badge-danger ml-1">Delete</span>
                                </div>
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
            </div>
        </div>
    </div>
@endsection