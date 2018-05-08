@extends('layouts.app')

@section('content')
    <ul>
        @foreach ($links as $link)
            <li>
                <a href="{{ $link['url'] }}">{{ $link['date'] }}</a>
            </li>
        @endforeach
    </ul>
@endsection