<?php
require_once("db.php");
require_once("component.php");

$con = createdb();

if (isset($_POST['create'])) {
    createData();
}
if (isset($_POST['update'])) {
    updateData();
}
if (isset($_POST['delete'])) {
    deleteRecord();
}
if (isset($_POST['deleteall'])) {
    deleteAll();
}
function createData()
{
    $bookname = textboxValue("book_name");
    $bookpublisher = textboxValue("book_publisher");
    $bookprice = textboxValue("book_price");
    if ($bookname && $bookpublisher && $bookprice) {

        $sql = "INSERT INTO books (book_name, book_publisher, book_price)
                VALUES ('$bookname','$bookpublisher','$bookprice')";
        if (mysqli_query($GLOBALS['con'], $sql)) {
            textNode("success", "Record Inserted Successfully...");
        } else {
            textNode("error", "Failed to Insert Record...");
        }
    } else {
        textNode("error", "Provide Data in Textbox to Insert...");
    }
}
function textboxValue($value)
{
    $textbox = mysqli_real_escape_string($GLOBALS['con'], trim($_POST[$value]));
    if (empty($textbox)) {
        return false;
    } else {
        return $textbox;
    }
}
// message
function textNode($classname, $msg)
{
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}
//get data
function getData()
{
    $sql = "SELECT * FROM books";
    $result = mysqli_query($GLOBALS['con'], $sql);
    if (mysqli_num_rows($result) > 0) {
        return $result;
    }
}
//update data
function updateData()
{
    $bookid = textboxValue("book_id");
    $bookname = textboxValue("book_name");
    $bookpublisher = textboxValue("book_publisher");
    $bookprice = textboxValue("book_price");
    if ($bookname && $bookpublisher && $bookprice) {
        $sql = "UPDATE books SET book_name = '$bookname', book_publisher = '$bookpublisher', book_price = '$bookprice' WHERE id = '$bookid'";
        if (mysqli_query($GLOBALS['con'], $sql)) {
            textNode("success", "Record Updated Successfully...");
        } else {
            textNode("error", "Unable to Update...");
        }
    } else {
        textNode("error", "Select data using edit icon...");
    }
};
//delete record
function deleteRecord()
{
    $bookid = (int)textboxValue("book_id");
    $sql = "DELETE FROM books WHERE id = $bookid";
    if (mysqli_query($GLOBALS['con'], $sql)) {
        textNode("success", "Record Deleted Successfully ...");
    } else {
        textNode("error", "unable to delete record");
    }
};
//if database have more than three records create this button
function deleteBtn()
{
    $result = getData();
    $i = 0;
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $i++;
            if ($i > 3) {
                buttonElement("deleteall", "btn-delete", "btn btn-danger btn-sm", "<i class='fas fa-trash'></i> All", "data-toggle='tooltip' data-placement='bottom'title='Delete All'");
                return;
            }
        }
    }
};
//delete all
function deleteAll()
{
    $sql = "DROP TABLE books";
    if (mysqli_query($GLOBALS['con'], $sql)) {
        textNode("success", "All Deleted ...");
        createdb();
    } else {
        textNode("error", "something went wrong ...");
    }
};
//set ID to text box
function setId()
{
    $id = 0;
    $getid = getData();
    if ($getid) {
        while ($row = mysqli_fetch_assoc($getid)) {
            $id = $row['id'];
        }
    }
    return ($id + 1);
}
