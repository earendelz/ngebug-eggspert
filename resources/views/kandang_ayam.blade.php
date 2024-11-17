
@include ('modals.tambahkandang')

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                                            'Authorization': 'Bearer ' + localStorage.getItem('api_token') // Attach the token
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
                              <a>
                              <img src="../assets/edit_button.svg">
                              </a>
                              <a>
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