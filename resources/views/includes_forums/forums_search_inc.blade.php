@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Forums</h1>

    <!-- Search Form -->
    <form action="{{ route('admin.forums') }}" method="GET">
        <div class="input-group mb-3">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search for forums..."
                value="{{ request('search') }}"
            />
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <!-- Existing table and content -->
    <!-- ... -->
</div>
