document.addEventListener("DOMContentLoaded", function () {
    // Function to redirect to login page
    function showLogin() {
        alert("Redirecting to the login page...");
        window.location.href = "login.php";
    }

    // Function to redirect to registration page
    function showRegister() {
        alert("Redirecting to the registration page...");
        window.location.href = "register.php";
    }

    // Attach event listeners to buttons
    document.querySelector(".btn-login").addEventListener("click", showLogin);
    document.querySelector(".btn-register").addEventListener("click", showRegister);
});
// index page


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
