<div id="reportModal" class="reportModal" style="display: none;">
    <div class="reportModal-content">
        <span class="report-close">&times;</span>
        <h2>Report Post</h2>
        <p>Please select a reason for reporting this post:</p>
        
        <div>
            <label><input type="radio" name="reportReason" value="Inappropriate Content"> Inappropriate Content</label><br>
            <label><input type="radio" name="reportReason" value="Harassment"> Harassment</label><br>
            <label><input type="radio" name="reportReason" value="Spam"> Spam</label><br>
            <label><input type="radio" name="reportReason" value="False Information"> False Information</label><br>
            <label><input type="radio" name="reportReason" value="Others"> Others</label><br>
        </div>
        
        <div id="otherReasonDiv" style="display: none;">
            <textarea id="otherReason" rows="5" placeholder="Please specify other reasons..."></textarea>
        </div>

        <br>
        <button id="submitReport">Submit Report</button>
    </div>
</div><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/inclusions/reportPostModal.blade.php ENDPATH**/ ?>