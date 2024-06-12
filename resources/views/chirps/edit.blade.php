@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Chirp</h1>
        <form action="{{ route('chirps.update', $chirp) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <input type="text" class="form-control" id="message" name="message" value="{{ $chirp->message }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
