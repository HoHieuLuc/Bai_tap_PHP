<?php
// render ra 1 table cơ bản chứa dữ liệu từ câu truy vấn
// bảng này chỉ có thể hiển thị dữ liệu dạng text
// tạo 1 table từ results, header (<th>) của table là 1 mảng gồm các chuỗi
// số table headers phải bằng số cột mà câu truy vấn trả về
// hoặc phải bằng số cột chọn ra ở mảng $tableData
// $tableHeaders = array('cột 1', 'cột 2',...);
// câu truy vấn có thể trả về nhiều cột, để chọn ra các cột trong câu truy vấn
// thì sử dụng $tableData
// $tableData = array('col1', 'col2', ...);
function buildTable($results, $tableHeaders, $tableData = array(""))
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
                                    foreach ($tableData as $tenCot) {
                                        echo "<td>".$row[$tenCot]."</td>";
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
        } else {
            echo "Không có dữ liệu";
        }
    } else {
        echo "Số header truyền vào phải bằng số cột dữ liệu";
    }
    mysqli_free_result($results);
}
?>