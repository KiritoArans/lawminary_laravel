<!-- Button to trigger modal -->
<button id="viewPendingButton" class="custom-button">View Pending Posts</button>

<!-- Modal structure -->
<div id="pendingPostsModal" class="modal">
    <div class="modal-content">
        <span class="close-button" id="closeModal">&times;</span>
        <h2>Pending Posts</h2>

        <!-- Your Pending Posts Table goes here -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Post ID</th>
                    <th>Content</th>
                    <th>Tags</th>
                    <th>Posted By</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendingPosts as $post)
                    @include('inclusions.response')
                    <tr>
                        <td>{{ $post->post_id }}</td>
                        <td>{{ $post->concern }}</td>
                        <td>{{ $post->tags }}</td>
                        <td>{{ $post->postedBy }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($post->updated_at)->format('Y-m-d') }}
                        </td>
                        <td>
                            <div class="action-cell">
                                <!-- Approve Form -->
                                <form
                                    action="{{ request()->is('admin*') ? route('admin.postpage') : route('moderator.postpage') }}"
                                    method="POST"
                                    style="display: inline-block"
                                >
                                    @csrf
                                    <input
                                        type="hidden"
                                        name="post_id"
                                        value="{{ $post->post_id }}"
                                    />
                                    <button
                                        type="submit"
                                        name="approve"
                                        class="btn-view-approve"
                                    >
                                        Approve
                                    </button>
                                </form>

                                <!-- Disregard Form -->
                                <form
                                    action="{{ request()->is('admin*') ? route('admin.postpage') : route('moderator.postpage') }}"
                                    method="POST"
                                    style="display: inline-block"
                                >
                                    @csrf
                                    <input
                                        type="hidden"
                                        name="post_id"
                                        value="{{ $post->post_id }}"
                                    />
                                    @include('includes_postpage.post_reject_inc')
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
