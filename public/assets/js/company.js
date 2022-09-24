'use strict';

// COMPANY NAME SEARCH FILTER
function searchCompany() {
  let input, filter, table, tr, td, i, txtValue;
  input = document.getElementById('searchCompany');
  filter = input.value.toUpperCase();
  table = document.getElementById('companyTable');
  tr = table.getElementsByTagName('tr');

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName('td')[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = '';
      } else {
        tr[i].style.display = 'none';
      }
    }
  }
}

// COMPANY CITY SEARCH FILTER
function searchCompanyCity() {
  let input, filter, table, tr, td, i, txtValue;
  input = document.getElementById('companyCity');
  filter = input.value.toUpperCase();
  table = document.getElementById('companyTable');
  tr = table.getElementsByTagName('tr');

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName('td')[4];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = '';
      } else {
        tr[i].style.display = 'none';
      }
    }
  }
}

// COMPANY STATE SEARCH FILTER
function searchCompanyState() {
  let input, filter, table, tr, td, i, txtValue;
  input = document.getElementById('companyState');
  filter = input.value.toUpperCase();
  table = document.getElementById('companyTable');
  tr = table.getElementsByTagName('tr');

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName('td')[5];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = '';
      } else {
        tr[i].style.display = 'none';
      }
    }
  }
}

// COMPANY COUNTRY SEARCH FILTER
function searchCompanyCountry() {
  let input, filter, table, tr, td, i, txtValue;
  input = document.getElementById('companyCountry');
  filter = input.value.toUpperCase();
  table = document.getElementById('companyTable');
  tr = table.getElementsByTagName('tr');

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName('td')[6];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = '';
      } else {
        tr[i].style.display = 'none';
      }
    }
  }
}

// COMPANY INDUSTRY SEARCH FILTER
function searchCompanyIndustry() {
  let input, filter, table, tr, td, i, txtValue;
  input = document.getElementById('companyIndustry');
  filter = input.value.toUpperCase();
  table = document.getElementById('companyTable');
  tr = table.getElementsByTagName('tr');

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName('td')[3];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = '';
      } else {
        tr[i].style.display = 'none';
      }
    }
  }
}

