// Toggle dark mode
function toggleDarkMode() {
    const body = document.body;
    const themeToggleBtn = document.getElementById('theme-toggle');

    // Toggle dark mode on the body
    body.classList.toggle('dark-mode');

    // Toggle dark mode for all elements that need it
    document.querySelectorAll('h1, label, input, button, .accordion-item, .accordion-title, .accordion-content').forEach(el => {
        el.classList.toggle('dark-mode');
    });

    // Check if dark mode is enabled
    const darkModeEnabled = body.classList.contains('dark-mode');

    // Update localStorage and cookies
    localStorage.setItem('darkMode', darkModeEnabled);
    setCookie('theme', darkModeEnabled ? 'dark' : 'light', 30); // Save theme preference for 30 days

    // Update the toggle button icon
    if (themeToggleBtn) {
        themeToggleBtn.innerHTML = darkModeEnabled ? '☀️' : '🌙'; // Sun for light mode, moon for dark mode
    }
}

// Apply theme on page load
document.addEventListener('DOMContentLoaded', () => {
    const darkModeEnabled = localStorage.getItem('darkMode') === 'true' || getCookie('theme') === 'dark';
    const themeToggleBtn = document.getElementById('theme-toggle');

    // Set the correct initial state for dark mode
    if (darkModeEnabled) {
        document.body.classList.add('dark-mode');
        document.querySelectorAll('h1,label, input, button, .accordion-item, .accordion-title, .accordion-content, p').forEach(el => {
            el.classList.add('dark-mode');
        });
        themeToggleBtn.innerHTML = '☀️'; // Sun icon
    } else {
        document.body.classList.remove('dark-mode');
        document.querySelectorAll('h1, label, input, button ,.accordion-item, .accordion-title, .accordion-content, p').forEach(el => {
            el.classList.remove('dark-mode');
        });
        themeToggleBtn.innerHTML = '🌙'; // Moon icon
    }

    // Add click event listener to the theme toggle button
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', toggleDarkMode);
    }
});

// Helper function to set a cookie
function setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    const expires = "; expires=" + date.toUTCString();
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// Helper function to get a cookie by name
function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}
