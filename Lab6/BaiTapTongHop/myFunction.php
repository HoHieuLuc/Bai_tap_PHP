<?php

/**
 * Tạo ra 1 thẻ table chứa dữ liệu từ câu truy vấn  
 * @param mysqli_result $result A result set identifier returned by mysqli_query(), mysqli_store_result() or mysqli_use_result().
 * @param string $editPath đường dẫn tới trang Edit
 * @param string $deletePath đường dẫn tới trang Delete
 * @param array $tableHeaders là mảng chứa tên các cột (header) của table
 * @param array $tableData [optional] là mảng có dạng 'tên cột trong dữ liệu' => 'định dạng',
 * nếu không cần định dạng dữ liệu thì không cần dùng.  
 * Các định dạng hỗ trợ: image, bool, mặc định: hiển thị text
 * @param string $id1 khóa chính của bảng
 * @param string $id2 [optional] khóa chính thứ 2 của bảng 
 * @param int $maxPage [optional] số trang tối đa tính được khi phân trang
 * @param string $searchQuery [optional] phân trang hỗ trợ tìm kiếm, xem hàm getSearchQuery(array) để
 * biết thêm chi tiết
 * @example {1} $tableHeaders = array ('Mã', 'Ảnh', 'Giới tính', 'Tên')  
 * $tableData = array('ma' => null, 'anh' => 'image', 'gioi_tinh' => 'bool - Nam - Nữ', 'ten' => null)  
 * $maxPage = 5;  
 * buildTable(result, "EditPage.php", "DeletePage.php", tableHeaders, tableData, "ma");  
 * Lưu ý: Số tableHeaders phải bằng số tableData
 */
function buildTable(
    mysqli_result $result,
    string $editPath = "",
    string $deletePath = "",
    array $tableHeaders,
    array $tableData = array(""),
    string $id1 = "",
    string $id2 = "",
    int $maxPage = 0,
    string $searchQuery = ""
) {
    if (count($tableHeaders) == mysqli_num_fields($result) || count($tableHeaders) == count($tableData)) {
        if (mysqli_num_rows($result) > 0) { ?>
            <div class="table-wrapper">
                <table class="fl-table">
                    <thead>
                        <tr>
                            <?php
                            foreach ($tableHeaders as $header) {
                                echo "<th>$header</th>";
                            }
                            if ($id1 !== "") {
                                echo "<th>Chức năng</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        ?>
                            <tr>
                                <?php
                                // nếu table data được truyền vào
                                if ($tableData != array("")) {
                                    foreach ($tableData as $tenCot => $dinhDang) {
                                        $dinhDangs = array_map('trim', explode('-', $dinhDang));
                                        echo "<td>";
                                        switch ($dinhDangs[0]) {
                                            case "image":
                                                echo "<img src ='images/" . $row[$tenCot] . "' alt='ảnh' class='small-rounded-img'>";
                                                break;
                                            case "bool":
                                                echo $row[$tenCot] ? $dinhDangs[1] : $dinhDangs[2];
                                                break;
                                            default:
                                                echo $row[$tenCot];
                                                break;
                                        }
                                        echo "</td>";
                                    }
                                } else {
                                    foreach ($row as $value) {
                                        echo "<td>$value</td>";
                                    }
                                }
                                if ($id1 !== "") {
                                ?>
                                    <td>
                                        <?php
                                        if ($id2 === "") {
                                            echo '<a href="' . $editPath . '?id1=' . $row[$id1] . '">Sửa</a>';
                                            echo ' ';
                                            echo '<a href="' . $deletePath . '?id1=' . $row[$id1] . '">Xóa</a>';
                                        } else {
                                            // chưa test
                                            echo '<a href="' . $editPath . '?id1=' . $row[$id1] . '&' . '?id2=' . $row[$id2] . '">Sửa</a>';
                                            echo ' ';
                                            echo '<a href="' . $deletePath . '?id1=' . $row[$id1] . '&' . '?id2=' . $row[$id2] . '">Xóa</a>';
                                        }
                                        ?>
                                    </td>
                            </tr>
                    <?php
                                }
                            }
                    ?>
                    </tbody>
                </table>
            </div>
            <br>
            <?php
            if ($maxPage > 0) {
                echo "<div class='center'>";
                echo "<div class='flexbox'>";
                //tạo link tương ứng tới các trang
                if ($_GET['page'] > 1) {
                    echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=1" . $searchQuery . "><<</a>";
                }
                for ($i = 1; $i <= $maxPage; $i++) {
                    if ($i == $_GET['page']) {
                        echo '<b>' . $i . '</b>'; //trang hiện tại sẽ được bôi đậm
                    } else {
                        echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . $i . $searchQuery . ">" . $i . "</a>";
                    }
                }
                if ($_GET['page'] < $maxPage) {
                    echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . $maxPage . $searchQuery . ">>></a>";
                }
                echo "</div>";
                echo "</div>";
            }
            ?>
<?php
        } else {
            echo "Không có dữ liệu";
        }
    } else {
        echo "Số header truyền vào phải bằng số cột dữ liệu";
    }
    mysqli_free_result($result);
}

