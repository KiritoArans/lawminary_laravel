var modal = document.getElementById("postModal");
var btn = document.querySelector(".new-post");
var span = document.getElementsByClassName("close")[0];
var postButton = document.querySelector(".post-button");
btn.onclick = function() {
    modal.style.display = "flex";
}
span.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
postButton.onclick = function() {
    alert("Post button clicked!");
    modal.style.display = "none";
}

document.querySelector('.post-options i').addEventListener('click', function() {
    const options = document.querySelector('.post-options .options');
    if (options.style.display === 'block') {
        options.style.display = 'none';
    } else {
        options.style.display = 'block';
    }
});
