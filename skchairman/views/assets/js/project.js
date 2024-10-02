document.addEventListener("DOMContentLoaded", function () {
   
    function addExpense(expenseType, expenseAmount) {
      const currentBudgetElement = document.getElementById("current-budget");
      let currentBudget = parseFloat(
        currentBudgetElement.textContent.replace(/,/g, "")
      );
  
      if (currentBudget - expenseAmount < 0) {
        displayErrorMessage(
          "Error: Budget exceeded! Please reduce the expense amount."
        );
        return;
      }
  
     
      const expenseList = document.getElementById("expense-list");
      const newExpenseItem = document.createElement("li");
      newExpenseItem.className =
        "list-group-item expense-item d-flex justify-content-between align-items-center";
      newExpenseItem.innerHTML = `${expenseType}: ₱${expenseAmount.toFixed(2)}
              <span class="remove-expense" data-amount="${expenseAmount}">&minus;</span>`;
      expenseList.appendChild(newExpenseItem);
  
    
      updateBudget(currentBudget - expenseAmount);
  
      clearExpenseInputs();
    }
  

    function updateBudget(newBudget) {
      const currentBudgetElement = document.getElementById("current-budget");
      currentBudgetElement.textContent = newBudget.toFixed(2);
      hideErrorMessage();
    }
 
    function clearExpenseInputs() {
      document.getElementById("expense-type").value = "";
      document.getElementById("expense-amount").value = "";
    }
  
    // Display error message
    function displayErrorMessage(message) {
      const errorMessageDiv = document.getElementById("error-message");
      errorMessageDiv.textContent = message;
      errorMessageDiv.style.display = "block";
    }
  
    // Hide error message
    function hideErrorMessage() {
      document.getElementById("error-message").style.display = "none";
    }
  
    // Add plan function
    function addPlan(planValue) {
      const tagsContainer = document.getElementById("tags-container");
      const newTag = document.createElement("span");
      newTag.className = "badge bg-primary badge-plan";
      newTag.textContent = planValue;
  
      tagsContainer.appendChild(newTag);
    }
  
    // Event listener for adding expenses
    document
      .getElementById("add-expense-btn")
      .addEventListener("click", function () {
        const expenseType = document
          .getElementById("expense-type")
          .value.trim();
        const expenseAmount = parseFloat(
          document.getElementById("expense-amount").value.trim()
        );
  
        if (expenseType && !isNaN(expenseAmount) && expenseAmount > 0) {
          addExpense(expenseType, expenseAmount);
        } else {
          alert("Please enter valid expense details.");
        }
      });
  
    // Event listener for removing expenses
    document
      .getElementById("expense-list")
      .addEventListener("click", function (event) {
        if (event.target.classList.contains("remove-expense")) {
          const expenseAmount = parseFloat(
            event.target.getAttribute("data-amount")
          );
          const currentBudgetElement = document.getElementById("current-budget");
          let currentBudget = parseFloat(
            currentBudgetElement.textContent.replace(/,/g, "")
          );
  
          updateBudget(currentBudget + expenseAmount);
          event.target.closest("li").remove();
        }
      });
  
    // Event listener for adding plans
    document
      .getElementById("add-plan-btn")
      .addEventListener("click", function () {
        const planInput = document.getElementById("project-plan-input");
        const planValue = planInput.value.trim();
  
        if (planValue) {
          addPlan(planValue);
          planInput.value = "";
        }
      });
  
    // Event delegation for removing plans
    document
      .getElementById("tags-container")
      .addEventListener("click", function (event) {
        if (event.target.classList.contains("badge-plan")) {
          event.target.remove();
        }
      });
  });
  