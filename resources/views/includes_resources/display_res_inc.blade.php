<div class="table-content">
    <p>*click cell to view data</p>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
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
                        <td
                            class="clickable-cell"
                            data-full-text="{{ $resource->documentTitle }}"
                        >
                            {{ \Illuminate\Support\Str::limit($resource->documentTitle, 10) }}
                        </td>
                        <td
                            class="clickable-cell"
                            data-full-text="{{ $resource->documentDesc }}"
                        >
                            {{ \Illuminate\Support\Str::limit($resource->documentDesc, 15) }}
                        </td>
                        <td>
                            <a
                                href="{{ route('moderator.downloadResource', $resource->id) }}"
                            >
                                Download File
                            </a>
                        </td>
                        <td>{{ $resource->created_at->format('Y-m-d') }}</td>
                        <td>
                            @include('includes_resources.update_res_inc', ['resource' => $resource])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No resources found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Structure -->
    <div id="textModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div class="modal-body">
                <p id="modalContent"></p>
            </div>
        </div>
    </div>

    <div class="paginationContent">
        <ul class="pagination">
            <!-- Previous Page Button -->
            <li
                class="page-item {{ $resources->currentPage() == 1 ? 'disabled' : '' }}"
                aria-disabled="{{ $resources->currentPage() == 1 }}"
            >
                <a
                    class="page-link"
                    href="{{ $resources->appends(request()->input())->previousPageUrl() }}"
                    rel="prev"
                >
                    <i class="fas fa-chevron-left"></i>
                    <!-- Left Arrow Icon -->
                </a>
            </li>

            <!-- Page Numbers -->
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

            <!-- Next Page Button -->
            <li
                class="page-item {{ $resources->hasMorePages() ? '' : 'disabled' }}"
                aria-disabled="{{ ! $resources->hasMorePages() }}"
            >
                <a
                    class="page-link"
                    href="{{ $resources->appends(request()->input())->nextPageUrl() }}"
                    rel="next"
                >
                    <i class="fas fa-chevron-right"></i>
                    <!-- Right Arrow Icon -->
                </a>
            </li>
        </ul>
    </div>
</div>
