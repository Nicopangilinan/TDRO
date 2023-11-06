const sidebar = document.querySelector(".sidebar");
const sidebarClose = document.querySelector("#sidebar-close");
const menu = document.querySelector(".menu-content");
const menuItems = document.querySelectorAll(".submenu-item");
const subMenuTitles = document.querySelectorAll(".submenu .menu-title");

sidebarClose.addEventListener("click", () => sidebar.classList.toggle("close"));

menuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    menu.classList.add("submenu-active");
    item.classList.add("show-submenu");
    menuItems.forEach((item2, index2) => {
      if (index !== index2) {
        item2.classList.remove("show-submenu");
      }
    });
  });
});


subMenuTitles.forEach((title) => {
  title.addEventListener("click", () => {
    menu.classList.remove("submenu-active");
  });
});
                              
function confirmLogout() {
  
    const confirmation = confirm("Are you sure you want to log out?");
    if (confirmation) {
      window.location.href = "logout.php";
    }
  }
//Search Functionality With contact
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('searchInput1');
  const searchResults = document.getElementById('searchResults');

  searchInput.addEventListener('input', function () {
      const searchTerm = searchInput.value.trim();

      if (searchTerm !== '') {
          // Send an AJAX request to search.php
          searchResults.innerHTML = '<p>Loading...</p>';
          fetch(`search.php?term=${searchTerm}`)
              .then(response => response.text())
              .then(data => {
                  searchResults.innerHTML = data;
              })
              .catch(error => {
                  console.error('Error:', error);
              });
      } else {
          // When the input is empty, show the whole table
          searchResults.innerHTML = ''; // Clear results
          fetch('search.php') // Send an AJAX request without a search term
              .then(response => response.text())
              .then(data => {
                  searchResults.innerHTML = data; // Display the whole table
              })
              .catch(error => {
                  console.error('Error:', error);
              });
      }
  });
});
// Search With No Contact
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('searchInput2');
  const searchResults = document.getElementById('searchResults2');

  searchInput.addEventListener('input', function () {
      const searchTerm = searchInput.value.trim();

      if (searchTerm !== '') {
          // Send an AJAX request to search.php
          searchResults.innerHTML = '<p>Loading...</p>';
          fetch(`search2.php?term=${searchTerm}`)
              .then(response => response.text())
              .then(data => {
                  searchResults.innerHTML = data;
              })
              .catch(error => {
                  console.error('Error:', error);
              });
      } else {
          // When the input is empty, show the whole table
          searchResults.innerHTML = ''; // Clear results
          fetch('search2.php') // Send an AJAX request without a search term
              .then(response => response.text())
              .then(data => {
                  searchResults.innerHTML = data; // Display the whole table
              })
              .catch(error => {
                  console.error('Error:', error);
              });
      }
  });
});
// Search With & No Contact
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('searchInput3');
  const searchResults = document.getElementById('searchResults3');

  searchInput.addEventListener('input', function () {
      const searchTerm = searchInput.value.trim();

      if (searchTerm !== '') {
          // Send an AJAX request to search.php
          searchResults.innerHTML = '<p>Loading...</p>';
          fetch(`search3.php?term=${searchTerm}`)
              .then(response => response.text())
              .then(data => {
                  searchResults.innerHTML = data;
              })
              .catch(error => {
                  console.error('Error:', error);
              });
      } else {
          // When the input is empty, show the whole table
          searchResults.innerHTML = ''; // Clear results
          fetch('search3.php') // Send an AJAX request without a search term
              .then(response => response.text())
              .then(data => {
                  searchResults.innerHTML = data; // Display the whole table
              })
              .catch(error => {
                  console.error('Error:', error);
              });
      }
  });
});

// Search With & No Contact
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('searchInput4');
  const searchResults = document.getElementById('searchResults4');

  searchInput.addEventListener('input', function () {
      const searchTerm = searchInput.value.trim();

      if (searchTerm !== '') {
          // Send an AJAX request to search.php
          searchResults.innerHTML = '<p>Loading...</p>';
          fetch(`search4.php?term=${searchTerm}`)
              .then(response => response.text())
              .then(data => {
                  searchResults.innerHTML = data;
              })
              .catch(error => {
                  console.error('Error:', error);
              });
      } else {
          // When the input is empty, show the whole table
          searchResults.innerHTML = ''; // Clear results
          fetch('search4.php') // Send an AJAX request without a search term
              .then(response => response.text())
              .then(data => {
                  searchResults.innerHTML = data; // Display the whole table
              })
              .catch(error => {
                  console.error('Error:', error);
              });
      }
  });
});
$("#paymentFilterForm").submit(function (e) {
  e.preventDefault();
  var formData = $(this).serialize();
  
  $.ajax({
      type: "POST",
      url: "filter_data2.php", // Change to the correct URL
      data: formData,
      success: function (response) {
          $("#paymentsTableBody").html(response);
      }
  });
});


