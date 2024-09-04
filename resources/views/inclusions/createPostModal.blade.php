<div class="new-post">
    <i class="fas fa-edit"></i>
</div>
<div id="postModal" class="post-modal">
    <div class="post-modal-content">
        <span class="close">&times;</span>
        <form action="{{ route('users.createPost') }}" method="POST" enctype="multipart/form-data">
            @csrf 
            @include('inclusions/response')
            <div class="post-header">
                @if(Auth::user()->userPhoto)
                    <img src="{{ Storage::url(Auth::user()->userPhoto) }}" alt="Profile Picture" class="post-profile-pic">
                @else
                    <img src="../../imgs/user-img.png" alt="Profile Picture" class="post-profile-pic">
                @endif
                <div class="post-modal-info">
                    <h2>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</h2>
                    <p>@<span>{{ Auth::user()->username }}</span></p>
                </div>                
            </div>
            <div class="post-modal-text">
                <textarea name="concern" placeholder="Ask concerns..." required></textarea>
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