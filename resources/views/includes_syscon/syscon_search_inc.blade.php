<form action="{{ route('admin.systemcontent.search') }}" method="GET">
    <div class="search-bar">
        <input
            type="text"
            name="query"
            placeholder="Search..."
            class="form-control"
        />
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
</form>
