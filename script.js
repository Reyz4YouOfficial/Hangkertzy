function toggleMenu() {
      const menu = document.getElementById('menu');
      menu.classList.toggle('active');
    }

  function toggleDarkMode() {
    const body = document.body;
    const modeToggle = document.querySelector('.mode-toggle');

    if (body.classList.contains('dark-mode')) {
      body.classList.remove('dark-mode');
      body.classList.add('light-mode');
      modeToggle.textContent = '🌙'; 
    } else {
      body.classList.remove('light-mode');
      body.classList.add('dark-mode');
      modeToggle.textContent = '☀️';
    }
  }

function closePopup() {
  document.getElementById("popup").style.display = "none";
}

function startMusic() {
  const audio = document.getElementById("background-music");
  audio.play().catch(error => console.log("User harus menekan tombol untuk memutar musik."));
}

window.onload = function () {
  document.getElementById("popup").style.display = "block";
};

  let isProcessing = false;
  function openWA(event) {
    event.preventDefault();
    if (isProcessing) return; 
    isProcessing = true;
    const button = event.target;
    const originalText = button.innerText;
    const message = encodeURIComponent(button.getAttribute("data-message"));
    
    button.innerText = "Wait...";
    button.style.opacity = 0.7;
    button.style.pointerEvents = "none";

    
    document.querySelectorAll(".wa-button").forEach(btn => {
      if (btn !== button) {
        btn.disabled = true;
        btn.style.opacity = 0.5;
        btn.style.pointerEvents = "none";
      }
    });

    window.location.href = `https://wa.me/6281929461281?text=${message}`;

    setTimeout(() => {
      button.innerText = originalText;
      button.style.opacity = 1;
      button.style.pointerEvents = "auto";
      isProcessing = false;

      document.querySelectorAll(".wa-button").forEach(btn => {
        btn.disabled = false;
        btn.style.opacity = 1;
        btn.style.pointerEvents = "auto";
      });
    }, 4000); 
  }
  
  function toggleFAQ(element) {
      const answer = element.nextElementSibling;
      const arrow = element.querySelector('.arrow');
      const isVisible = answer.style.display === 'block';

      answer.style.display = isVisible ? 'none' : 'block';
      arrow.classList.toggle('rotate', !isVisible);
    }
