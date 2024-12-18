<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-4" style="padding-bottom: 5%;">
            <form class="login-form mt-5 p-4 bg-white shadow rounded" id="registerForm">
                @csrf
                <h2 class="text-center mb-4">Register</h2>
                <img src="assets/LogoEggspertApp.png" id="logo">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                </div>
                <button id="buttonRegister" type="submit" class="btn btn-primary btn-block">Register</button>
            </form>

            <script>
                $('#registerForm').on('submit', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    $.ajax({
                        url: "{{ route('actionRegister') }}", // Route to register
                        type: "POST",
                        data: {
                            "_token": $("meta[name='csrf-token']").attr("content"), // CSRF token
                            "username": $('#username').val(), // Username
                            "password": $("#password").val(), // Password
                            "nama": $("#nama").val(), // Nama
                            "email": $("#email").val(), // Email
                            "alamat": $("#alamat").val() // Alamat
                        },
                        success: function(response) {
                            if (response.status === 200) {
                                
                                // Token stored in cookie or localStorage (for API calls), if needed
                                localStorage.setItem('auth_token', response.data.token); // Store token if using for API calls
                                // Redirect user to a protected page
                                window.location.href = "/login";
                            } else {
                                alert("Register failed: " + response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', xhr.responseText);
                            alert("An error occurred. Please try again.");
                        }
                    });
                });
            </script>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (optional for this simple page) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>