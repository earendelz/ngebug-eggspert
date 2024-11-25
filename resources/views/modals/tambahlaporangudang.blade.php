<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Gudang</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Flatpickr CSS -->
  <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <style>

    .modal-content {
      border: 2px solid #AE7B3D;
      border-radius: 10px;
    }
    .form-label {
      color: #AE7B3D;
    }
    .btn-primary {
      background-color: #AE7B3D;
      border: none;
    }
    .btn-primary:hover {
      background-color: #A86F2D;
    }
    input[type="radio"] {
    appearance: none;
    border: 2px solid #d3d3d3; 
    border-radius: 50%; 
    outline: none;
    cursor: pointer;
    transition: background-color 0.3s, border-color 0.3s;
    }
    input[type="text"] {
      border: 1px solid #AE7B3D;
      border-radius: 13px;
    }
    input[type="radio"][value="kematian"]:checked {
        background-color: red;
        border-color: red;
    }
    input[type="radio"][value="kelahiran"]:checked {
        background-color: green;
        border-color: green;
    }
    
  </style>
</head>
<body>

  <div class="modal fade" id="form_tambah_laporangudang" tabindex="-1" aria-labelledby="formLaporanayamLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="formLaporangudangLabel" style="color: #AE7B3D;">Tambah Laporan Gudang</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="tambahLaporangudangForm">
            <div class="mb-3">
              <label for="gudang" class="form-label">Gudang</label>
              <select name="gudang" class="form-control" id="gudang" placeholder="Pilih Gudang">
                <option value="1"></option>
              </select>   
            </div>
            <div class="mb-3">
              <label for="jumlahTelur" class="form-label">Jumlah Telur</label>
              <input type="text" class="form-control" id="jumlahTelur" placeholder="Masukkan jumlah telur">
            </div>
            <div class="mb-3">
              <label for="keterangan" class="form-label">Keterangan</label>
              <input type="text" class="form-control" id="keterangan" placeholder="Masukkan keterangan">
            </div>
              <label for="tanggalLaporanGudang" class="form-label">Tanggal Laporan Gudang</label>
              <input type="text" class="form-control" id="tanggalLaporanGudang" placeholder="Pilih tanggal laporan gudang">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="color: #AE7B3D;">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
          </div>
          <script>
            $(document).ready(function () {
              $('#tambahLaporangudangForm').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission
                var date = new Date($('#tanggalLaporanGudang').val());
                var formattedDate = date.toISOString().split('T')[0]; // Outputs in YYYY-MM-DD format

                // Get form data
                var formData = {
                  id_gudang: $('#gudang').val(),
                  jumlah_telur: parseInt($('#jumlahTelur').val()),
                  keterangan: $('#keterangan').val(),
                  tanggal_laporan_gudang: formattedDate,
                };
                console.log(formData);  
                // CSRF token (make sure you have it in your meta tag)
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                var jsonData = JSON.stringify(formData);
                console.log(jsonData)
                $.ajax({
                  url: 'http://127.0.0.1:8000/api/laporangudangku', // Replace with the correct route
                  method: 'POST',
                  data: jsonData,
                  contentType: 'application/json',
                  headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('bearer_token') // Attach the token
                  },
                  success: function(response) {
                    // Handle success
                    console.log('Data saved successfully', response);
                    // You can update the UI here or close the modal
                    $('#form_tambah_laporangudang').modal('hide');
                    alert('Data Laporan Gudang berhasil ditambahkan!');
                    setTimeout(function() {
                      location.reload();
                    }, 1000);
                  
                  },
                  error: function(xhr, status, error) {
                    // Handle error
                    console.log('An error occurred:', error);
                    alert('Something went wrong. Please try again.');
                  }
                });
              });
            });
          </script>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Flatpickr JS -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    
    flatpickr("#tanggalLaporanGudang", {
      dateFormat: "Y-m-d", // This ensures the date is formatted as YYYY-MM-DD
      allowInput: true
    });
  </script>
</body>
</html>
