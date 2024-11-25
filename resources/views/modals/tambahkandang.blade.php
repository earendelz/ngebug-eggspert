<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kandang Ayam</title>
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
    input[type="radio"][value="tidak tersedia"]:checked {
        background-color: red;
        border-color: red;
    }
    input[type="radio"][value="tersedia"]:checked {
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
              <label for="jenisKandang" class="form-label">Jenis Kandang</label>
              <input type="text" class="form-control" id="jenisKandang" placeholder="Masukkan jenis kandang">
            </div>
            <div class="mb-3">
              <label for="ras_ayam" class="form-label">Ras Ayam</label>
              <select name="ras_ayam" class="form-select" id="ras_ayam" placeholder="Ras Ayam">
                <option value=""></option>
              </select>   
            </div>
            <div class="mb-3">
              <label for="pakan" class="form-label">Pakan</label>
              <select name="pakan" class="form-select" id="pakan" placeholder="Jenis Pakan">
                <option value=""></option>
              </select>   
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
            <div class="mb-3">
              <label class="form-label">Status Kandang</label>
              <div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="statusKandang" id="tersedia" value="tersedia">
                  <label class="form-check-label" for="Tersedia" style="color: #AE7B3D;">Tersedia</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="statusKandang" id="tidak_tersedia" value="tidak tersedia">
                  <label class="form-check-label" for="tidak_tersedia" style="color: #AE7B3D;">Tidak Tersedia</label>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="color: #AE7B3D;">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
          <script>
            $(document).ready(function () {
              $('#tambahKandangForm').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission

                // Get form data
                var formData = {
                  nama: $('#namaKandang').val(),
                  jenis_kandang: $('#jenisKandang').val(),
                  kapasitas: $('#kapasitasKandang').val(),
                  jumlah_ayam: $('#jumlahAyam').val(),
                  id_ras_ayam: $('#ras_ayam').val(),
                  id_pakan: $('#pakan').val(),
                  status_pakan: $('input[name="statusPakan"]:checked').val(),
                  status_kandang: $('input[name="statusKandang"]:checked').val()
                };

                // CSRF token (make sure you have it in your meta tag)
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                var jsonData = JSON.stringify(formData);
                console.log(jsonData)
                $.ajax({
                  url: 'https://eggspert.site/api/kandangku', // Replace with the correct route
                  method: 'POST',
                  data: jsonData,
                  contentType: 'application/json',
                  headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('bearer_token') // Attach the token
                  },
                  success: function(response) {
                    // Handle success
                    console.log('Data kandang berhasil disimpan', response);
                    // You can update the UI here or close the modal
                    $('#formKandangModal').modal('hide');
                    alert('Data kandang berhasil disimpan!');
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
    
    flatpickr("#tanggalPembuatanKandang", {
      dateFormat: "Y-m-d",
      allowInput: true 
    });
  </script>
</body>
</html>
