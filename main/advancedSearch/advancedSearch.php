<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Search</title>
    <link rel="stylesheet" href="advancedsearch.css">
</head>
<body>
    
    <form method="post" action="../sortSearch/sortSearch.php">
        <h2>Advanced Search</h2>
        <label for="">Search by name : </label><br>
        <input type="text" name="searchbox" value=""><br>

        <label>Sort by : </label>
        <select name="category">
            <option value="0">Category</option>
            <option value="Mobile">Mobile</option>
            <option value="Laptop">Laptop</option>
            <option value="Monitor">Monitor</option>
        </select><br>

        <label>Sort by : </label>
        <label for="Name">Name</label>
        <input type="radio" name="sort" value="Name" checked>
        <label for="Price">Price</label>
        <input type="radio" name="sort" value="Price">
        <div class="submit"><input type="submit" name="searchbtn" value="Search"></div>
        <p class="already"> <a href="../sortSearch/sortSearch.php">Go Back</a></p>
    </form>

</body>
</html>