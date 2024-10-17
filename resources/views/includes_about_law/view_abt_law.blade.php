<p>*click cell to view data</p>

<div class="table-responsive">
    @if ($articles->isNotEmpty())
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Title No</th>
                    <th>Article No</th>
                    <th>Title Name</th>
                    <th>Chapter No</th>
                    <th>Chapter Name</th>
                    <th>Section</th>
                    <th>Section Name</th>
                    <th>Article Name</th>
                    <th>Law Description</th>
                    <th>Synonyms</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td
                            class="clickable-cell"
                            data-full-text="{{ $article->title }}"
                        >
                            {{ Str::limit($article->title, 15) }}
                        </td>
                        <td
                            class="clickable-cell"
                            data-full-text="{{ $article->article_no }}"
                        >
                            {{ Str::limit($article->article_no, 15) }}
                        </td>
                        <td
                            class="clickable-cell"
                            data-full-text="{{ $article->title_name }}"
                        >
                            {{ Str::limit($article->title_name, 50) }}
                        </td>
                        <td
                            class="clickable-cell"
                            data-full-text="{{ $article->chapter_number }}"
                        >
                            {{ Str::limit($article->chapter_number, 50) }}
                        </td>
                        <td
                            class="clickable-cell"
                            data-full-text="{{ $article->chapter_name }}"
                        >
                            {{ Str::limit($article->chapter_name, 50) }}
                        </td>
                        <td
                            class="clickable-cell"
                            data-full-text="{{ $article->section }}"
                        >
                            {{ Str::limit($article->section, 50) }}
                        </td>
                        <td
                            class="clickable-cell"
                            data-full-text="{{ $article->section_name }}"
                        >
                            {{ Str::limit($article->section_name, 50) }}
                        </td>
                        <td
                            class="clickable-cell"
                            data-full-text="{{ $article->article_name }}"
                        >
                            {{ Str::limit($article->article_name, 50) }}
                        </td>

                        <td
                            class="clickable-cell"
                            data-full-description="{{ $article->description }}"
                        >
                            {{ Str::limit($article->description, 50) }}
                        </td>
                        <td
                            class="clickable-cell"
                            data-full-text="{{ $article->synonyms }}"
                        >
                            {{ Str::limit($article->synonyms, 50) }}
                        </td>
                        <td>
                            <!-- Edit Button -->
                            <button
                                id="edit-button"
                                class="edit-button"
                                data-id="{{ $article->id }}"
                            >
                                Edit
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>{{ $noResultsMessage }}</p>
    @endif
</div>

<div class="paginationContent">
    <ul class="pagination">
        <li
            class="page-item {{ $articles->currentPage() == 1 ? 'disabled' : '' }}"
            aria-disabled="{{ $articles->currentPage() == 1 }}"
        >
            <a
                class="page-link"
                href="{{ $articles->appends(request()->input())->previousPageUrl() }}"
                rel="prev"
            >
                &laquo;
            </a>
        </li>

        @php
            // Define the range of pages to show
            $start = max(1, $articles->currentPage() - 2);
            $end = min($articles->lastPage(), $articles->currentPage() + 2);
        @endphp

        @if ($start > 1)
            <li class="page-item">
                <a
                    class="page-link"
                    href="{{ $articles->appends(request()->input())->url(1) }}"
                >
                    1
                </a>
            </li>
            @if ($start > 2)
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            @endif
        @endif

        @for ($i = $start; $i <= $end; $i++)
            <li
                class="page-item {{ $articles->currentPage() == $i ? 'active' : '' }}"
            >
                <a
                    class="page-link"
                    href="{{ $articles->appends(request()->input())->url($i) }}"
                >
                    {{ $i }}
                </a>
            </li>
        @endfor

        @if ($end < $articles->lastPage())
            @if ($end < $articles->lastPage() - 1)
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            @endif

            <li class="page-item">
                <a
                    class="page-link"
                    href="{{ $articles->appends(request()->input())->url($articles->lastPage()) }}"
                >
                    {{ $articles->lastPage() }}
                </a>
            </li>
        @endif

        <li
            class="page-item {{ $articles->hasMorePages() ? '' : 'disabled' }}"
            aria-disabled="{{ ! $articles->hasMorePages() }}"
        >
            <a
                class="page-link"
                href="{{ $articles->appends(request()->input())->nextPageUrl() }}"
                rel="next"
            >
                &raquo;
            </a>
        </li>
    </ul>
</div>
@if ($articles->isNotEmpty())
    <!-- modal for table cell -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <span class="close-button" id="closeModal">&times;</span>

            <div id="modalContent"></div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editLawModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" id="closeEditModal">&times;</span>
            <h2>Edit Law</h2>
            <input
                type="hidden"
                id="successMessage"
                value="{{ session('success') }}"
            />

            <!-- Update Law Form -->
            <form
                id="editLawForm"
                method="POST"
                action="{{ route('update.law', $article->id) }}"
            >
                @csrf
                @method('PUT')
                <!-- PUT method for updating -->

                <input type="hidden" id="edit_law_id" name="id" />
                <!-- Hidden input for law ID -->

                <label for="edit_title">Title No:</label>
                <input type="number" id="edit_title" name="title" required />

                <label for="edit_article_no">Article No:</label>
                <input
                    type="number"
                    id="edit_article_no"
                    name="article_no"
                    required
                />

                <label for="edit_title_name">Title Name:</label>
                <input
                    type="text"
                    id="edit_title_name"
                    name="title_name"
                    required
                />

                <label for="edit_chapter_number">Chapter No:</label>
                <input
                    type="number"
                    id="edit_chapter_number"
                    name="chapter_number"
                    required
                />

                <label for="edit_chapter_name">Chapter Name:</label>
                <input
                    type="text"
                    id="edit_chapter_name"
                    name="chapter_name"
                    required
                />

                <label for="edit_section">Section:</label>
                <input
                    type="number"
                    id="edit_section"
                    name="section"
                    required
                />

                <label for="edit_section_name">Section Name:</label>
                <input
                    type="text"
                    id="edit_section_name"
                    name="section_name"
                    required
                />

                <label for="edit_article_name">Article Name:</label>
                <input
                    type="text"
                    id="edit_article_name"
                    name="article_name"
                    required
                />

                <label for="edit_description">Law Description:</label>
                <textarea
                    id="edit_description"
                    name="description"
                    required
                ></textarea>

                <label for="edit_synonyms">
                    Synonyms: e.g (theft, killed, robbery)
                </label>
                <input
                    type="text"
                    id="edit_synonyms"
                    name="synonyms"
                    required
                />

                <button type="submit" class="custom-button">Update Law</button>
            </form>

            <!-- Delete Law Form -->
            <form
                id="deleteLawForm"
                method="POST"
                action="{{ route('delete.law', $article->id) }}"
            >
                @csrf
                @method('DELETE')
                <!-- DELETE method for deleting -->
                <button type="submit" id="delete-button">Delete Law</button>
            </form>
        </div>
    </div>
@endif
