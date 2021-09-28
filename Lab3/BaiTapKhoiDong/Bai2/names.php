<?php
if (isset($_POST['Name'])) {
    echo "Chào bạn " . $_POST['Name'][0] . " " . $_POST['Name'][1];
}
?>