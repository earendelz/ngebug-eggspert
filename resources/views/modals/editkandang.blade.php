<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Kandang Ayam</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Flatpickr CSS -->
  <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
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
  <div class="modal fade" id="form_edit_kandang" tabindex="-1" aria-labelledby="formKandangLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <form id="editKandangForm">
          <div class="mb-3">
              <input type="text" class="form-control" id="idkandang" hidden>
              <label for="namaKandang" class="form-label">Nama Kandang</label>
              <input type="text" class="form-control" id="enamaKandang" placeholder="Masukkan nama kandang">
            </div>
            <div class="mb-3">
              <label for="kapasitasKandang" class="form-label">Kapasitas</label>
              <input type="text" class="form-control" id="ekapasitasKandang" placeholder="Masukkan kapasitas kandang">
            </div>
            <div class="mb-3">
              <label for="jumlahAyam" class="form-label">Jumlah Ayam</label>
              <input type="text" class="form-control" id="ejumlahAyam" placeholder="Masukkan jumlah ayam">
            </div>
            <div class="mb-3">
              <label for="jenisKandang" class="form-label">Jenis Kandang</label>
              <input type="text" class="form-control" id="ejenisKandang" placeholder="Masukkan jenis kandang">
            </div>
            <div class="mb-3">
              <label for="ras_ayam" class="form-label">Ras Ayam</label>
              <select name="ras_ayam" class="form-control" id="ras_ayam" placeholder="Ras Ayam">
                <option value="1">Jago</option>
                <option value="2"></option>
              </select>   
            </div>
            <div class="mb-3">
              <label for="pakan" class="form-label">Pakan</label>
              <select name="pakan" class="form-control" id="pakan" placeholder="Jenis Pakan">
                <option value="1">Tanah</option>
                <option value="2"></option>
              </select>   
            </div>
            <div class="mb-3">
              <label for="tanggalPembuatanKandang" class="form-label">Tanggal Pembuatan Kandang</label>
              <input type="text" class="form-control" id="etanggalPembuatanKandang" placeholder="Pilih tanggal">
            </div>
            <div class="mb-3">
              <label class="form-label">Status Pakan</label>
              <div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="estatusPakan" id="manual" value="manual">
                  <label class="form-check-label" for="manual" style="color: #AE7B3D;">Manual</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="estatusPakan" id="otomatis" value="otomatis">
                  <label class="form-check-label" for="otomatis" style="color: #AE7B3D;">Otomatis</label>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Status Kandang</label>
              <div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="estatusKandang" id="tersedia" value="tersedia">
                  <label class="form-check-label" for="Tersedia" style="color: #AE7B3D;">Tersedia</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="estatusKandang" id="tidak_tersedia" value="tidak tersedia">
                  <label class="form-check-label" for="tidak_tersedia" style="color: #AE7B3D;">Tidak Tersedia</label>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="color: #AE7B3D;">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
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
