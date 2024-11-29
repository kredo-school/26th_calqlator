document.addEventListener("DOMContentLoaded", function() {
    const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
    const submitButton = document.querySelector('button[type="submit"]'); 
    
    inputs.forEach(input => {
        input.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();

                const nextInput = getNextInput(event.target);
                
                if (nextInput) {
                    nextInput.focus();  
                } else {
                    submitButton.click();
                }
            }
        });
    });

    function getNextInput(currentInput) {
        const inputsWithTabindex = Array.from(document.querySelectorAll('input[tabindex]'));

        inputsWithTabindex.sort((a, b) => a.tabIndex - b.tabIndex);

        const currentIndex = inputsWithTabindex.indexOf(currentInput);
        return inputsWithTabindex[currentIndex + 1] || null;
    }
});