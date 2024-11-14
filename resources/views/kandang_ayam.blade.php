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
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-light" style="width: 280px; height: 100vh;">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <img src="../assets/sidebar/logo_eggspert.svg " style="height: 10vh; width: 10vh;">
        <span class="fs-4" style="color: #E59D2A; padding-left: 10px;">Eggspert</span>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="/html/beranda.html" class="nav-link">
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
    <nav class="navbar navbar-expand-lg bg-light rounded">
      <div class="container-fluid">
        <a href="#"> <span class="fs-4" style="color: #61431F; padding-left: 10px;"><b>BERANDA</b></span> </a>
        <!-- searchbar, keanya gausah kali ya? -->
        <!-- <div class="input-group">
            <input class="form-control border-end-0 border rounded-pill" type="text" value="search" id="example-search-input">
            <span class="input-group-append">
              <a>
                <button class="btn btn-outline-secondary bg-white border-start-0 border rounded-pill ms-n3" type="button">
                    <img src="../assets/navbar/search_icon.svg">
                </button>
              </a>  
            </span>
          </div>    -->
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
                <li><form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Logout</button>
                                    </form>
                                </li>
                  <li><a class="dropdown-item" href="#">Tes</a></li>
                  <li><a class="dropdown-item" href="#">Tes</a></li>
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
    <div class="card bg-light">
      <div class="card-body">
        <table id="myTable" class="display rounded bg-light">
          <thead>
            <tr>
              <th>Column 1</th>
              <th>Column 2</th>
              <th>Column 3</th>
              <th>Column 4</th>
              <th>Column 5</th>
              <th>Column 6</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script>
    var userId = @json(Auth::id());
  $.ajax({
    url: "{{route('kandang.index')}}" + '/' + userId, // Your protected API route
    type: 'GET',
    headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('bearer_token') // Attach the Bearer token
    },
    success: function(response) {
        console.log('Data:', response);
    },
    error: function(xhr, status, error) {
        console.error('Error:', xhr.responseText);
        alert("Failed to fetch data.");
    }
});
</script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/simple-datatables@9.2.1/dist/umd/simple-datatables.js"></script>
  <script src="../js/sidebar.js"></script>
  <script src="../js/table.js"></script>
</body>

</html>