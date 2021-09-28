<html>

<head>
    <title>Input data</title>
</head>

<body>
    <form action="names.php" name="myform" method="post">
        First Name: <input type="text" name="Name[]" size=20 value="<?php if (isset($_POST['Name'])) echo $_POST['Name'][0]; ?>" /><br>
        Last Name: <input type="text" name="Name[]" size=20 value="<?php if (isset($_POST['Name'])) echo $_POST['Name'][1]; ?>" /><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>