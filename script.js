document.getElementById("regForm").onsubmit = function (e) {
  let name = document.getElementById("name").value;
  let phone = document.getElementById("phone").value;

  if (name.length < 3) {
    alert("Please enter a valid full name.");
    e.preventDefault();
  }

  if (isNaN(phone)) {
    alert("Phone number must contain only digits.");
    e.preventDefault();
  }
};
document.querySelector(".modern-btn").addEventListener("click", function () {
  this.style.transform = "scale(0.95)";
  setTimeout(() => {
    this.style.transform = "scale(1)";
  }, 100);
} );
document.getElementById("regForm").addEventListener("submit", function () {
  // Show the loader
  document.getElementById("loader-overlay").style.display = "flex";

  // The button text changes to show it's working
  const btn = document.querySelector("button");
  btn.innerHTML = "Processing...";
  btn.style.opacity = "0.7";
} );
// File Upload Preview Logic
document.querySelectorAll('.upload-box input[type="file"]').forEach(input => {
    input.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            let labelSpan = this.parentElement.querySelector('span');
            let iconDiv = this.parentElement.querySelector('.icon');
            
            // Get file name and shorten it if it's too long
            let fileName = this.files[0].name;
            if(fileName.length > 20) fileName = fileName.substring(0, 18) + "...";
            
            // Update the UI to show success
            labelSpan.innerText = fileName;
            labelSpan.style.color = "#28a745";
            iconDiv.innerText = "✅"; // Change icon to checkmark
        }
    });
});