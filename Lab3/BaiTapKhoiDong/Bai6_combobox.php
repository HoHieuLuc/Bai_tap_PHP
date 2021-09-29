<html>

<body>
    <form action="" method="post">
        <select name="lunch">
            <option value="pork" <?php if (isset($_POST['lunch']) && $_POST['lunch'] == 'pork') echo 'selected'; ?>>
                BBQ Pork Bun
            </option>
            <option value="chicken" <?php if (isset($_POST['lunch']) && $_POST['lunch'] == 'chicken') echo 'selected'; ?>>
                Chicken Bun
            </option>
            <option value="lotus" <?php if (isset($_POST['lunch']) && $_POST['lunch'] == 'lotus') echo 'selected'; ?>>
                Lotus Seed Bun
            </option>
        </select>
        <input type="submit" name="submit" value="Submit your order">
    </form>
    Selected buns:<br />
    <?php
    if (isset($_POST['lunch'])) {
        print 'You want a ' . $_POST["lunch"] . ' bun. <br/>';
    }
    ?>
</body>

</html>