/**
 * Tạo ra các thẻ \<option> cho thẻ \<select>
 * @param mysqli_result $result dữ liệu từ câu truy vấn
 * @param string $selectName name của thẻ <select>
 * @param string $idName tên của khóa
 * @param string $idValue giá trị muốn hiển thị cho khóa
 * @param string $selectedValue [optional] giá trị chọn mặc định, dùng cho trang Edit
 * 
 */
function buildDropDownList(mysqli_result $result, string $selectName, string $idName, string $idValue, string $selectedValue = null)
{
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo "<option value='" . $row[$idName] . "' ";
            if (isset($_REQUEST[$selectName]) && $_REQUEST[$selectName] == $row[$idName]) {
                echo "selected='selected'";
            } else if ($selectedValue == $row[$idName]) {
                echo "selected='selected'";
            }
            echo ">" . $row[$idValue] . "</option>";
        }
    }
    mysqli_free_result($result);
}

/**
 * Lấy id tiếp theo
 * @param msqli_result $result kết quả của câu query, câu query nên trả về hàng có khóa lớn nhất
 * @param string $idName tên của khóa
 * @param string $idPrefix prefix cho khóa
 * @param int $numLenght số lượng chữ số '0'
 * @example {1} $query = 'SELECT my_id FROM my_table ORDER BY my_id DESC LIMIT 1;  
 * Ví dụ ta lấy được my_id = "ID00015"  
 * $result = mysqli_result($conn, $query);  
 * getNextID($result, 'my_id', 'ID', 5) sẽ return "ID00016"
 */
function getNextID(mysqli_result $result, string $idName, string $idPrefix, int $numLength)
{
    $row = $result->fetch_assoc();
    $nextID = (int)filter_var($row[$idName], FILTER_SANITIZE_NUMBER_INT) + 1;
    $nextID = $idPrefix . str_pad($nextID, $numLength, '0', STR_PAD_LEFT);
    mysqli_free_result($result);
    return $nextID;
}

/**
 * Hiện ra hộp alert
 */
function phpAlert($msg)
{
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

/**
 * Lấy search query trên thanh url. Sử dụng để hỗ trợ tìm kiếm khi phân trang
 * @param array $queryData mảng key => value, với key là name của input, value là value của input
 * @example {1} $ten = "Nguyen Van A"; $diaChi = "123 ABC"  
 * $queryData = array('tenInput' => $ten, 'diaChiInput' => $diaChi)  
 * getSearchQuery ($queryData) sẽ trả về chuỗi:  
 * &tenInput=Nguyen+Van+A&diaChiInput=123+ABC
 */
function getSearchQuery(array $queryData){
    return "&" . http_build_query($queryData);
}
?>