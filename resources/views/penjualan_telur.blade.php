@include ('modals.tambahpenjualantelur')
@include ('modals.editpenjualantelur')


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
        <img src="../assets/sidebar/logo_eggspert.svg" style="height: 10vh; width: 10vh;">
        <span class="fs-4" style="color: #E59D2A; padding-left: 10px;">Eggspert</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto" style="margin-top: 20px;">
        <li class="nav-item">
            <a href="{{route('beranda')}}" class="nav-link" >
                <img src="../assets/sidebar/beranda.svg" class="nav-img" alt="Beranda">
                Beranda
            </a>
        </li>
        <li>
            <a href="{{route('kandang-ayam-dashboard.index')}}" class="nav-link">
                <img src="../assets/sidebar/kandang_ayam.svg" class="nav-img" alt="Kandang Ayam">
                Kandang Ayam
            </a>
        </li>
        <li>
            <a href="{{route('gudang-telur-dashboard.index')}}" class="nav-link">
                <img src="../assets/sidebar/gudang_telur.svg" class="nav-img" alt="Gudang Telur">
                Gudang Telur
            </a>
        </li>
        <li>
          <a href="{{route('panen-telur-dashboard.index')}}" class="nav-link">
            <img src="../assets/sidebar/panen_telur.svg" class="nav-img" alt="Panen Telur">
            Panen Telur
          </a>
        </li>
        <li>
          <a href="{{route('penjualan-telur-dashboard.index')}}" class="nav-link active" aria-current="page">
            <img src="../assets/sidebar/hov_penjualan_telur.svg" class="nav-img" alt="Penjualan Telur">
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
</div>
  </header>

  <!-- Navbar -->
  <header class="header">
    <nav class="navbar navbar-expand-lg bg-light rounded shadow">
      <div class="container-fluid">
        <a href="#"> <span class="fs-4" style="color: #61431F; padding-left: 10px;"><b>GUDANG TELUR</b></span> </a>
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
            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="user" style="text-decoration: none; color: black;"><b>{{$user->username}}</b></a>
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
              <th>NAMA GUDANG</th>
              <th>TANGGAL PEMBUATAN</th>
              <th>JUMLAH TELUR</th>
              <th>RAS AYAM</th>
              <th>OPSI</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>
    </div>
  </div>


