document.addEventListener("DOMContentLoaded", function () {
    const images = document.querySelectorAll("img");
    const form = document.getElementById("channelForm");
    const nameInput = document.getElementById("namaChannel");        
    const imageInput =  document.getElementById("gambarnya");
    const idInput =  document.getElementById("idChannel");        

    images.forEach(function (img) {
      img.addEventListener("click", function () {
        const channelName = this.nextElementSibling?.textContent.trim();
        nameInput.value = channelName;
        idInput.value = this.id;
        imageInput.value = this.src;    
        form.submit(); // Submits with POST
      });
    });
  });