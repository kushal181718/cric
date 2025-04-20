document.addEventListener('DOMContentLoaded', function() {
    let counter = 1;
    const slides = document.querySelectorAll('input[name="slider"]');
    const numOfSlides = slides.length;

    setInterval(() => {
        document.getElementById(`s${counter}`).checked = true;
        counter++;
        if (counter > numOfSlides) {
            counter = 1;
        }
    }, 3000); 
});
