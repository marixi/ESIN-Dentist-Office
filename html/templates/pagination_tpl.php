<?php
    /* Section to insert pagination */
    function addPastPagination() { ?>
        <div id="pagination">
            <?php if ($_SESSION['past_page'] > 1) { ?>
                <a href="?past_page=<?php echo 1 ?>&future_page=<?php echo $_SESSION['future_page'] ?>"> <i class="fa fa-angle-double-left"></i> </a>
                <a class="arrows" href="?past_page=<?php echo $_SESSION['past_page']-1 ?>&future_page=<?php echo $_SESSION['future_page'] ?>"> <i class="fa fa-angle-left"></i> </a>
            <?php } ?>

            <?php echo $_SESSION['past_page']; ?>

            <?php if ($_SESSION['past_page'] < $_SESSION['max_past']) { ?>
                 <a class="arrows" href="?past_page=<?php echo $_SESSION['past_page']+1 ?>&future_page=<?php echo $_SESSION['future_page'] ?>"> <i class="fa fa-angle-right"></i> </a> <!-- &#x21E8; -->
                <a  href="?past_page=<?php echo $_SESSION['max_past'] ?>&future_page=<?php echo $_SESSION['future_page'] ?>"> <i class="fa fa-angle-double-right"></i> </a>
                 <?php } ?>
        </div>
    <?php }

    function addFuturePagination() { ?>
        <div id="pagination">
            <?php if ($_SESSION['future_page'] > 1) { ?>
                <a class="arrows" href="?past_page=<?php echo $_SESSION['past_page'] ?>&future_page=<?php echo 1 ?>"> <i class="fa fa-angle-double-left"></i> </a>
                <a class="arrows" href="?past_page=<?php echo $_SESSION['past_page'] ?>&future_page=<?php echo $_SESSION['future_page']-1 ?>"> <i class="fa fa-angle-left"></i> </a>
            <?php }
            echo $_SESSION['future_page']; ?>
            <?php if ($_SESSION['future_page'] < $_SESSION['max_future']) { ?>
                <a class="arrows" href="?past_page=<?php echo $_SESSION['past_page'] ?>&future_page=<?php echo $_SESSION['future_page']+1 ?>"> <i class="fa fa-angle-right"></i> </a>
                <a class="arrows" href="?past_page=<?php echo $_SESSION['past_page'] ?>&future_page=<?php echo $_SESSION['max_future'] ?>"> <i class="fa fa-angle-double-right"></i> </a>
                <?php } ?>
        </div>
    <?php }
?>
        