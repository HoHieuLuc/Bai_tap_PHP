<html>

<head>
    <title>Input data</title>
</head>

<body>
    <form action="" name="myform" method="post">
        First Name: <input type="text" name="Name[]" size=20 value="<?php if (isset($_POST['Name'])) echo $_POST['Name'][0]; ?>" /><br>
        Last Name: <input type="text" name="Name[]" size=20 value="<?php if (isset($_POST['Name'])) echo $_POST['Name'][1]; ?>" /><br>
        <input type="submit" value="Submit">
    </form>

    <?php
    if (isset($_POST['Name'])) {
        echo "Chào bạn " . $_POST['Name'][0] . " " . $_POST['Name'][1];
    }
    ?>
</body>

</html>