<!-- display data kandang -->
<script>
  // Function to fetch and populate Pakan data into the select dropdown
  function loadKandangData(selectedId) {
    $.ajax({
      url: 'http://127.0.0.1:8000/api/kandangku',  // The API endpoint to fetch pakan data
      method: 'GET',      // Request method
      headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('bearer_token') // Attach the Bearer token
      },
      success: function(response) {
        console.log(response);
        if (Array.isArray(response)) {
          // Clear any existing options
          $('#kandang').empty();
          $('#ekandang').empty();

          $('#ekandang').append('<option value="">Pilih Kandang</option>');
          $('#kandang').append('<option value="">Pilih Kandang</option>');
          
          const responseArray = Object.values(response);
          // Loop through the response and append each item to the select
          responseArray.forEach(function(kandang) {
            // Append each kandang to the select element
            $('#ekandang').append(`
               <option value="${kandang.id}" ${kandang.id === selectedId ? 'selected' : ''}>${kandang.nama}</option>
            `);
            $('#kandang').append(`
              <option value="${kandang.id}">${kandang.nama}</option>
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
  loadKandangData();
</script>

<!-- display data gudang -->
<script>
  // Function to fetch and populate Pakan data into the select dropdown
  function loadGudangData(selectedId) {
    $.ajax({
      url: 'http://127.0.0.1:8000/api/gudangku',  // The API endpoint to fetch pakan data
      method: 'GET',      // Request method
      headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('bearer_token') // Attach the Bearer token
      },
      success: function(response) {
        console.log(response);
        if (Array.isArray(response)) {
          // Clear any existing options
          $('#gudang').empty();
          $('#egudang').empty();

          $('#egudang').append('<option value="">Pilih Gudang</option>');
          $('#gudang').append('<option value="">Pilih Gudang</option>');
          
          const responseArray = Object.values(response)
          // Loop through the response and append each item to the select
          responseArray.forEach(function(gudang) {
            // Append each pakan to the select element
            $('#egudang').append(`
               <option value="${gudang.id}" ${gudang.id === selectedId ? 'selected' : ''}>${gudang.nama}</option>
            `);
            $('#gudang').append(`
              <option value="${gudang.id}">${gudang.nama}</option>
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
  loadGudangData();
</script>


  <!-- import data kandangnya -->
  <script>
    var userId = @json(Auth::id()); // Get the user ID from the server-side variable
    $.ajax({
        url: "{{ route('penjualantelurku.index') }}", // Your protected API route with the userId
        type: 'GET',
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('bearer_token') // Attach the Bearer token
        },
        success: function(response) {
            console.log(userId);
            console.log('Response:', response); // Log the entire response to verify its structure
            // Clear the table body before inserting new rows
           // Check if the response is an array (which it should be based on your response)
            if (Array.isArray(response)) {
              var filteredData = response.map((penjualantelurku, index) => {
                    return [
                        index + 1, // Auto-increment ID
                        penjualantelurku.gudang.nama, 
                        penjualantelurku.telur_terjual, 
                        penjualantelurku.kondisi_telur, 
                        penjualantelurku.harga_perbutir,
                        penjualantelurku.harga_total,
                        penjualantelurku.tanggal_penjualan,
                        `<a href="#" data-bs-toggle="modal" data-bs-target="#form_edit_penjualantelur" class="editPenjualantelurBtn" data-id="${penjualantelurku.id}">
                            <img src="../assets/edit_button.svg" alt="Edit">
                        </a>
                        <a href="#" class="deletePenjualantelurBtn" data-id="${penjualantelurku.id}">
                            <img src="../assets/delete_button.svg" alt="Delete">
                        </a>`
                    ];
                });

                // Define the table column headings
                var headings = [
                    "NO", // Auto-increment
                    "Nama Gudang",
                    "Telur Terjual",
                    "Kondisi Telur",
                    "Harga Perbutir",
                    "Harga Total Terjual",
                    "Tanggal Penjualan",
                    "Opsi"
                ];
                // Initialize the DataTable
                window.datatable = new window.simpleDatatables.DataTable("#myTable", {
                    searchable: false,
                    data: {
                        headings: headings, // Table column headings
                        data: filteredData // Table data
                    }
                }
              );
              document.getElementById("print").addEventListener("click", () => datatable.print());
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
  </script>
  <script>
        // Step 2: Fetch and populate modal form when "Edit" is clicked
    $(document).on('click', '.editPenjualantelurBtn', function() {
      var penjualantelurId = $(this).data('id'); // Get the ID of the kandang to edit

      // Make AJAX request to fetch kandang details
      $.ajax({
        url: `http://127.0.0.1:8000/api/penjualantelurku/${penjualantelurId}`, // Adjust URL if needed
        type: 'GET',
        headers: {
          'Authorization': 'Bearer ' + localStorage.getItem('bearer_token') // Attach Bearer token
        },
        success: function(response) {
          response = response[0];
          console.log(response);
          // Step 3: Populate modal with the fetched data
         loadGudangData(response.gudang.id);
          $('#ejumlahTelur').val(response.telur_terjual);
          $('#ekondisiTelur').val(response.kondisi_telur);
          $('#ehargaTelur').val(response.harga_perbutir);
          $('#etanggalPenjualan').val(response.tanggal_penjualan);
          
          // Open the modal

        },
        error: function(xhr, status, error) {
          console.error('Error fetching kandang data:', error);
          alert('Error fetching kandang data.');
        }
      });
    });

    // Step 4: Handle form submission for editing kandang
    $('#edit_gudang_form').submit(function(e) {
      e.preventDefault(); // Prevent default form submission
      var panentelurId = $('#idGudang').val(); 

      var formData = {
        nama: $('#enamaGudang').val(),
        jumlah_telur : $('#ejumlahTelur').val(),
        tanggal_pembuatan : parseInt($('#etanggalPembuatanGudang').val()),
        id_ras_ayam: parseInt($('#ras_ayam').val()),
      };

      var jsonData = JSON.stringify(formData);
      console.log(jsonData);
      // Step 5: Send updated data to the server
      $.ajax({
        url: `http://127.0.0.1:8000/api/panentelurku/${panentelurId}`, // Send PUT request to update kandang
        type: 'PUT',
        data: formData,
        headers: {
          'Authorization': 'Bearer ' + localStorage.getItem('bearer_token') // Attach Bearer token
        },
        success: function(response) {
          console.log('Panen Telur updated successfully', response);
          alert('Panen Telur updated successfully!');
          $('#form_edit_panentelur').modal('hide'); // Close modal
          // location.reload(); // Refresh the page
        },
        error: function(xhr, status, error) {
          console.error('Error updating kandang:', error);
          alert('Failed to update data panen telur.');
        }
      });
    });
  </script>

<!-- ngehapus -->
<script>
$(document).on('click', '.deletePanentelurBtn', function(event) {
    event.preventDefault();  // Prevent the default anchor behavior

    // Get the ID of the kandang to delete
    var panentelurId = $(this).data('id');

    // Confirm with the user before deleting
    if (confirm('Anda yakin ingin menghapus data panen telur ini?')) {
        // Send AJAX request to delete the kandang
        $.ajax({
            url: `http://127.0.0.1:8000/api/panentelurku/${panentelurId}`,  // Adjust the URL if necessary
            type: 'DELETE',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('bearer_token')  // Include Bearer token if necessary
            },
            success: function(response) {
                // Handle the response after successful deletion
                console.log('gudang deleted:', response);

                // Optionally, you can remove the row from the table without reloading
                $(`a[data-id="${panentelurId}"]`).closest('tr').remove();
                
                alert('Gudang telah berhasil dihapus!');
            },
            error: function(xhr, status, error) {
                console.error('Error deleting kandang:', error);
                alert('Error deleting kandang. Please try again.');
            }
        });
    }
});
</script>


<div class="container-fluid d-flex justify-content-end">
  <button type="button" id="buttonTambah" class="btn btn-md" data-bs-toggle="modal" data-bs-target="#form_tambah_penjualantelur">
    Tambah Penjualan Telur
  </button>
</div>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/simple-datatables@9.2.1/dist/umd/simple-datatables.js"></script>
  <script src="../js/sidebar.js"></script>
  <script src="../js/table.js"></script>
</body>
</html>