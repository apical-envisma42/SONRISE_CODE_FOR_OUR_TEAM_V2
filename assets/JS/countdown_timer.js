document.addEventListener("DOMContentLoaded", function () {
    const countdownElement = document.getElementById("countdown");
    
    if (!countdownElement) return;

    let dynamicSeconds = parseInt(countdownElement.textContent, 10);

    if (isNaN(dynamicSeconds) || dynamicSeconds <= 0) {
        dynamicSeconds = 15; // Safe fallback
    }

    const countdownInterval = setInterval(function () {
        dynamicSeconds--;
        
        countdownElement.textContent = dynamicSeconds;

        if (dynamicSeconds <= 0) {
            clearInterval(countdownInterval);
            
            window.location.href = "../../index.php";
        }
    }, 1000);
});