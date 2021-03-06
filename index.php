<?php
require_once("../crud/php/component.php");
require_once("../crud/php/operation.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
    <script src="https://kit.fontawesome.com/948d2d6993.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <main>
        <div class="container text-center">
            <h1 class="py-4 bg-dark text-light rounded"><i class="fas fa-swatchbook"></i> Book Store</h1>
            <div class="d-flex justify-content-center">
                <form action="" method="post" class="w-50">
                    <div class="pt-2">
                        <?php inputElement("<i class='fas fa-id-badge'></i>", "ID", "book_id", setID()) ?>
                    </div>
                    <div class="pt-2">
                        <?php inputElement("<i class='fas fa-book'></i>", "Book Name", "book_name", "") ?>
                    </div>
                    <div class="row pt-2">
                        <div class="col">
                            <?php inputElement("<i class='fas fa-people-carry'></i>", "Publisher", "book_publisher", "") ?>
                        </div>
                        <div class="col">
                            <?php inputElement("<i class='fas fa-dollar-sign'></i>", "Price", "book_price", "") ?>
                        </div>
                    </div>
                    <div class="d-flex pt-2 justify-content-center">
                        <?php buttonElement("create", "btn-create", "btn btn-success btn-sm", "<i class='fas fa-plus'></i>", "data-toggle='tooltip' data-placement='bottom'title='Create'") ?>
                        <?php buttonElement("read", "btn-read", "btn btn-primary btn-sm", "<i class='fas fa-sync'></i>", "data-toggle='tooltip' data-placement='bottom'title='Read'") ?>
                        <?php buttonElement("update", "btn-update", "btn btn-light border btn-sm", "<i class='fas fa-pen-alt'></i>", "data-toggle='tooltip' data-placement='bottom'title='Update'") ?>
                        <?php buttonElement("delete", "btn-delete", "btn btn-danger btn-sm", "<i class='fas fa-trash-alt'></i>", "data-toggle='tooltip' data-placement='bottom'title='Delete'") ?>
                        <?php deleteBtn(); ?>
                    </div>
                </form>
            </div>
            <!-- bootstrab table -->
            <div class="d-flex table-data w-75">
                <table class="table table-stripped table-dark">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Book Name</th>
                            <th>Publisher</th>
                            <th>Price</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php
                        if (isset($_POST['read'])) {
                            $result = getData();
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td data-id="<?php echo $row['id']; ?>"><?php echo $row['id']; ?></td>
                                        <td data-id="<?php echo $row['id']; ?>"><?php echo $row['book_name']; ?></td>
                                        <td data-id="<?php echo $row['id']; ?>"><?php echo $row['book_publisher']; ?></td>
                                        <td data-id="<?php echo $row['id']; ?>"><?php echo '$' . $row['book_price']; ?></td>
                                        <td> <i class="fas fa-edit btn-edit" data-id="<?php echo $row['id']; ?>"></i> </td>
                                    </tr>
                        <?php
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../crud/php/main.js"></script>

</body>

</html>