@extends('layouts.app')

@section('content')
    <ol>
        @foreach ($links as $link)
            <li>
                <a href="{{ $link['url'] }}">{{ $link['date'] }}</a>
            </li>
        @endforeach

        @if($previousUrl)
            <a href="{{ $previousUrl }}">Previous</a>
        @endif

        @if($nextUrl)
            <a href="{{ $nextUrl }}">Next</a>
        @endif
    </ol>
@endsection