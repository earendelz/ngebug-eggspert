<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Kandang Ayam</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Flatpickr CSS -->
  <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
  <style>

    .modal-content {
      border: 2px solid #AE7B3D;
      border-radius: 10px;
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
    input[type="radio"][value="otomatis"]:checked {
        background-color: red;
        border-color: red;
    }
    input[type="radio"][value="manual"]:checked {
        background-color: green;
        border-color: green;
    }
    
  </style>
</head>
<body>

  <div class="modal fade" id="form_tambah_kandang" tabindex="-1" aria-labelledby="formKandangLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="formKandangLabel" style="color: #AE7B3D;">Tambah Kandang Ayam</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="tambahKandangForm">
            <div class="mb-3">
              <label for="namaKandang" class="form-label">Nama Kandang</label>
              <input type="text" class="form-control" id="namaKandang" placeholder="Masukkan nama kandang">
            </div>
            <div class="mb-3">
              <label for="kapasitasKandang" class="form-label">Kapasitas</label>
              <input type="text" class="form-control" id="kapasitasKandang" placeholder="Masukkan kapasitas kandang">
            </div>
            <div class="mb-3">
              <label for="jumlahAyam" class="form-label">Jumlah Ayam</label>
              <input type="text" class="form-control" id="jumlahAyam" placeholder="Masukkan jumlah ayam">
            </div>
            <div class="mb-3">
              <label for="tanggalPembuatanKandang" class="form-label">Tanggal Pembuatan Kandang</label>
              <input type="text" class="form-control" id="tanggalPembuatanKandang" placeholder="Pilih tanggal">
            </div>
            <div class="mb-3">
              <label class="form-label">Status Pakan</label>
              <div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="statusPakan" id="manual" value="manual">
                  <label class="form-check-label" for="manual" style="color: #AE7B3D;">Manual</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="statusPakan" id="otomatis" value="otomatis">
                  <label class="form-check-label" for="otomatis" style="color: #AE7B3D;">Otomatis</label>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="color: #AE7B3D;">Cancel</button>
              <button type="submit" class="btn btn-primary">Confirm</button>
            </div>
          </form>
          <script>
            $(document).ready(function () {
              $('#tambahKandangForm').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission

                // Get form data
                var formData = {
                  nama: $('#namaKandang').val(),
                  kapasitas: $('#kapasitasKandang').val(),
                  jumlah_ayam: $('#jumlahAyam').val(),
                  tanggal_pembuatan_kandang: $('#tanggalPembuatanKandang').val(),
                  status_pakan: $('input[name="statusPakan"]:checked').val()
                };

                // CSRF token (make sure you have it in your meta tag)
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                  url: '/your-post-route', // Replace with the correct route
                  method: 'POST',
                  data: formData,
                  headers: {
                    'X-CSRF-TOKEN': csrfToken
                  },
                  success: function(response) {
                    // Handle success
                    console.log('Data saved successfully', response);
                    // You can update the UI here or close the modal
                    $('#formKandangModal').modal('hide');
                    alert('Kandang added successfully!');
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
    
    flatpickr("#tanggalPembuatanKandang", {
      dateFormat: "m/d/Y",
      allowInput: true 
    });
  </script>
</body>
</html>
