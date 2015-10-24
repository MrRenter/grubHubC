<?php
    include('include/header.php');
    include('include/navbar.php');
?>

<script type="text/javascript">
    function validateSearch(){
        if (document.forms['searchForm']['searchFor'].value == "") {
            return false;
        }
        return true;
    }
</script>

<div class="container">
    <div class="jumbotron">
        <h1 align="center">Satisfy your hunger</h1>
        <br><br>

        <div class="row">
            <form name="searchForm" action="search.php" onsubmit="return validateSearch()" method="get">
            <div class="col-lg-12">
                <div class="input-group input-group-lg">

                        <input type="text" class="form-control input-lg" name="searchFor" id="searchFor" placeholder="Find a meal">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-lg btn-default">Search</button>
                        </span>
                </div>
            </div>
                </form>
        </div>

    </div>
</div>

<?php
    include('include/footer.php');
?>
