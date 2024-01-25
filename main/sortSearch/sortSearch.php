<?php
include '../init.php';
if (!$_SESSION['user']) {
    header("Location: ../login/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="sortSearch.css">
</head>


<body>
    
    <nav>
        <div class="home">
            <p><a href="../../watIndex.php">HOME</a><span><?php echo "Welcome ". $_SESSION['user'] ?></span></p>
        </div>
        <div class="sortsearch">
            <form method="post" action="">

                <select name="category">
                    <option value="0">Category</option>
                    <option value="Mobile" <?php if (isset($_POST['category']) && $_POST['category'] == "Mobile") {echo 'selected';} ?>>Mobile</option>
                    <option value="Laptop" <?php if (isset($_POST['category']) && $_POST['category'] == "Laptop") {echo 'selected';} ?>>Laptop</option>
                    <option value="Monitor" <?php if (isset($_POST['category']) && $_POST['category'] == "Monitor") {echo 'selected';} ?>>Monitor</option>
                </select>

                <select name="sort">
                    <option value="0">Sort by</option>
                    <option value="Name" <?php if (isset($_POST['sort']) && $_POST['sort'] == "Name") {echo 'selected';} ?>>Name
                    </option>
                    <option value="Price" <?php if (isset($_POST['sort']) && $_POST['sort'] == "Price") {echo 'selected';} ?>>Price
                    </option>
                </select>

                 <input type="text" name="searchbox" class="searchbox" placeholder="Search by name..." value="<?php echo isset($_POST['searchbox']) ? $_POST['searchbox'] : ''; ?>">
                <input type="submit" class="search-btn" name="searchbtn" value="Search">
                <a href="../advancedSearch/advancedSearch.php"><input type="button" class="advanced-btn" name="advanced_search" value="Advanced Search"></input></a>
                <a href="logout.php"><input type="button" class="logout-btn" name="logout" value="LOGOUT"></input></a>
            </form>
        </div>
    </nav>


    <?php

        if(isset($_POST['searchbtn'])){
            $search_text = $_POST['searchbox'];
            $category = $_POST['category'];
            $sort = $_POST['sort'];

            if(!empty($search_text)){
                if($category==0){
                    $query = "SELECT * FROM productinfo WHERE Name like '%$search_text%'";
                    if($sort!=0){
                        $query = "SELECT * FROM productinfo WHERE Name like '%$search_text%' ORDER BY $sort";
                    }
                }
                else{
                    $query = "SELECT * FROM productinfo WHERE Name like '%$search_text%' AND Category='$category'";
                    if ($sort != 0) {
                        $query = "SELECT * FROM productinfo WHERE Name like '%$search_text%' AND Category='$category' ORDER BY $sort";
                    }
                }
            }
            else if(empty($search_text)){
                if($category==0){
                    echo "<p class='error'>Enter a name or select a category to search a specific product.</p>";
                    $query = "SELECT * FROM productinfo";
                    if ($sort != 0) {
                        $query = "SELECT * FROM productinfo ORDER BY $sort";
                    }
                }
                else{
                    $query = "SELECT * FROM productinfo WHERE Category='$category'";
                    if ($sort != 0) {
                        $query = "SELECT * FROM productinfo WHERE Category='$category' ORDER BY $sort";
                    }
                }
            }


            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
            echo "<div class = 'product-container'>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class = 'product'>";
                echo "<div class = 'image-container'>";
                echo "<img src='./images/" . $row['Image'] . "'>";
                echo "</div>";
                echo "<div class = 'text-container'>";
                echo "Name : " . $row['Name'] . "<br>" . "<br>";
                echo "Price : " . $row['Price'] . "<br>" . "<br>";
                echo "Category : " . $row['Category'] . "<br>" . "<br>";
                echo "</div>";
                echo "</div>";
            }
             echo "</div>";        
        } 
        else {

            $query = "SELECT * FROM productinfo";
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

            echo "<div class='product-container'>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='product'>";
                echo "<div class='image-container'>";
                echo "<img src='./images/" . $row['Image'] . "'>";
                echo "</div>";
                echo "<div class='text-container'>";
                echo "Name : " . $row['Name'] . "<br><br>";
                echo "Price : " . $row['Price'] . "<br><br>";
                echo "Category : " . $row['Category'] . "<br><br>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        }
    ?>

</body>
</html>