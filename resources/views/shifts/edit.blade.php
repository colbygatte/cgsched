@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ $shift->definition->name }} shift on {{ $shift->date->toDateString() }}</strong>

                        @admin
                        <span class="badge badge-secondary badge-danger ml-1">Delete</span>
                        @endadmin
                    </div>

                    <div class="card-body">
                        Employees on shift:

                        <ul>
                            @foreach ($shift->users as $user)
                                <li>
                                    {{ $user->name }}

                                    <form action="{{ route('shifts.destroy', [$shift, $user]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                                        <button type="submit">Remove from Shift</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>

                        Employees not on shift:
                        <ul>
                            @foreach (App\User::all() as $user)
                                @if (! $shift->users->contains($user))
                                    <li>
                                        {{ $user->name }}

                                        <form action="{{ route('shifts.store', [$shift, $user]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                                            <button type="submit">Add to Shift</button>
                                        </form>
                                    </li>
                                @endif
                            @endforeach
                        </ul>

                        @if(session('status'))
                            {{ session('status') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection