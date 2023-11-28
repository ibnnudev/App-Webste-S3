// script.js

const slider = document.querySelector('.joki');
let isDragging = false;
let startPosition = 0;
let currentTranslate = 0;
let prevTranslate = 0;

slider.addEventListener('touchstart', touchStart);
slider.addEventListener('touchmove', touchMove);
slider.addEventListener('touchend', touchEnd);

function touchStart(event) {
    startPosition = event.touches[0].clientX;
    isDragging = true;

    // Stop any ongoing animations
    clearInterval(animationID);
}

function touchMove(event) {
    if (isDragging) {
        const currentPosition = event.touches[0].clientX;
        currentTranslate = currentPosition - startPosition + prevTranslate;
    }
}

function touchEnd() {
    isDragging = false;

    // Snap the slider to the closest item
    const threshold = 100;

    if (Math.abs(currentTranslate - prevTranslate) > threshold) {
        if (currentTranslate > prevTranslate) {
            slide(-1); // Slide to previous item
        } else {
            slide(1); // Slide to next item
        }
    } else {
        slide(0); // Stay at the current item
    }

    prevTranslate = currentTranslate;
}

function slide(direction) {
    const slideWidth = slider.clientWidth;

    if (direction === -1 && currentSlide > 0) {
        currentSlide--;
    } else if (direction === 1 && currentSlide < slides.length - 1) {
        currentSlide++;
    }

    const transform = `translateX(-${currentSlide * slideWidth}px)`;
    slider.style.transform = transform;
}


function toggleDropdown() {
    var dropdownContent = document.querySelector('.dropdown-content');
    dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
  }





  function toggleDropdown() {
    var dropdownContent = document.getElementById("myDropdown");
    dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
  }
  
  // Tutup dropdown ketika mengklik di luar dropdown
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.style.display === 'block') {
          openDropdown.style.display = 'none';
        }
      }
    }
  }
  



  swal.fire("Berhasil!", "Update id_worker dan statsdone berhasil.", "success");
