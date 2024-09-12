<form action="{{ route('admin.search') }}" method="GET">
    <div class="input-group mb-3">
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search for activities"
            value="{{ request('search') }}"
        />
    </div>
    <button class="btn btn-primary" type="submit">Search</button>
</form>
