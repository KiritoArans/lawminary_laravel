<button
    type="button"
    class="btn-view-reject"
    data-target="#disregardModal-{{ $post->post_id }}"
    name="reject"
>
    <i class="fa-solid fa-x"></i>
</button>

<!-- Disregard Modal -->
<div
    class="modal fade"
    id="disregardModal-{{ $post->post_id }}"
    tabindex="-1"
    role="dialog"
    aria-labelledby="disregardModalLabel"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="close-button-reason" id="closeModal">&times;</div>

            <div class="modal-header">
                <h5 class="modal-title" id="disregardModalLabel">
                    Provide reason for rejection
                </h5>
            </div>
            <div class="modal-body">
                <form
                    method="POST"
                    action="{{ route('admin.postpage', $post->post_id) }}"
                >
                    @csrf
                    <input
                        type="hidden"
                        name="post_id"
                        value="{{ $post->post_id }}"
                    />
                    <div class="form-group">
                        <textarea
                            class="form-control"
                            name="reasonDisregard"
                            id="reasonDisregard-{{ $post->post_id }}"
                            required
                        ></textarea>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="submit"
                            class="custom-button"
                            name="reject"
                        >
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
