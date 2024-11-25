<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


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
            <a href="{{route('beranda')}}" class="nav-link active" aria-current="page">
                <img src="../assets/sidebar/hov_beranda.svg" class="nav-img" alt="Beranda">
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
          <a href="{{route('penjualan-telur-dashboard.index')}}" class="nav-link">
            <img src="../assets/sidebar/penjualan_telur.svg" class="nav-img" alt="Penjualan Telur">
            Penjualan Telur
          </a>
        </li>
        <li>
          <a href="{{route('penjualan-ayam-dashboard.index')}}" class="nav-link">
            <img src="../assets/sidebar/penjualan_ayam.svg" class="nav-img" alt="Penjualan Ayam">
            Penjualan Ayam
          </a>
        </li>
        <li>
          <a href="{{route('vaksinasi-ayam-dashboard.index')}}" class="nav-link">
            <img src="../assets/sidebar/vaksinasi_ayam.svg" class="nav-img" alt="Vaksinasi Ayam">
            Vaksinasi Ayam
          </a>
        </li>
        <li>
          <a href="{{route('laporan-ayam-dashboard.index')}}" class="nav-link">
            <img src="../assets/sidebar/laporan_ayam.svg" class="nav-img" alt="Laporan Ayam">
            Laporan Ayam
          </a>
        </li>
        <li>
          <a href="{{route('laporan-gudang-dashboard.index')}}  " class="nav-link">
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
          <div class="row" id="kandang-container">
            
        </div>
      </div>
    </div>
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Jumlah Penjualan Keseluruhan</h5>
          <canvas id="penjualanChart"></canvas>
          </div>
      </div>
    </div>
  </div>
  <div class="col-sm-8">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Jumlah Pendapatan</h5>
          <canvas id="pendapatanChart"></canvas>
          </div>
      </div>
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
        
        // Clear the container before inserting new cards
        $('#kandang-container').empty();

        // Check if the response is an array (which it should be based on your response)
        if (Array.isArray(response)) {
            let autoIncrement = 1;
            response.forEach(function(product) {
                // Dynamically generate the card for each product
                var cardHTML = `
                    <div class="col-sm-auto">
                        <div class="card" style="width: 9rem; background-color: #F7E2BF">
                        <a href="{{route('kandang-ayam-dashboard.index')}}" >
                            <div class="card-body" style="width:9rem;">
                                <h5 class="card-title" style="color:#151d48">${product.nama}</h5>
                                <p class="card-text" style="color:#425166">${product.jenis_kandang}</p>
                                <p class="card-text" style="color:#425166">Jumlah: ${product.jumlah_ayam}/${product.kapasitas}</p>
                                <p class="card-text me-auto" style="color:#425166">
                                    ${product.status_kandang === 'tersedia' ? 
                                        `<svg width="12" height="12" viewBox="0 0 12 12" fill="green"><circle cx="6" cy="6" r="6" /></svg>` : 
                                        (product.status_kandang === 'tidak tersedia' ? 
                                            `<svg width="12" height="12" viewBox="0 0 12 12" fill="red"><circle cx="6" cy="6" r="6" /></svg>` : '')}
                                    
                                </p>
                                </div>
                        </a>
                        </div>
                    </div>
                `;
                $('#kandang-container').append(cardHTML); // Append the card HTML to the container
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
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../js/sidebar.js"></script>

    <script>
      // Ambil data penjualan Telur dan Ayam dari backend atau gunakan data statis untuk percakapan ini
      const penjualanTelur = @json($penjualanTelurData); // Data Penjualan Telur dalam format JSON
      const penjualanAyam = @json($penjualanAyamData);   // Data Penjualan Ayam dalam format JSON

      // Bulan untuk sumbu x (x-axis)
      const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

      const penjualanTelurAdjusted = [];
      const penjualanAyamAdjusted = [];

      for (let i = 0; i < 12; i++) {
        penjualanTelurAdjusted.push(penjualanTelur[i + 1] || 0); // Menggunakan 0 jika tidak ada data
        penjualanAyamAdjusted.push(penjualanAyam[i + 1] || 0);   // Menggunakan 0 jika tidak ada data
      }

      // Menyiapkan data untuk grafik
      const data = {
        labels: bulan,
        datasets: [
          {
            label: 'Penjualan Telur',
            data: penjualanTelurAdjusted, 
            borderColor: 'rgba(255, 206, 86, 1)',
            backgroundColor: 'rgba(255, 206, 86, 1)',
            fill: false,
            tension: 0.1
          },
          {
            label: 'Penjualan Ayam',
            data: penjualanAyamAdjusted,
            borderColor: 'rgba(75, 192, 192, 1)', 
            backgroundColor: 'rgba(75, 192, 192, 1)', 
            fill: false,
            tension: 0.1
          }
        ]
      };

      // Konfigurasi grafik
      const config = {
        type: 'line', // Jenis grafik garis
        data: data,
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
            },
            tooltip: {
              callbacks: {
                label: function(tooltipItem) {
                  return tooltipItem.raw + ' unit';
                }
              }
            }
          },
          scales: {
            y: {
              beginAtZero: true, // Memulai sumbu Y dari 0
            }
          }
        }
      };

      // Membuat grafik
      const penjualanChart = new Chart(
        document.getElementById('penjualanChart'), // Mengarah ke elemen canvas
        config
      );
    </script>
    <script>
        // Ambil data dari controller yang dikirim ke view
        var pendapatanTelurData = @json($pendapatanTelurData);
        var pendapatanAyamData = @json($pendapatanAyamData);

        // Siapkan data untuk grafik
        var bulanPendapatan = [];
        var totalTelur = [];
        var totalAyam = [];

        var bulanNama = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        // Mengisi data bulan dan total
        for (var i = 0; i < 12; i++) {
            var bulanIndex = i + 1; // Menyesuaikan indeks bulan 1-12
            bulanPendapatan.push(bulanNama[i]); // Menambahkan nama bulan sesuai dengan index
        
            // Cek apakah data ada untuk bulan ini, jika tidak, masukkan 0
            var totalTelurBulan = pendapatanTelurData[bulanIndex] || 0;
            var totalAyamBulan = pendapatanAyamData[bulanIndex] || 0;

            totalTelur.push(totalTelurBulan); 
            totalAyam.push(totalAyamBulan); 
        }

        // Membuat grafik batang
        var ctx = document.getElementById('pendapatanChart').getContext('2d');
        var pendapatanChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: bulanPendapatan, // Sumbu X
                datasets: [
                    {
                        label: 'Pendapatan Telur',
                        data: totalTelur, // Data Pendapatan Telur
                        backgroundColor: 'rgba(255, 206, 86, 1)', 
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Pendapatan Ayam',
                        data: totalAyam, // Data Pendapatan Ayam
                        backgroundColor: 'rgba(75, 192, 192, 1)', 
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 100000, // Langkah sumbu Y
                            min: 0, // Mulai dari 0
                        }
                    }
                }
            }
        });
    </script>

  </body>
</html>