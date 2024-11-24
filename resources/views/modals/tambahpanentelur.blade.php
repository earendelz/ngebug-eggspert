<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panen Telur</title>
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
    input[type="radio"][value="nonaktif"]:checked {
        background-color: red;
        border-color: red;
    }
    input[type="radio"][value="aktif"]:checked {
        background-color: green;
        border-color: green;
    }
    
  </style>
</head>
<body>

  <div class="modal fade" id="form_tambah_panentelur" tabindex="-1" aria-labelledby="formPanentelurLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="formPenjualantelurLabel" style="color: #AE7B3D;">Tambah Panen Telur</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="tambahPanentelurForm">
            <div class="mb-3">
              <label for="kandang" class="form-label">Kandang</label>
              <select name="kandang" class="form-control" id="kandang" placeholder="Pilih Kandang">
                <option value="1"></option>
              </select>   
            </div>
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
              <label for="kondisiTelur" class="form-label">Kondisi Telur</label>
              <input type="text" class="form-control" id="kondisiTelur" placeholder="Masukkan Kondisi Telur">
            </div>
            <div class="mb-3">
              <label for="tanggalPanen" class="form-label">Tanggal Panen Telur</label>
              <input type="text" class="form-control" id="tanggalPanen" placeholder="Pilih tanggal">
            </div>
            <div class="mb-3">
              <label for="memo" class="form-label">Keterangan</label>
              <textarea class="form-control" id="memo" name="memo" placeholder="Tambahkan Keterangan" oninput="adjustTextareaHeight(this)"></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="color: #AE7B3D;">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
          <script>
            $(document).ready(function () {
              $('#tambahPanentelurForm').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission
                var date = new Date($('#tanggalPanen').val());
                var formattedDate = date.toISOString().split('T')[0]; // Outputs in YYYY-MM-DD format

                // Get form data
                var formData = {
                  id_kandang: $('#kandang').val(),
                  id_gudang: $('#gudang').val(),
                  kondisi_telur: $('#kondisiTelur').val(),
                  jumlah_telur : $('#jumlahTelur').val(),
                  tanggal_panen : formattedDate,
                  memo : $('#memo').val(),
                };
                console.log(formData);  
                // CSRF token (make sure you have it in your meta tag)
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                var jsonData = JSON.stringify(formData);
                console.log(jsonData)
                $.ajax({
                  url: 'http://127.0.0.1:8000/api/panentelurku', // Replace with the correct route
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
                    $('#formPanentelurModal').modal('hide');
                    alert('Data Panen Telur berhasil ditambahkan!');
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
    
    flatpickr("#tanggalPanen", {
      dateFormat: "Y-m-d", // This ensures the date is formatted as YYYY-MM-DD
      allowInput: true
    });
  </script>
</body>
</html>
