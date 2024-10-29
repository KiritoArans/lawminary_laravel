<div id="conPhotoModal-{{ $post->post_id }}" class="conPhotoModal">
    <div class="conPhotoModal-content">
        <span class="conPhotoModal-close" onclick="closeConPhoto('{{ $post->post_id }}')">
            <i class="fa-regular fa-circle-xmark"></i>
        </span>                     
        <img
            src="{{ $post->concernPhoto ? Storage::url($post->concernPhoto) : asset('imgs/user-img.png') }}"
            alt="Concern Photo"
            style="width: 100%; height: auto;" />
    </div>
</div>   