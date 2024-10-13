<div id="rateModal" class="rate-modal" style="display: none">
    <div class="rate-modal-content">
        <span class="close-rate-modal">&times;</span>

        <form id="rateForm" action="{{ route('rateComment') }}" method="POST" class="rate-comment-form">
            @csrf
            <h2>Rate Comment</h2>
            <input type="hidden" name="comment_id" id="rating_comment_id">
            <input type="hidden" name="lawyerUser_id" id="rating_lawyerUser_id">
            <input type="hidden" name="rating" id="star-rating">
            <div class="rate-stars">
                <i class="fa fa-star star" data-rating="1"></i>
                <i class="fa fa-star star" data-rating="2"></i>
                <i class="fa fa-star star" data-rating="3"></i>
                <i class="fa fa-star star" data-rating="4"></i>
                <i class="fa fa-star star" data-rating="5"></i>
            </div>
            <button type="submit">Submit Rating</button>
        </form>
    </div>
</div>
