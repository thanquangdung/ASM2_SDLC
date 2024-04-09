<?php
// Assuming you have a record ID passed via GET or POST
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $_servername = "localhost";
    $_username = "root";
    $_password = "";
    $_dbname = "btec-student table";


    // Prepare an SQL statement to delete the record
    $connection = new mysqli($_servername, $_username, $_password, $_dbname);

    $sql = "DELETE FROM users WHERE id = $id";
    $connection->query($sql);
}

header("location: /FAPI/home_page.php");
exit;
?>



<!-- <?php
// Kết nối tới cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', '', 'btec-student table');

// Kiểm tra kết nối
if (!$conn) {
    die('Không thể kết nối tới cơ sở dữ liệu: ' . mysqli_connect_error());
}

// Xác định ID của học sinh cần xóa từ tham số trên URL
$user_id = $_GET['id'];

// Xóa học sinh từ cơ sở dữ liệu
$query = "DELETE FROM users WHERE id=$user_id";
if (mysqli_query($conn, $query)) {
    echo "Học sinh đã được xóa thành công.";
} else {
    echo "Lỗi: " . mysqli_error($conn);
}

// Đóng kết nối
mysqli_close($conn);
?> -->
