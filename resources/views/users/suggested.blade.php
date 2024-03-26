{{-- users/suggested.blade.php --}}

@extends('layouts.app')

@section('title', 'Suggested Users')

@section('content')
@foreach ($suggested_users as $user)
    <div class="row align-items-center mb-3">
        <div class="col-auto">
            <a href="{{ route('profile.show', $user->id) }}">
                @if ($user->avatar)
                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle avatar-sm">
                @else
                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                @endif
            </a>
        </div>
        <div class="col ps-0 text-truncate">
            <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $user->name }}</a>
        </div>
        <div class="col-auto">
            <form action="{{ route('follow.store', $user->id) }}" method="post">
                @csrf
                <button type="submit" class="border-0 bg-transparent p-0 text-primary btn-sm">Follow</button>
            </form>
        </div>
    </div>
@endforeach
@endsection
