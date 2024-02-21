<?php

function getConnection()
{
    // Koneksi
    $host = "localhost";
    $username = "root";
    $password = "";
    $database_name = "berita";

    $conn = mysqli_connect($host, $username, $password, $database_name);

    return $conn;
}

function getData($query)
{

    $result = mysqli_query(getConnection(), $query);
    $data = [];

    // Fetch
    $i = 0;
    while ($fetch = mysqli_fetch_assoc($result)) {
        $data[$i] = $fetch;
        $i++;
    }
    return $data;
}

function insertUserAccount($username, $password)
{
    $username = mysqli_real_escape_string(getConnection(), $username);
    $password = mysqli_real_escape_string(getConnection(), $password);

    $query = "SELECT * FROM users WHERE username='$username';";

    $result = mysqli_query(getConnection(), $query);

    $isRegistered = mysqli_num_rows($result);

    if ($isRegistered == 1) {
        echo "
            <script>
                alert('Username already registered!');
            </script>
        ";
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password');";

        if (mysqli_query(getConnection(), $query)) {
            header("Location: login_page.php");
        } else {
            echo "
                <script>
                    alert('Failed to register!');
                </script>
            ";
        }
    }
}

function loginUser($username, $password)
{
    $username = mysqli_real_escape_string(getConnection(), $username);
    $password = mysqli_real_escape_string(getConnection(), $password);
    $query = "SELECT * FROM users WHERE username='$username';";

    $result = mysqli_query(getConnection(), $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if (password_verify($password, $user['password'])) { // Compare hashed password
            if ($user['role'] == "Admin") {
                header("Location: admin.php");
            } else if ($user['role'] == "User") {

                echo "<script>
        Swal.fire({
            title: 'Selamat datang!',
            text: 'Anda berhasil login.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>";
                header("Location: user.php");
            }
        } else {
            echo "
                    <script>
                        alert('Password is incorrect!');
                        alert('password: " . htmlspecialchars($password) . "');
                        alert('user password: " . htmlspecialchars($user['password']) . "');
                    </script>
                ";
        }
    } else {
        echo "
                <script>
                    alert('Username is not registered!');
                </script>
            ";
    }
}