//Success List button
document.getElementById('successList').addEventListener('click', function () {
  // Send an AJAX request to filter_success.php
  searchResults4.innerHTML = '<p>Loading...</p>';
  fetch('filter_success.php')
      .then(response => response.text())
      .then(data => {
          searchResults4.innerHTML = data;
      })
      .catch(error => {
          console.error('Error:', error);
      });
});

//ShowAll Button
document.getElementById('showAll').addEventListener('click', function () {
  // Send an AJAX request to show_all.php
  searchResults4.innerHTML = '<p>Loading...</p>';
  fetch('filter_all.php')
      .then(response => response.text())
      .then(data => {
          searchResults4.innerHTML = data;
      })
      .catch(error => {
          console.error('Error:', error);
      });
});



 //for popup box
  function toggleBoxContent(button) {
    const hiddenContent = button.nextElementSibling;
    if (hiddenContent.style.display === 'block') {
      hiddenContent.style.display = 'none';
    } else {
      hiddenContent.style.display = 'block';
    }
  }



// Modal for Violation Details
const openViolationModalButtons = document.querySelectorAll('[data-modal-violation-target]');
const closeViolationModalButtons = document.querySelectorAll('[data-close-violation-button]');

openViolationModalButtons.forEach(button => {
  button.addEventListener('click', () => {
    const modal = document.querySelector(button.dataset.modalViolationTarget);
    openViolationModal(modal);
  });
});

closeViolationModalButtons.forEach(button => {
  button.addEventListener('click', () => {
    const modal = button.closest('.modal-violation');
    closeViolationModal(modal);
  });
});

function openViolationModal(modal) {
  if (modal == null) return;
  modal.classList.add('active');
  overlay.classList.add('active');
}

function closeViolationModal(modal) {
  if (modal == null) return;
  modal.classList.remove('active');
  overlay.classList.remove('active');
}

// Function to open the modal for Violation Details and populate it with data
function openViolationDetailsModal(name, ticketNo) {
  var modal = document.getElementById('violatorModal');
  var modalName = document.getElementById('modalName');
  var modalTicketNo = document.getElementById('modalTicketNo');

  modalName.textContent = name;
  modalTicketNo.textContent = ticketNo;

  modal.style.display = 'block';
}

// Function to close the modal for Violation Details
function closeViolationDetailsModal() {
  var modal = document.getElementById('violatorModal');
  modal.style.display = 'none';
}

// Violator Modal 
$(document).ready(function () {
  var modal = $("#myModal");
  var closeModal = $("#closeModal");

  // Use event delegation to handle click events for dynamic rows
  $('#violatorTableBody').on('click', 'tr', function () {
    var rowId = $(this).data('row-id');
    var license = $(this).data('license-number');

    console.log('LICENSE: ' + license);
    console.log('Clicked row ID: ' + rowId);

    // Make an AJAX request to fetch the entire row data
    $.ajax({
      type: "GET",
      url: "test.php?id=" + rowId,
      success: function (data) {
        $("#modalContent2").html(data);
        modal.css("display", "block");
      }
    });

    $.ajax({
      type: "GET",
      url: "test2.php?license=" + license,
      success: function (data) {
        $("#modalContent3").html(data);
        modal.css("display", "block");
      }
    });
  });

  closeModal.click(function () {
    modal.css("display", "none");
  });

  // Close the modal when the user clicks outside of it
  $(window).click(function (e) {
    if (e.target === modal[0]) {
      modal.css("display", "none");
    }
  });
});



//============MODAL TAB============
    function openModalTab(evt, tabName) {
        var i, modalTabcontent, modalTablinks;
        modalTabcontent = document.getElementsByClassName("modal-tabcontent");
        for (i = 0; i < modalTabcontent.length; i++) {
            modalTabcontent[i].style.display = "none";
        }
        modalTablinks = document.getElementsByClassName("modal-tablinks");
        for (i = 0; i < modalTablinks.length; i++) {
            modalTablinks[i].className = modalTablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    document.addEventListener('DOMContentLoaded', function() {
      const filterButtons = document.querySelectorAll('.filter-buttons button[data-filter]');
      const filterInput = document.querySelector('input[name="filter"]');
    
      // Check if there's a saved filter state in local storage
      const savedFilter = localStorage.getItem('activeFilter');
    
      // Set the active state based on the saved filter, if any
      if (savedFilter) {
        filterButtons.forEach(button => {
          if (button.getAttribute('data-filter') === savedFilter) {
            button.classList.add('active');
          }
        });
    
        // Apply the saved filter value to the filter input field
        filterInput.value = savedFilter;
      }
    
      // Add click event listeners to the filter buttons
      filterButtons.forEach(button => {
        button.addEventListener('click', function() {
          const filterValue = this.getAttribute('data-filter');
    
          // Remove active state from all buttons
          filterButtons.forEach(btn => btn.classList.remove('active'));
    
          // Add active state to the clicked button
          this.classList.add('active');
    
          // Set the active filter in local storage
          localStorage.setItem('activeFilter', filterValue);
    
          // Apply the filter value to the filter input field
          filterInput.value = filterValue;
    
          // Submit the form
          this.closest('form').submit();
        });
      });
    });

    
    