<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">

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
        <li class="nav-item" style="margin-bottom: 30px;">
            <a href="#" class="nav-link active" aria-current="page">
                <img src="../assets/sidebar/hov_beranda.svg" class="nav-img" alt="Beranda">
                Beranda
            </a>
        </li>
        <li style="margin-bottom: 30px;">
            <a href="{{route('kandang-ayam-dashboard.index')}}" class="nav-link">
                <img src="../assets/sidebar/kandang_ayam.svg" class="nav-img" alt="Kandang Ayam">
                Kandang Ayam
            </a>
        </li>
        <li style="margin-bottom: 30px;">
            <a href="{{route('gudang-telur-dashboard.index')}}" class="nav-link">
                <img src="../assets/sidebar/gudang_telur.svg" class="nav-img" alt="Gudang Telur">
                Gudang Telur
            </a>
        </li>
    </ul>
    <hr>
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
                <button class="btn" id="notif" >
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
  <!-- Card First Row -->
  <div class="row">
    <div class="col-sm-8">
      <div class="card">
        <div class="card-body ">
          <h5 class="card-title">Kandang</h5>
          <p class="card-text">Daftar Kandang</p>
          <div class="row">
            <div class="col-sm-auto">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Kandang</h5>
                  <p class="card-text">Daftar Kandang</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-auto">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Kandang</h5>
                  <p class="card-text">Daftar Kandang</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-auto">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Kandang</h5>
                  <p class="card-text">Daftar Kandang</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-auto">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Kandang</h5>
                  <p class="card-text">Daftar Kandang</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-auto">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Kandang</h5>
                  <p class="card-text">Daftar Kandang</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Card Second Row -->
  <div class="row">
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Card Third Row -->
  <div class="row">
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col-sm-8">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
  </div>
    <a>adsjlkasdja tes</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
    <a>adsjlkasdja</a> <br/>
</div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../js/sidebar.js"></script>
  </body>
</html>