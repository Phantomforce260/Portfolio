var images = document.querySelectorAll(".interactable");
var overlay = document.getElementById("overlay");
var zoomIn = document.getElementById("zoom-in");

images.forEach(function(image) {
    image.addEventListener('click', function() {
        zoomIn.src = image.src;

        overlay.style.display = 'block';
        zoomIn.style.display = 'block';
    });
});

overlay.addEventListener('click', function() {
    overlay.style.display = 'none';
    zoomIn.style.display = 'none';
});