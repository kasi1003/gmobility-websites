document.addEventListener("DOMContentLoaded", function () {
  // Get references to the button and modal elements
  const addRecordButton = document.getElementById("addBurialRecord");
  const modal = document.getElementById("myModal");

  // Add a click event listener to the "Add Records" button
  addRecordButton.addEventListener("click", function () {
    // Show the modal
    modal.style.display = "block";
  });

  // Close the modal when the close button is clicked
  const closeButton = modal.querySelector(".close");
  closeButton.addEventListener("click", function () {
    modal.style.display = "none";
  });

  // Close the modal when the "Close" button in the modal footer is clicked
  const modalCloseButton = modal.querySelector(".btn-secondary");
  modalCloseButton.addEventListener("click", function () {
    modal.style.display = "none";
  });

  // Close the modal when the user clicks outside of it
  window.addEventListener("click", function (event) {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });


  // JavaScript code to handle dynamic population of the second select
  const firstSelect = document.getElementById('inputGroupSelect01');
  const secondSelect = document.getElementById('inputGroupSelect02');

  firstSelect.addEventListener('change', function() {
      const selectedCemetery = this.value;

      // Send an AJAX request to the server to fetch SectionCode values
      // and update the options in the second select
      // You can use JavaScript libraries like jQuery or fetch API for this purpose
      // Example:
      fetch('../php/burialRecords.php', {
          method: 'POST',
          body: JSON.stringify({ cemetery: selectedCemetery }),
          headers: {
              'Content-Type': 'application/json'
          }
      })
      .then(response => response.json())
      .then(data => {
          // Clear existing options
          secondSelect.innerHTML = '<option selected>Select Section</option>';

          // Populate options with received SectionCode values
          data.sections.forEach(section => {
              const option = document.createElement('option');
              option.value = section;
              option.textContent = section;
              secondSelect.appendChild(option);
          });
      })
      .catch(error => {
          console.error('Error:', error);
      });
  });

});
