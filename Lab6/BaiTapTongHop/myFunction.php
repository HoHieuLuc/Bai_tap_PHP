<?php

/**
 * Tạo ra 1 thẻ table chứa dữ liệu từ câu truy vấn  
 * TODO: viết thêm chú thích
 * @param mysqli_result $result A result set identifier returned by mysqli_query(), mysqli_store_result() or mysqli_use_result().
 * @param string $editPath đường dẫn tới trang Edit
 * @param array $tableHeaders là mảng chứa tên các cột (header) của table
 * @param array $tableData có hoặc không, là mảng có dạng 'tên cột trong dữ liệu' => 'định dạng'.  
 * Các định dạng hỗ trợ: image, bool, mặc định: hiển thị text
 * @example {1} $tableHeaders = array ('Mã', 'Ảnh', 'Giới tính', 'Tên')  
 * $tableData = array('ma' => null, 'anh' => 'image', 'gioi_tinh' => 'bool - Nam - Nữ', 'ten' => null)    
 * buildTable(result, "EditPage.php", "DeletePage.php", tableHeaders, tableData, "ma");  
 * Lưu ý: Số tableHeaders phải bằng số tableData
 */
function buildTable(mysqli_result $result, string $editPath = "", string $deletePath = "", array $tableHeaders, array $tableData = array(""), string $id1 = "", string $id2 = "")
{
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
                                                echo "<img src ='images/" . $row[$tenCot] . "' alt='ảnh' class='small-rounded-img'";
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
 * todo
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

function getNextID(mysqli_result $result, string $idName, string $idPrefix, int $numLength)
{
    $row = $result->fetch_assoc();
    $nextID = (int)filter_var($row[$idName], FILTER_SANITIZE_NUMBER_INT) + 1;
    $nextID = $idPrefix . str_pad($nextID, $numLength, '0', STR_PAD_LEFT);
    mysqli_free_result($result);
    return $nextID;
}

?>