<form action="{{ route('search.articlesMod') }}" method="GET">
    <div class="search-bar-content">
        <div class="search-bar">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search Laws"
                value="{{ request()->input('query') }}"
            />
        </div>
    </div>
</form>
