<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Resources</title>
        <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png" />
        <link rel="stylesheet" href="{{ asset('css/resources_style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/base_pagination.css') }}" />
        <link
            rel="stylesheet"
            href="{{ asset('css/moderator/base_moderator_table_style.css') }}"
        />
        <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}" />
        @include('inclusions/libraryLinks')
    </head>
    <body>
        <div class="container">
            @include('inclusions/userNav')
            <main>
                <header>
                    <div class="header-top">
                        @include('includes_syscon.syscon_logo_inc')
                        <div class="notification">
                            <a href="notifications">
                                <i class="fas fa-bell bell-icon"></i>
                            </a>
                        </div>
                    </div>
                    <hr class="divider" />
                </header>

                <div class="container">
                    <div class="header-buttons-search">
                        <div class="header-buttons">
                            <!-- Search Form -->
                            <form
                                method="GET"
                                action="{{ route('user.resources') }}"
                                class="search-bar"
                            >
                                <input
                                    type="text"
                                    name="search"
                                    placeholder="Search resources..."
                                    value="{{ request()->query('search') }}"
                                />
                                <button type="submit">Search</button>
                            </form>
                        </div>
                    </div>

                    <!-- Resources Table -->
                    <table class="resources-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($resources->count() > 0)
                                @foreach ($resources as $resource)
                                    <tr>
                                        <td>{{ $resource->title }}</td>
                                        <td>{{ $resource->description }}</td>
                                        <td>
                                            <a
                                                href="{{ route('moderator.downloadResource', $resource->id) }}"
                                                class="btn-download"
                                            >
                                                Download
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">
                                        No resources found
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="paginationContent">
                        <ul class="pagination">
                            <!-- Previous Page Button -->
                            <li
                                class="page-item {{ $resources->currentPage() == 1 ? 'disabled' : '' }}"
                            >
                                <a
                                    href="{{ $resources->appends(request()->input())->previousPageUrl() }}"
                                    rel="prev"
                                >
                                    &lt;
                                </a>
                            </li>

                            <!-- Page Numbers -->
                            @for ($i = 1; $i <= $resources->lastPage(); $i++)
                                <li
                                    class="page-item {{ $resources->currentPage() == $i ? 'active' : '' }}"
                                >
                                    <a
                                        href="{{ $resources->appends(request()->input())->url($i) }}"
                                    >
                                        {{ $i }}
                                    </a>
                                </li>
                            @endfor

                            <!-- Next Page Button -->
                            <li
                                class="page-item {{ $resources->hasMorePages() ? '' : 'disabled' }}"
                            >
                                <a
                                    href="{{ $resources->appends(request()->input())->nextPageUrl() }}"
                                    rel="next"
                                >
                                    &gt;
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </main>
        </div>
        <script src="../js/settings.js"></script>
        <script src="js/logout.js"></script>
    </body>
</html>
