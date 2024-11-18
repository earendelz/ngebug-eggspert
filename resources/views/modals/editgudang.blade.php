<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Gudang Telur</title>
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

  <div class="modal fade" id="form_edit_gudang" tabindex="-1" aria-labelledby="formGudangLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="formGudangLabel" style="color: #AE7B3D;">Edit Gudang Telur</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="edit_gudang_form">
          <div class="mb-3">
              <label for="namaGudang" class="form-label">Nama Gudang Telur</label>
              <input type="text" class="form-control" id="enamaGudang" placeholder="Masukkan nama Gudang">
            </div>
            <div class="mb-3">
              <label for="jumlahTelur" class="form-label">Jumlah Telur</label>
              <input type="text" class="form-control" id="ejumlahTelur" placeholder="Masukkan jumlah telur">
            </div>
            <div class="mb-3">
              <label for="tanggalPembuatanGudang" class="form-label">Tanggal Pembuatan Gudang</label>
              <input type="text" class="form-control" id="etanggalPembuatanGudang" placeholder="Pilih tanggal">
            </div>
            <div class="mb-3">
              <label for="ras_ayam" class="form-label">Ras Ayam</label>
              <select name="ras_ayam" class="form-control" id="ras_ayam" placeholder="Ras Ayam">
                <option value="1">Jago</option>
              </select>   
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
    
    flatpickr("#tanggalPembuatanGudang", {
      dateFormat: "m/d/Y",
      allowInput: true 
    });
  </script>
</body>
</html>
