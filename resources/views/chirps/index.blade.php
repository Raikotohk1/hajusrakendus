@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Blogi</h1>
        <a href="{{ route('chirps.create') }}" class="btn btn-primary">Create Blog</a>
        <ul>
            @foreach ($chirps as $chirp)
                <li>{{ $chirp->message }} by {{ $chirp->user->name }}
                    <a href="{{ route('chirps.edit', $chirp) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('chirps.destroy', $chirp) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
