// Validation for text input
function validateInput(value) {
    var pageLimitInput = document.getElementById('pageLimitInput');
    if (!value || isNaN(value) || value < 0 || value.indexOf('.') >= 0) {
        pageLimitInput.focus();
        pageLimitInput.style.background = '#ff9999';
    } else {
        pageLimitInput.style.background = 'white';
    }
}

// Execute on page load
window.onload = function () {
    var input = document.getElementById('pageLimitInput');
    var existingInput = input.value;
    validateInput(existingInput);
};


