<?php
/**
 * tạo ra 1 thẻ table chứa dữ liệu từ câu truy vấn
 * @param mysqli_result $result A result set identifier returned by mysqli_query(), mysqli_store_result() or mysqli_use_result().
 * @param array $tableHeaders là mảng chứa tên các cột (header) của table
 * @param array $tableData có hoặc không, là mảng có dạng 'tên cột trong dữ liệu' => 'định dạng'.  
 * Các định dạng hỗ trợ: image, bool, mặc định: hiển thị text
 * @example {1} $tableHeaders = array ('Ảnh', 'Giới tính', 'Tên')  
 * $tableData = array('anh' => 'image', 'gioi_tinh' => 'bool - Nam - Nữ', 'ten' => null)    
 * buildTable(results, tableHeaders, tableData);  
 * Lưu ý: Số tableHeaders phải bằng số tableData
 */
function buildTable(mysqli_result $results, array $tableHeaders, array $tableData = array(""))
{
    if (count($tableHeaders) == mysqli_num_fields($results) || count($tableHeaders) == count($tableData)) {
        if (mysqli_num_rows($results) > 0) { ?>
            <div class="table-wrapper">
                <table class="fl-table">
                    <thead>
                        <tr>
                            <?php
                            foreach ($tableHeaders as $header) {
                                echo "<th>$header</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
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
                                ?>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
<?php
            return 1;
        } else {
            echo "Không có dữ liệu";
            return 0;
        }
    } else {
        echo "Số header truyền vào phải bằng số cột dữ liệu";
        return 0;
    }
    mysqli_free_result($results);
}
?>