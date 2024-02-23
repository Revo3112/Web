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
    $user_id = $user['id'];

    if ($user) {
        if (password_verify($password, $user['password'])) { // Compare hashed password
            if ($user['role'] == "Admin") {
                header("Location: admin.php");
            } else if ($user['role'] == "User") {
                header("Location: user.php?id=$user_id");
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
    // Gunakan parameter $user_id untuk memfilter artikel yang dimasukkan oleh pengguna tertentu
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
    WHERE articles.user_id = $user_id"; // Filter artikel berdasarkan user_id
    $result = mysqli_query(getConnection(), $query);

    // Buat array untuk menyimpan data artikel
    $sub_data = [];

    // Perulangan untuk mengambil setiap baris hasil query
    while ($row = mysqli_fetch_assoc($result)) {
        // Tambahkan setiap baris hasil query ke dalam array $sub_data
        $sub_data[] = $row;
    }

    // Kembalikan array $sub_data yang berisi data artikel
    return $sub_data;
}

function getUserArticle($user_id, $article_id)
{
    $query = "SELECT script FROM articles WHERE user_id=$user_id and id=$article_id";
    $result = mysqli_query(getConnection(), $query);
    $script = mysqli_fetch_assoc($result);

    return $script;
}

function insertUserArticle($query, $user_id) {

    $result = mysqli_query(getConnection(), $query);

    if ($result) {
        header("Location: user.php?id=$user_id&status=success");
    } else {
    }
}

function deleteUserArticle($user_id, $article_id) {
    $query = "DELETE FROM articles WHERE user_id=$user_id AND id=$article_id";

    $result = mysqli_query(getConnection(), $query);

    if ($result) {
        header("Location: user.php?id=$user_id&status=success");
    }
}
