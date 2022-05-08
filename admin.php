<?php
require_once 'partials/head.php';
require_once 'partials/header.php';
include_once 'partials/nav.php';
require_once 'DB/query.php';
require_once 'functions/functions.php';
require_once 'DB/Database.php';
$database=new Database();
$db=$database->connection();
$query=new Query($db);
global $query;
if($_SESSION['role']=='admin'){

if(isset($_POST['dodajKategoriju'])){
    $naziv=$_POST['naziv'];
    $query->insertCategory($naziv);
        if(!$query){
            echo "Erorr";
        }
    }
?>

<button><a href="add-product.php">Dodaj proizvod</a></button>
<button><a href="add-category.php">Dodaj kategoriju</a></button>

<table>
    <tr>
        <th>ID</th>
        <th>Status</th>
        <th>Naziv</th>
        <th>Kategorija</th>
        <th>Utiskivac</th>
      
        <th>Slika</th>
        <th>Hash tag</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>
    <tbody>
        <?php
   
        $exe=$query->getAllProducts();
    while ($row=$exe->fetch(PDO::FETCH_ASSOC)) {
        $id=$row['id'];
        global $id;
        ?>
        <tr>
        <td><?php echo $id; ?></td>
        <td><?php echo $row['status'] ?></td>
        <td><?php echo $row['naziv'] ?></td>
        <td><?php echo $row['kategorija_id'] ?></td>
        <td><?php echo $row['utiskivac'] ?></td>
        
        <td><a href="product.php?product=<?php echo $row['id'] ?>"> <img src="images/modle/<?php echo $row['slika'] ?>"></a></td>
        <td><?php echo $row['hashtag'] ?></td>
        <td><a href="update-product.php?update=<?php echo $row['id'] ?>">Update</a> </td>
        <td><a href="admin.php?delete=<?php echo $row['id']?>">Delete</a></td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>


<?php

if(isset($_GET['update'])){
    include_once 'update-product.php';
 }else if (isset($_GET['delete'])) {
     $id=$_GET['delete'];
         $query->deleteProduct($id);
         header("Refresh:0; url=admin.php");
 
 }
}else {
    header("Location:index.php");
}
 ?>