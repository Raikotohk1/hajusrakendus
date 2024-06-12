@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Blog</h1>
        <form action="{{ route('chirps.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <input type="text" class="form-control" id="message" name="message">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
