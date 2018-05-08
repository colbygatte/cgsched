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
                            <span class="badge badge-secondary badge-secondary ml-1">Edit</span>
                            <span class="badge badge-secondary badge-danger ml-1">Delete</span>
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