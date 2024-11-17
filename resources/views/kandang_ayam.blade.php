@include ('modals.tambahkandang')
@include ('modals.editkandang')


<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Eggspert</title>
  </head>
  
<body>
  <header class="sidebar">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-light shadow" style="width: 240px; height: 100vh;">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <img src="../assets/sidebar/logo_eggspert.svg " style="height: 10vh; width: 10vh;">
        <span class="fs-4" style="color: #E59D2A; padding-left: 10px;">Eggspert</span>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="{{route('beranda')}}" class="nav-link">
            <img src="../assets/sidebar/beranda.svg" class="nav-img" alt="Beranda">
            Beranda
          </a>
        </li>
        <li>
          <a href="/html/kandang_ayam.html" class="nav-link active" aria-current="page">
            <img src="../assets/sidebar/hov_kandang_ayam.svg" class="nav-img" alt="Kandang Ayam">
            Kandang Ayam
          </a>
        </li>
        <li>
          <a href="#" class="nav-link">
            <img src="../assets/sidebar/gudang_telur.svg" class="nav-img" alt="Gudang Telur">
            Gudang Telur
          </a>
        </li>
        <li>
          <a href="#" class="nav-link">
            <img src="../assets/sidebar/panen_telur.svg" class="nav-img" alt="Panen Telur">
            Panen Telur
          </a>
        </li>
        <li>
          <a href="#" class="nav-link">
            <img src="../assets/sidebar/penjualan_telur.svg" class="nav-img" alt="Penjualan Telur">
            Penjualan Telur
          </a>
        </li>
        <li>
          <a href="#" class="nav-link">
            <img src="../assets/sidebar/penjualan_ayam.svg" class="nav-img" alt="Penjualan Ayam">
            Penjualan Ayam
          </a>
        </li>
        <li>
          <a href="#" class="nav-link">
            <img src="../assets/sidebar/vaksinasi_ayam.svg" class="nav-img" alt="Vaksinasi Ayam">
            Vaksinasi Ayam
          </a>
        </li>
        <li>
          <a href="#" class="nav-link">
            <img src="../assets/sidebar/laporan_ayam.svg" class="nav-img" alt="Laporan Ayam">
            Laporan Ayam
          </a>
        </li>
        <li>
          <a href="#" class="nav-link">
            <img src="../assets/sidebar/laporan_ayam.svg" class="nav-img" alt="Laporan Ayam">
            Laporan Gudang
          </a>
        </li>
      </ul>
      <hr>
      <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
          <strong>mdo</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
          <li><a class="dropdown-item" href="#">New project...</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
      </div>
    </div>
  </header>

  <!-- Navbar -->
  <header class="header">
    <nav class="navbar navbar-expand-lg bg-light rounded shadow">
      <div class="container-fluid">
        <a href="#"> <span class="fs-4" style="color: #61431F; padding-left: 10px;"><b>KANDANG AYAM</b></span> </a>
        <a href="#" class="ms-auto" style="padding-right:0.75rem">
          <button class="btn" id="notif">
            <img src="../assets/navbar/notifications_png.svg">
          </button>
        </a>

        <div class="row me-2">
          <div class="col-sm-6">
            <img src="../assets/navbar/profile_picture.svg">
          </div>
          <div class="col">
            <div class="col-sm-6">

            <li class="nav-item dropdown">
              <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="user" style="text-decoration: none; color: black;"><b>Rusdi</b></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-light">    
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Setting</a></li>
                  <li><form action="{{ route('logout') }}" method="POST">
                          @csrf
                          <button type="submit" class="dropdown-item logout-btn" id="logoutButton">Logout</button>
                      </form>
                      <script>
                      $(document).ready(function() {
                        $('#logoutButton').click(function(e) {
                            e.preventDefault(); // Prevent default form submission

                            // First AJAX request: Logout the user (destroy session)
                            $.ajax({
                                url: "{{ route('logout') }}", // Laravel logout route to delete session
                                type: 'POST',
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                                },
                                success: function(response) {
                                    console.log("Session destroyed, now logging out from API...");

                                    // Second AJAX request: API logout (invalidate the token)
                                    $.ajax({
                                        url: "{{route('actionLogout')}}", // The route for API logout
                                        type: 'POST',
                                        headers: {
                                            'Authorization': 'Bearer ' + localStorage.getItem('bearer_token') // Attach the token
                                        },
                                        success: function(apiResponse) {
                                            console.log("Logged out from API successfully.");
                                            // Redirect the user after both logouts are successful
                                            window.location.href = '/'; // Or any other page, e.g., login page
                                        },
                                        error: function(xhr, status, error) {
                                            console.error('Error logging out from API:', error);
                                            // Handle API logout error (e.g., show an error message)
                                        }
                                    });
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error logging out from session:', error);
                                    // Handle session logout error (e.g., show an error message)
                                }
                            });
                        });
                      });
                      </script>     
                  </li>
                </ul>
              </li>
            </div>
            <div class="col-sm-6">
              <a>User</a>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>


  <div class="main-content">
    <div class="card bg-light shadow">
      <div class="card-body">
        <table id="myTable" class="display rounded bg-light">
          <thead>
            <tr>
              <th>ID</th>
              <th>NAMA KANDANG</th>
              <th>KAPASITAS</th>
              <th>JENIS KANDANG</th>
              <th>RAS AYAM</th>
              <th>PAKAN</th>
              <th>STATUS PAKAN</th>
              <th>STATUS KANDANG</th>
              <th>TERAKHIR DIUBAH</th>
              <th>OPSI</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- import data kandangnya -->
  <script>
    var userId = @json(Auth::id()); // Get the user ID from the server-side variable
    $.ajax({
        url: "{{ route('kandangku.index') }}", // Your protected API route with the userId
        type: 'GET',
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('bearer_token') // Attach the Bearer token
        },
        success: function(response) {
            console.log(userId);
            console.log('Response:', response); // Log the entire response to verify its structure
            // Clear the table body before inserting new rows
            $('#myTable tbody').empty();
            // Check if the response is an array (which it should be based on your response)
            if (Array.isArray(response)) {
              let autoIncrement = 1;
                response.forEach(function(product) {
                    // Dynamically generate the table row for each product
                    var row = `
                        <tr>
                            <td>${autoIncrement}</td>
                            <td>${product.nama}</td>
                            <td>${product.jumlah_ayam}/${product.kapasitas}</td>
                            <td>${product.jenis_kandang}</td>
                            <td>${product.ras_ayam.nama_ras_ayam}</td>
                            <td>${product.pakan.jenis_pakan}</td>
                            <td>${product.jenis_kandang}</td>
                            <td>${product.status_pakan}</td>
                            <td>${product.status_kandang}</td>
                            <td>
                              <a href="#" data-bs-toggle="modal" data-bs-target="#form_edit_kandang" class="editKandangBtn" data-id="${product.id}">
                              <img src="../assets/edit_button.svg">
                              </a>
                              <a href="#" class="deleteKandangBtn" data-id="${product.id}">
                              <img src="../assets/delete_button.svg">
                              </a>
                            </td>
                        </tr>
                    `;
                    $('#myTable tbody').append(row); // Append the row to the table body
                    autoIncrement++;
                  });
            } else {
                // If response is not an array, show an error message
                alert('Unexpected response format. Expected an array of products.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', xhr.responseText);
            alert("Failed to fetch data.");
        }
    });
        // Step 2: Fetch and populate modal form when "Edit" is clicked
  $(document).on('click', '.editKandangBtn', function() {
    var kandangId = $(this).data('id'); // Get the ID of the kandang to edit

    // Make AJAX request to fetch kandang details
    $.ajax({
      url: `http://127.0.0.1:8000/api/kandangku/${kandangId}`, // Adjust URL if needed
      type: 'GET',
      headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('bearer_token') // Attach Bearer token
      },
      success: function(response) {
        response = response[0];
        console.log(response);
        // Step 3: Populate modal with the fetched data
        $('#idkandang').val(kandangId);
        $('#enamaKandang').val(response.nama);
        $('#ekapasitasKandang').val(response.kapasitas);
        $('#ejumlahAyam').val(response.jumlah_ayam);
        $('#ejenisKandang').val(response.jenis_kandang);
        $('#ras_ayam').val(response.ras_ayam.id); // Populate Ras Ayam dropdown
        $('#pakan').val(response.pakan.id); // Populate Pakan dropdown
        $('#etanggalPembuatanKandang').val(response.updated_at);

        // Set radio button values
        $("input[name='estatusPakan'][value='" + response.status_pakan + "']").prop('checked', true);
        $("input[name='estatusKandang'][value='" + response.status_kandang + "']").prop('checked', true);

        // Open the modal
      },
      error: function(xhr, status, error) {
        console.error('Error fetching kandang data:', error);
        alert('Error fetching kandang data.');
      }
    });
  });

  // Step 4: Handle form submission for editing kandang
  $('#editKandangForm').submit(function(e) {
    e.preventDefault(); // Prevent default form submission
    var kandangId = $('#idkandang').val(); 

    var formData = {
      nama: $('#enamaKandang').val(),
      jenis_kandang: $('#ejenisKandang').val(),
      kapasitas: parseInt($('#ekapasitasKandang').val()),
      jumlah_ayam: parseInt($('#ejumlahAyam').val()),
      id_ras_ayam: parseInt($('#ras_ayam').val()),
      id_pakan: parseInt($('#pakan').val()),
      status_pakan: $('input[name="estatusPakan"]:checked').val(),
      status_kandang: $('input[name="estatusKandang"]:checked').val()
    };

    var jsonData = JSON.stringify(formData);
    console.log(jsonData);
    // Step 5: Send updated data to the server
    $.ajax({
      url: `http://127.0.0.1:8000/api/kandangku/${kandangId}`, // Send PUT request to update kandang
      type: 'PUT',
      data: formData,
      headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('bearer_token') // Attach Bearer token
      },
      success: function(response) {
        console.log('Kandang updated successfully', response);
        alert('Kandang updated successfully!');
        $('#form_edit_kandang').modal('hide'); // Close modal
        location.reload(); // Refresh the page
      },
      error: function(xhr, status, error) {
        console.error('Error updating kandang:', error);
        alert('Failed to update kandang.');
      }
    });
  });
  </script>

