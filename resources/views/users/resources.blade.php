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
        <link
            rel="stylesheet"
            href="{{ asset('css/responsive/navres.css') }}"
        />
        @include('inclusions/libraryLinks')
    </head>
    <body>
        <div class="container">
            @include('inclusions/userNav')
            <main>
                <header>
                    <div class="header-top">
                        <i class="fa-solid fa-bars"></i>
                        @include('includes_syscon.syscon_logo_inc')
                        <div class="notification">
                            <a href="notifications" class="notification-link">
                                <i class="fas fa-bell bell-icon current"></i>
                                <span
                                    id="notification-count"
                                    class="notification-badge"
                                ></span>
                            </a>
                        </div>
                    </div>
                    <hr class="divider" />
                </header>

                <section>
                    <div class="search-form">
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
                                                href="{{ route('user.downloadResource', $resource->id) }}"
                                                class="btn-download"
                                            >
                                                Click to Download
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

                    @if ($resources->total() > 10)
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
                    @endif
                </section>
            </main>
        </div>
        <script src="js/showUserNav.js"></script>
        <script src="js/showNotification.js"></script>
        <script src="../js/settings.js"></script>
        <script src="js/logout.js"></script>
    </body>
</html>
