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

function readArticles($user_id)
{
    // Use the $user_id parameter to filter articles submitted by a specific user
    $query = "SELECT
        articles.id AS article_id,
        articles.published AS published_date,
        articles.title AS article_title,
        users.username,
        categories.category_name
    FROM
        articles
    INNER JOIN users ON articles.user_id = users.id
    INNER JOIN categories ON articles.category_id = categories.id
    WHERE articles.user_id = $user_id"; // Filter articles based on user_id

    $result = mysqli_query(getConnection(), $query);

    // Create an array to store the article data
    $sub_data = [];

    // Loop to fetch each row of the query result
    while ($row = mysqli_fetch_assoc($result)) {
        // Add each row of the query result to the $sub_data array
        $sub_data[] = $row;
    }

    // Return the $sub_data array containing the article data
    return $sub_data;
}

function getScriptfromarticles($user_id, $article_id)
{
    // Validasi parameter
    if (!is_numeric($user_id) || !is_numeric($article_id)) {
        return null; // Kembalikan null jika parameter tidak valid
    }

    $conn = getConnection();

    // Persiapkan query menggunakan prepared statement
    $query = "SELECT script FROM articles WHERE user_id = ? AND id = ?";
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameter ke query
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $article_id);

    // Jalankan query
    mysqli_stmt_execute($stmt);

    // Dapatkan hasil query
    $result = mysqli_stmt_get_result($stmt);

    // Periksa apakah ada hasil
    if ($result && $row = mysqli_fetch_assoc($result)) {
        // Jika ada hasil, kembalikan script
        $text = $row['script'];
    } else {
        // Jika tidak ada hasil, atur $text menjadi null
        $text = null;
    }

    // Tutup statement dan koneksi
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $text;
}

function saveScript($user_id, $article_id, $content)
{
    // Validasi parameter
    if (!is_numeric($user_id) || !is_numeric($article_id)) {
        // Tampilkan pesan kesalahan jika parameter tidak valid
        echo "<script>
        Swal.fire({
            title: 'Gagal!',
            text: 'Parameter tidak valid.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
        return;
    }

    $conn = getConnection();

    // Persiapkan query menggunakan prepared statement
    $query = "UPDATE articles SET script = ? WHERE user_id = ? AND id = ?";
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameter ke query
    mysqli_stmt_bind_param($stmt, "sii", $content, $user_id, $article_id);

    // Eksekusi query
    $result = mysqli_stmt_execute($stmt);

    // Periksa hasil eksekusi query
    if ($result) {
        echo "<script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Artikel berhasil disimpan.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
        </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Gagal!',
            text: 'Artikel gagal disimpan.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
    }

    // Tutup statement dan koneksi
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
