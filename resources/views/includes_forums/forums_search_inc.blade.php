<form action="{{ route('admin.searchForums') }}" method="GET">
    <div class="form-group">
        <div class="form-search" style="width: 100%">
            <input
                type="text"
                name="query"
                class="form-control"
                placeholder="Search for Forums or Key Words..."
            />
        </div>
    </div>
</form>
