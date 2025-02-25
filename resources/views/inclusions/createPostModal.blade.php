<div class="new-post">
    <i class="fas fa-edit"></i>
</div>
<div id="postModal" class="post-modal">
    <div class="post-modal-content">
        <span class="create-post-close close">&times;</span>
        <form action="{{ route('users.createPost') }}" method="POST" enctype="multipart/form-data">
            @csrf 
            @include('inclusions/response')
            <div class="post-header">
                <img src="{{ Auth::user()->userPhoto ? Storage::url(Auth::user()->userPhoto) : '../../imgs/user-img.png' }}" alt="Profile Picture" class="post-profile-pic">
                <div class="post-modal-info">
                    <h2>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</h2>
                    <p>@<span>{{ Auth::user()->username }}</span></p>
                </div>                
            </div>
            <div class="post-modal-text">
                <textarea name="concern" placeholder="Ask concerns..." required></textarea>
            </div>
            <div class="post-modal-expertise">
                <select id="fieldExpertise" name="concernCategory" required>
                    <option value="">Select Concern Category</option>
                </select>                                
            </div>
            <div class="law-category">
                <a id="view-laws-category">View Laws Category</a>
            </div>
            <div id="image-preview-section" class="post-modal-photo" style="display: none;">
                <img id="image-preview" src="" alt="Image Preview">
                <button type="button" id="remove-image"><i class="fa-regular fa-circle-xmark"></i></button>
            </div>
            <div class="post-modal-footer">
                <label for="file-upload" class="custom-file-upload">
                    <i class="fa-solid fa-file-arrow-up"></i>
                </label>
                <input id="file-upload" type="file" name="concernPhoto" style="display: none;">
                <p>Note: The post will be reviewed first prior to the approval of the moderators to make sure that it follows a certain measure of decency.</p>
                <button type="submit" class="post-button">Post</button>
            </div>
        </form>
    </div>
</div>

@include('inclusions/showLawCategory')

<script src="js/showExpertise.js"></script>

{{-- <script>
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('view-laws-category').addEventListener('click', () => {
            const lawCategoryModal = document.getElementById('law-category-modal');
            lawCategoryModal.style.display = 'block'; // Show modal
        });

        document.getElementById('close-law-category-modal').addEventListener('click', () => {
            const lawCategoryModal = document.getElementById('law-category-modal');
            lawCategoryModal.style.display = 'none'; // Hide modal
        });
    });
</script> --}}
