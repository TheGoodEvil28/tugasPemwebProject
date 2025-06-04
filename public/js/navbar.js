document.getElementById("profileIcon").addEventListener("click", function (event) {
    event.preventDefault();
    var dropdown = document.getElementById("profileDropdown");
    dropdown.classList.toggle("d-none");
});

// Close the dropdown when clicking outside of it
document.addEventListener("click", function (event) {
    var dropdown = document.getElementById("profileDropdown");
    var profileIcon = document.getElementById("profileIcon");
    if (!profileIcon.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.add("d-none");
    }
});