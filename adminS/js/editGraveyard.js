document.addEventListener("DOMContentLoaded", function () {
  // Fetch JSON data from the PHP script using jQuery's $.getJSON
  $.getJSON("../php/editGraveyard.php", function (data) {
    // Iterate through the JSON data and populate the table
    var tableBody = $("#cemeteriesTableBody");

    $.each(data, function (index, cemetery) {
      var row = $("<tr>").attr("id", "clickable-row").css("cursor", "pointer");
      row.append($("<td>").text(cemetery.CemeteryName));
      row.append($("<td>").text(cemetery.Region));
      row.append($("<td>").text(cemetery.Town));
      row.append($("<td>").text(cemetery.NumberOfSections));
      row.append($("<td>").text(cemetery.TotalGraves));
      row.append($("<td>").text(cemetery.AvailableGraves));

      tableBody.append(row);
    });
  });

  // Add event listener for table row click
  $("#cemeteriesTableBody").on("click", "tr", function () {
    // Open the modal when a row is clicked
    $("#exampleModal").modal("show");
  });

  function generateGraveInputs() {
    const sectionNumberInput = document.getElementById("sectionNumber");
    const gravePerSecContainer = document.getElementById(
      "gravePerSecContainer"
    );

    // Clear any previously generated inputs
    gravePerSecContainer.innerHTML = "";

    // Get the number of sections entered by the user
    const numSections = parseInt(sectionNumberInput.value);

    // Generate input fields based on the user's input
    for (let i = 0; i < numSections; i++) {
      const inputDiv = document.createElement("div");
      inputDiv.className = "mb-3";
      inputDiv.innerHTML = `
          <label for="GravesInSection${
            i + 1
          }" class="form-label">Graves in Section ${i + 1}</label>
          <input type="number" class="form-control" id="GravesInSection${
            i + 1
          }" name="numberOfGraves" placeholder="Enter Number of Graves for Section ${
        i + 1
      }" />
        `;
      gravePerSecContainer.appendChild(inputDiv);
    }
  }

  // Attach the generateGraveInputs function to the input event of sectionNumber
  const sectionNumberInput = document.getElementById("sectionNumber");
  sectionNumberInput.addEventListener("input", generateGraveInputs);

  // Add an event listener for form submission
  document.querySelector("form").addEventListener("submit", function (event) {
    // Prevent the default form submission behavior
    event.preventDefault();

    // Get the number of sections entered by the user
    const numSections = parseInt(
      document.getElementById("sectionNumber").value
    );

    // Initialize a variable to store the total
    let totalGraves = 0;

    // Iterate through the input fields for each section
    for (let i = 1; i <= numSections; i++) {
      // Get the user's input for graves in this section
      const gravesInput = document.getElementById(`GravesInSection${i}`);
      const gravesInSection = parseInt(gravesInput.value);

      // Check if the input is a valid number
      if (!isNaN(gravesInSection)) {
        // Add the number of graves in this section to the total
        totalGraves += gravesInSection;
      }
    }

    // Set the calculated total as the value for the numberOfGraves input field
    const numberOfGravesInput = document.getElementById("numberOfGraves");
    if (numberOfGravesInput) {
      numberOfGravesInput.value = totalGraves;
    }

    // Now, you can submit the form
    this.submit();
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Function to populate the select element with region options
  function populateRegionSelect(regionData) {
    const regionSelect = document.getElementById("regionSelect");
    regionSelect.innerHTML = "<option selected>Select Region</option>"; // Clear existing options

    regionData.forEach((regionName) => {
      const option = document.createElement("option");
      option.value = regionName;
      option.textContent = regionName;
      regionSelect.appendChild(option);
    });
  }

  // Fetch region data from PHP using AJAX
  fetch("../php/addGraveyardFetch.php")
    .then((response) => response.json())
    .then((regionData) => {
      // Call the function to populate the select element
      populateRegionSelect(regionData);
    })
    .catch((error) => {
      console.error("Error fetching region names:", error);
    });

  // Additional JavaScript code for dynamic input generation
});

// Function to fetch towns based on the selected region and populate the townSelect dropdown
function populateTownSelect(selectedRegion) {
  fetch("../php/fetchTowns.php?region=" + selectedRegion)
    .then((response) => response.json())
    .then((data) => {
      const townSelect = document.getElementById("townSelect");
      // Clear existing options
      townSelect.innerHTML = "";
      // Add a default option
      const defaultOption = document.createElement("option");
      defaultOption.value = "";
      defaultOption.textContent = "Select Town";
      townSelect.appendChild(defaultOption);
      // Add towns based on the selected region
      data.forEach((townName) => {
        const option = document.createElement("option");
        option.value = townName;
        option.textContent = townName;
        townSelect.appendChild(option);
      });
    })
    .catch((error) => {
      console.error("Error fetching towns:", error);
    });
}

// Add an event listener to the regionSelect dropdown to trigger population of townSelect
const regionSelect = document.getElementById("regionSelect");
regionSelect.addEventListener("change", function () {
  const selectedRegion = regionSelect.value;
  populateTownSelect(selectedRegion);





// Function to populate the modal fields when a row is clicked
function populateModalFields(row) {
  const cemeteryID = row.data('cemetery-id');
  const cemeteryName = row.data('cemetery-name');
  const region = row.data('region');
  const town = row.data('town');
  const numSections = row.data('num-sections');
  const totalGraves = row.data('total-graves');
  const sectionCode = row.data('section-code');
  const totalGravesPerSection = row.data('total-graves-per-section');

  // Populate the modal fields with existing data
  $('#editCemeteryID').val(cemeteryID);
  $('#graveyardName').val(cemeteryName);
  $('#regionSelect').val(region);
  $('#townSelect').val(town);
  $('#sectionNumber').val(numSections);

  // Generate inputs for SectionCode and TotalGraves per section based on the data
  generateGraveInputs(sectionCode, totalGravesPerSection);
}

// Function to generate inputs for SectionCode and TotalGraves per section
function generateGraveInputs(sectionCode, totalGravesPerSection) {
  // Clear the existing inputs
  $('#gravePerSecContainer').empty();

  // Generate inputs for each section based on numSections
  for (let i = 0; i < numSections; i++) {
      const sectionContainer = $('<div class="mb-3">');
      const sectionCodeLabel = $('<label class="form-label">Section Code</label>');
      const sectionCodeInput = $('<input type="text" class="form-control" name="sectionCode" value="' + sectionCode[i] + '">');
      const totalGravesLabel = $('<label class="form-label">Total Graves</label>');
      const totalGravesInput = $('<input type="number" class="form-control" name="totalGraves" value="' + totalGravesPerSection[i] + '">');

      sectionContainer.append(sectionCodeLabel, sectionCodeInput, totalGravesLabel, totalGravesInput);
      $('#gravePerSecContainer').append(sectionContainer);
  }
}

// Function to save the edited row
function saveEditedRow() {
  // Retrieve edited data from modal fields
  const cemeteryID = $('#editCemeteryID').val();
  const editedCemeteryName = $('#graveyardName').val();
  const editedRegion = $('#regionSelect').val();
  const editedTown = $('#townSelect').val();
  const editedNumSections = $('#sectionNumber').val();

  // Retrieve SectionCode and TotalGraves per section inputs
  const editedSectionCodes = $('[name="sectionCode"]').map(function () { return this.value; }).get();
  const editedTotalGravesPerSection = $('[name="totalGraves"]').map(function () { return this.value; }).get();

  // Send the edited data to the server for updating (you will need AJAX for this)
  // Handle the server response and update the table if successful
  // Close the modal after saving changes
  $('#exampleModal').modal('hide');
}

// Add an event listener for table row click
$('#cemeteriesTableBody').on('click', 'tr[data-toggle="modal"]', function () {
  // Populate modal fields when a row is clicked
  populateModalFields($(this));
  // Open the modal
  $('#exampleModal').modal('show');
});



});
