const nextBtns = document.querySelectorAll(".nextBtn");
const prevBtns = document.querySelectorAll(".prevBtn");
const formProgress = document.getElementById("formProgress");
const steps = document.querySelectorAll(".card");
const dots = document.querySelectorAll("[data-carousel-dot]");
const forms = document.querySelectorAll(".form");
let currentStep = 0;

function updateFormProgress() {
  const progressPercent = ((currentStep + 1) / steps.length) * 100;
  formProgress.style.width = progressPercent + "%";
}

function updateActiveStep() {
  // Update the visibility of steps
  steps.forEach((step, index) => {
    step.classList.toggle("active", index === currentStep);
  });

  // Update the active state of dots
  dots.forEach((dot, index) => {
    if (index === currentStep) {
      dot.setAttribute("data-active", "");
    } else {
      dot.removeAttribute("data-active");
    }
  });

  // Update the visibility of forms
  forms.forEach((form, index) => {
    form.setAttribute("data-active", index === currentStep ? "" : null);
  });
}

// Check if all inputs in the current form are filled
function isFormValid() {
  const currentForm = forms[currentStep];
  const inputs = currentForm.querySelectorAll(
    "input[required], select[required]"
  );

  for (const input of inputs) {
    if (!input.value.trim()) {
      return false;
    }
  }
  return true;
}

nextBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    if (isFormValid()) {
      if (currentStep < steps.length - 1) {
        currentStep++;
        updateFormProgress();
        updateActiveStep();
      }
    } else {
      alert("Please fill in all required fields.");
    }
  });
});

prevBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    if (currentStep > 0) {
      currentStep--;
      updateFormProgress();
      updateActiveStep();
    }
  });
});

// Handle clicks on dots to navigate to specific steps/forms
dots.forEach((dot, index) => {
  dot.addEventListener("click", () => {
    currentStep = index;
    updateFormProgress();
    updateActiveStep();
  });
});

// Initialize on page load
updateFormProgress();
updateActiveStep();
