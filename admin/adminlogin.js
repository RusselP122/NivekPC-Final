const togglePassword = document.querySelector('.toggle-password');
const passwordInput = document.querySelector('.pass');

togglePassword.addEventListener('click', function() {
  const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
  passwordInput.setAttribute('type', type);
  this.classList.toggle('fa-eye');
  this.classList.toggle('fa-eye-slash');
});

document.getElementById("loginForm").addEventListener("submit", function(event) {
  var username = document.getElementById("usernameInput").value;
  var password = document.getElementById("passwordInput").value;
  
  // Replace this with your actual validation logic
  if (username !== "admin" || password !== "admin123") {
      document.getElementById("errorMessage").style.display = "block";
      event.preventDefault(); // Prevent form submission
  }
});