<!-- ngehapus -->
<script>
$(document).on('click', '.deleteKandangBtn', function(event) {
    event.preventDefault();  // Prevent the default anchor behavior

    // Get the ID of the kandang to delete
    var kandangId = $(this).data('id');

    // Confirm with the user before deleting
    if (confirm('Are you sure you want to delete this kandang?')) {
        // Send AJAX request to delete the kandang
        $.ajax({
            url: `http://127.0.0.1:8000/api/kandangku/${kandangId}`,  // Adjust the URL if necessary
            type: 'DELETE',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('bearer_token')  // Include Bearer token if necessary
            },
            success: function(response) {
                // Handle the response after successful deletion
                console.log('Kandang deleted:', response);

                // Optionally, you can remove the row from the table without reloading
                $(`a[data-id="${kandangId}"]`).closest('tr').remove();
                
                alert('Kandang has been deleted successfully!');
            },
            error: function(xhr, status, error) {
                console.error('Error deleting kandang:', error);
                alert('Error deleting kandang. Please try again.');
            }
        });
    }
});
</script>

<!-- display data ras ayam create -->
<script>
            $(document).ready(function() {
            // Function to fetch and populate Pakan data into the select dropdown
            function loadRasAyamData() {
              $.ajax({
                url: 'http://127.0.0.1:8000/api/rasayamku',  // The API endpoint to fetch pakan data
                method: 'GET',      // Request method
                headers: {
                  'Authorization': 'Bearer ' + localStorage.getItem('bearer_token') // Attach the Bearer token
                },
                success: function(response) {
                  console.log(response);
                  if (Array.isArray(response)) {
                    // Clear any existing options
                    $('#ras_ayam').empty();

                    // Add a default option (optional)
                    $('#ras_ayam').append('<option value="">Pilih Ras Ayam</option>');

                    // Loop through the response and append each item to the select
                    response.forEach(function(ras_ayam) {
                      // Append each pakan to the select element
                      $('#ras_ayam').append(`
                        <option value="${ras_ayam.id}">${ras_ayam.nama_ras_ayam}</option>
                      `);
                    });
                  } else {
                    console.error('Expected response to be an array');
                  }
                },
                error: function(error) {
                  console.error('Error fetching pakan data:', error);
                }
              });
            }

            // Call the function to load Pakan data when the page loads
            loadRasAyamData();
          });
          </script>

