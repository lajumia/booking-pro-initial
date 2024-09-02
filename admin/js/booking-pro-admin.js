$(document).ready(function () {
  $("#customers-table").DataTable({
    paging: true, // Enable pagination
    searching: true, // Enable searching
    ordering: true, // Enable sorting
    info: true, // Show table info (e.g., "Showing 1 to 10 of 57 entries")
    lengthChange: true, // Allow the user to change the number of rows displayed
    pageLength: 10, // Set default page length
  });
});
