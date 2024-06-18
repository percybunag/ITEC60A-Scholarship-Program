document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 0;
    const steps = document.querySelectorAll('.step');
    const nextButtons = document.querySelectorAll('.next');
    const prevButtons = document.querySelectorAll('.previous-btn');
    const submitButton = document.querySelector('.submit');
    const forms = document.querySelectorAll('form');
    const rectangleP = document.querySelector('.rectangle p');
    const fileInputs = document.querySelectorAll('input[type="file"]');

    function showStep(step) {
        steps.forEach((stepElement, index) => {
            stepElement.classList.remove('active');
            if (index === step) {
                stepElement.classList.add('active');
            }
        });
        updateStepIndicator(step);
        updateRectangleText(step);
    }

    function updateStepIndicator(step) {
        const stepIndicators = document.querySelectorAll('.active-button li');
        stepIndicators.forEach((indicator, index) => {
            indicator.classList.remove('active');
            if (index <= step) {
                indicator.classList.add('active');
            }
        });
    }

    function updateRectangleText(step) {
        const stepTitle = steps[step].querySelector('h4').textContent;
        const formattedTitle = stepTitle.toLowerCase().replace(/\b\w/g, char => char.toUpperCase());
        rectangleP.textContent = `Dashboard / Apply Scholarship / ${formattedTitle} `;
    }

    function displayUploadedFiles() {
        const requirementSection = document.querySelector('.requirement-section');
        requirementSection.innerHTML = ''; // Clear previous content
        fileInputs.forEach(fileInput => {
            if (fileInput.files.length > 0) {
                const fileList = document.createElement('ul');
                for (let i = 0; i < fileInput.files.length; i++) {
                    const listItem = document.createElement('li');
                    listItem.textContent = fileInput.files[i].name;
                    fileList.appendChild(listItem);
                }
                requirementSection.appendChild(fileList);
            }
        });
    }

    nextButtons.forEach(button => {
        button.addEventListener('click', () => {
            const form = forms[currentStep];
            if (form.reportValidity()) {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                    displayUploadedFiles();
                }
            }
        });
    });

    prevButtons.forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
                displayUploadedFiles();
            }
        });
    });

    submitButton.addEventListener('click', (e) => {
        e.preventDefault();
        const form = forms[currentStep];
        if (form.reportValidity()) {
            form.submit(); // Submit the form if all data is valid
        }
    });

    showStep(currentStep);
    updateRectangleText(currentStep); // Initial call to set the text on page load
});

const toggler = document.querySelector(".btn");
toggler.addEventListener("click", function(){
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

document.getElementById('monthyears').addEventListener('change', function() {
    var selectedDate = new Date(this.value);
    var formattedDate = selectedDate.getFullYear() + '-' + ('0' + (selectedDate.getMonth() + 1)).slice(-2);
    console.log('Selected Month and Year:', formattedDate);
    // Use formattedDate as needed (e.g., assign to hidden input for submission)
});

let profileDropdownList = document.querySelector(".profile-dropdown-list");
let btn = document.querySelector(".profile-dropdown-btn");
let classList = profileDropdownList.classList;
const toggle = () => classList.toggle("active");

window.addEventListener("click", function (e) {
    if (!btn.contains(e.target)) classList.remove("active");
});