<!-- Display data pakan ayam create -->
<script>
            $(document).ready(function() {
            // Function to fetch and populate Pakan data into the select dropdown
            function loadPakanData() {
              $.ajax({
                url: 'http://127.0.0.1:8000/api/pakanku',  // The API endpoint to fetch pakan data
                method: 'GET',      // Request method
                headers: {
                  'Authorization': 'Bearer ' + localStorage.getItem('bearer_token') // Attach the Bearer token
                },
                success: function(response) {
                  console.log(response);
                  if (Array.isArray(response)) {
                    // Clear any existing options
                    $('#pakan').empty();

                    // Add a default option (optional)
                    $('#pakan').append('<option value="">Pilih Jenis Pakan</option>');

                    // Loop through the response and append each item to the select
                    response.forEach(function(pakan) {
                      // Append each pakan to the select element
                      $('#pakan').append(`
                        <option value="${pakan.id}">${pakan.jenis_pakan}</option>
                      `);
                    });
                  } else {
                    console.error('Expected response to be an array');
                  }
                },
                error: function(error) {
                  console.error('Error fetching pakan data:', error);
                }
              });
            }

            // Call the function to load Pakan data when the page loads
            loadPakanData();
          });
          </script>

<div class="container-fluid d-flex justify-content-end">
  <button type="button" id="buttonTambah" class="btn btn-md" data-bs-toggle="modal" data-bs-target="#form_tambah_kandang">
    Tambah Kandang
  </button>
</div>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/simple-datatables@9.2.1/dist/umd/simple-datatables.js"></script>
  <script src="../js/sidebar.js"></script>
  <script src="../js/table.js"></script>
</body>
</html>