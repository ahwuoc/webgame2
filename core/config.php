<?php
require_once 'connect.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if( @$_SESSION['sv'] == 1){
    $conn = $conn;
}
if( @$_SESSION['sv'] == 2){
    $conn = $conn1;
}
// if( @$_SESSION['sv'] == 3){
//     $conn = $conn2;
// }
// if( @$_SESSION['sv'] == 4){
//     $conn = $conn3;
// }

function _query($sql)
{
    global $conn;
    return $conn->query($sql);
}

function _fetch($sql)
{
    return _query($sql)->fetch(PDO::FETCH_ASSOC);
}

function isset_sql($txt)
{
    global $conn;
    return $conn->quote($txt);
}

function _insert($table, $input, $output)
{
    return "INSERT INTO $table($input) VALUES($output)";
}

function _select($select, $from, $where)
{
    return "SELECT $select FROM $from WHERE $where";
}

function _update($tabname, $input_output, $where)
{
    return "UPDATE $tabname SET $input_output WHERE $where";
}

function _delete($table, $condition)
{
    global $conn;
    _query("DELETE FROM $table WHERE $condition");
}

function show_alert($alert)
{
    echo '<div class="' . $alert[0] . '">' . $alert[1] . '</div>';
}

function _num_rows($result)
{
    // Be robust across PDOStatement and mysqli_result
    if (is_object($result)) {
        // PDOStatement has rowCount method
        if (method_exists($result, 'rowCount')) {
            return $result->rowCount();
        }
        // mysqli_result exposes num_rows property
        if (property_exists($result, 'num_rows')) {
            return $result->num_rows;
        }
    }
    return 0;
}

function has_mkc2($username)
{
    global $conn; // Use the global $conn variable from connect.php

    try {
        // Kiểm tra xem cột mkc2 có tồn tại không (không dựa vào rowCount)
        $checkColumn = $conn->query("SHOW COLUMNS FROM account LIKE 'mkc2'");
        $columnInfo = $checkColumn ? $checkColumn->fetch(PDO::FETCH_ASSOC) : false;
        if (!$columnInfo) {
            // Cột mkc2 không tồn tại, trả về false
            return false;
        }

        // Thực hiện truy vấn để lấy giá trị của cột "mkc2" từ bảng "account"
        $sql = "SELECT mkc2 FROM account WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Kiểm tra và trả về kết quả là true/nếu giá trị khác rỗng và false/ngược lại
        if (count($result) > 0) {
            foreach ($result as $row) {
                if ($row['mkc2'] != '') {
                    return true;
                }
            }
        }

        // Trả về giá trị mặc định là false
        return false;
    } catch (PDOException $e) {
        // Xử lý lỗi khi có exception xảy ra
        // Không echo lỗi để tránh làm gián đoạn trang
        return false;
    }
}
?>