<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Update a Record - PHP CRUD Tutorial</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

</head>

<body>

    <!-- container -->
    <div class="container">

        <div class="page-header">
            <h1>Update Product</h1>
        </div>

        <!-- PHP read record by ID will be here -->

        <?php
        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

        //include database connection
        include 'config/database.php';

        // read current record's data
        try {
            // prepare select query
            $query = "SELECT id, name, description, price, image FROM products WHERE id = ? LIMIT 0,1";
            $stmt = $con->prepare($query);

            // this is the first question mark
            $stmt->bindParam(1, $id);

            // execute our query
            $stmt->execute();

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $image = $row['image'];
        }

        // show error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
        ?>

        <!-- HTML form to update record will be here -->

        <!-- PHP post to update record will be here -->

        <!--we have our html form here where new record information can be updated-->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id={$id}"; ?>" method="post" enctype="multipart/form-data">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Name</td>
                    <td><input type='text' name='name' value="<?php echo htmlspecialchars($name, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name='description' class='form-control'><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type='text' name='price' value="<?php echo htmlspecialchars($price, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td>
                        <?php echo $image ? "<img src='uploads/{$image}' style='width:300px;' />" : "No image found.";  ?>
                    </td>
                </tr>
                <tr>
                    <td>Update your image</td>
                    <td><input type="file" name="image" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' class='btn btn-primary' />
                        <a href='index.php' class='btn btn-danger'>Back to read products</a>
                    </td>
                </tr>
            </table>
        </form>

        <?php

        // check if form was submitted
        if ($_POST) {

            try {

                // write update query
                // in this case, it seemed like we have so many fields to pass and 
                // it is better to label them and not use question marks
                $query = "UPDATE products
                SET name=:name, description=:description,
                    price=:price, image=:image, created=:created
                    WHERE id =:id";

                // prepare query for execution
                $stmt = $con->prepare($query);

                $name = htmlspecialchars(strip_tags($_POST['name']));
                $description = htmlspecialchars(strip_tags($_POST['description']));
                $price = htmlspecialchars(strip_tags($_POST['price']));

                // new 'image' field
                $image = !empty($_FILES["image"]["name"])
                    ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"])
                    : "";
                $image = htmlspecialchars(strip_tags($image));

                // bind the parameters
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':image', $image);

                // specify when this record was inserted to the database
                $created = date('Y-m-d H:i:s');
                $stmt->bindParam(':created', $created);
                // Execute the query
                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Record was updated.</div>";
                    // now, if image is not empty, try to upload the image
                    if ($image) {

                        // sha1_file() function is used to make a unique file name
                        $target_directory = "uploads/";
                        $target_file = $target_directory . $image;
                        $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

                        // error message is empty
                        $file_upload_error_messages = "";
                        // make sure that file is a real image
                        $check = getimagesize($_FILES["image"]["tmp_name"]);
                        // make sure certain file types are allowed
                        $allowed_file_types = array("jpg", "jpeg", "png", "gif");
                        if (!in_array($file_type, $allowed_file_types)) {
                            $file_upload_error_messages .= "<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
                        }
                        // make sure file does not exist
                        if (file_exists($target_file)) {
                            $file_upload_error_messages .= "<div>Image already exists. Try to change file name.</div>";
                        }
                        // make sure submitted file is not too large, can't be larger than 1 MB
                        if ($_FILES['image']['size'] > (1024000)) {
                            $file_upload_error_messages .= "<div>Image must be less than 1 MB in size.</div>";
                        }
                        // make sure the 'uploads' folder exists
                        // if not, create it
                        if (!is_dir($target_directory)) {
                            mkdir($target_directory, 0777, true);
                        }
                        // if $file_upload_error_messages is still empty
                        if (empty($file_upload_error_messages)) {
                            // it means there are no errors, so try to upload the file
                            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                                // it means photo was uploaded
                            } else {
                                echo "<div class='alert alert-danger'>";
                                echo "<div>Unable to upload photo.</div>";
                                echo "<div>Update the record to upload photo.</div>";
                                echo "</div>";
                            }
                        }

                        // if $file_upload_error_messages is NOT empty
                        else {
                            // it means there are some errors, so show them to user
                            echo "<div class='alert alert-danger'>";
                            echo "<div>{$file_upload_error_messages}</div>";
                            echo "<div>Update the record to upload photo.</div>";
                            echo "</div>";
                        }
                        if ($check !== false) {
                            // submitted file is an image
                        } else {
                            $file_upload_error_messages .= "<div>Submitted file is not an image.</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
                    }
                }
            }

            // show errors
            catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>

    </div> <!-- end .container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

</html>