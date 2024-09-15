<div class="table-content">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>File</th>
                <th>Date Uploaded</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($resources as $resource)
                <tr>
                    <td>{{ $resource->id }}</td>
                    <td>{{ $resource->documentTitle }}</td>
                    <td>{{ $resource->documentDesc }}</td>
                    <td>
                        <a href="{{ $resource->documentFile }}">
                            {{ $resource->documentFile }}
                        </a>
                    </td>
                    <td>{{ $resource->created_at->format('Y-m-d') }}</td>
                    <td>
                        <button
                            class="view-button"
                            data-id="{{ $resource->id }}"
                            data-title="{{ $resource->documentTitle }}"
                            data-desc="{{ $resource->documentDesc }}"
                            data-file="{{ $resource->documentFile }}"
                            data-date="{{ $resource->created_at }}"
                        >
                            Edit
                        </button>
                        <form
                            method="post"
                            action=""
                            onsubmit="confirmDelete(event);"
                        >
                            @csrf
                            @method('delete')
                            <button type="submit" class="custom-button">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No resources found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="paginationContent">
        <ul class="pagination">
            <li
                class="page-item {{ $resources->currentPage() == 1 ? 'disabled' : '' }}"
                aria-disabled="{{ $resources->currentPage() == 1 }}"
            >
                <a
                    class="page-link"
                    href="{{ $resources->appends(request()->input())->previousPageUrl() }}"
                    rel="prev"
                >
                    &laquo;
                </a>
            </li>

            @for ($i = 1; $i <= $resources->lastPage(); $i++)
                <li
                    class="page-item {{ $resources->currentPage() == $i ? 'active' : '' }}"
                >
                    <a
                        class="page-link"
                        href="{{ $resources->appends(request()->input())->url($i) }}"
                    >
                        {{ $i }}
                    </a>
                </li>
            @endfor

            <li
                class="page-item {{ $resources->hasMorePages() ? '' : 'disabled' }}"
                aria-disabled="{{ ! $resources->hasMorePages() }}"
            >
                <a
                    class="page-link"
                    href="{{ $resources->appends(request()->input())->nextPageUrl() }}"
                    rel="next"
                >
                    &raquo;
                </a>
            </li>
        </ul>
    </div>
</div>
