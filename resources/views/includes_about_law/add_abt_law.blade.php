<!-- Button to open the modal -->
<div class="add-class">
    <button class="custom-button">Add Law</button>

    <!-- Modal Structure -->
    <div id="addLawModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" id="closeAddLawModal">&times;</span>
            <h2>Add New Law</h2>
            <input
                type="hidden"
                id="successMessage"
                value="{{ session('success') }}"
            />
            <form
                id="addLawForm"
                action="{{ route('add.law') }}"
                method="POST"
            >
                @csrf
                <!-- CSRF token for security -->

                <label for="title">Title No:</label>
                <input type="number" id="title" name="title" required />

                <label for="article_no">Article No:</label>
                <input
                    type="number"
                    id="article_no"
                    name="article_no"
                    required
                />

                <label for="title_name">Title Name:</label>
                <input type="text" id="title_name" name="title_name" required />

                <label for="chapter_number">Chapter No:</label>
                <input
                    type="number"
                    id="chapter_number"
                    name="chapter_number"
                    required
                />

                <label for="chapter_name">Chapter Name:</label>
                <input
                    type="text"
                    id="chapter_name"
                    name="chapter_name"
                    required
                />

                <label for="section">Section:</label>
                <input type="number" id="section" name="section" required />

                <label for="section_name">Section Name:</label>
                <input
                    type="text"
                    id="section_name"
                    name="section_name"
                    required
                />

                <label for="article_name">Article Name:</label>
                <input
                    type="text"
                    id="article_name"
                    name="article_name"
                    required
                />

                <label for="description">Law Description:</label>
                <textarea
                    id="description"
                    name="description"
                    required
                ></textarea>

                <label for="synonyms">
                    Synonyms: e.g (killed, theft, robbery)
                </label>
                <input type="text" id="synonyms" name="synonyms" required />

                <button type="submit" class="custom-button">Submit</button>
            </form>
        </div>
    </div>
</div>
