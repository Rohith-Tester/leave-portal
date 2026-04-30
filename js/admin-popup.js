function closePopup(){

    document.getElementById("popup").style.display = "none";

    // 🔥 remove ?approve / ?reject from URL
    window.history.replaceState(null, null, window.location.pathname);
}