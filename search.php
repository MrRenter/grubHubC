<?php
    if (empty($_GET['searchFor'])){
        header("Location: /");
        exit();
    } else {
        include('include/header.php');
        include('include/navbar.php');
    }
?>

<h1 align="center">We found 0 results for <?php echo($_GET['searchFor']); ?></h1>
<?php
  include('include/footer.php');
?>