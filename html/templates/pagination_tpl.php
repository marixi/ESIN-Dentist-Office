<?php
    /* Section to introduce pagination */
    function addPastPagination() { ?>
        <div id="pagination">
            <?php if ($_SESSION['past_page'] > 1) { ?>
                <a href="?past_page=<?php echo $_SESSION['past_page']-1 ?>&future_page=<?php echo $_SESSION['future_page'] ?>"> &lt; </a>
            <?php }
            echo $_SESSION['past_page']; ?>
            <?php if ($_SESSION['past_page'] < $_SESSION['max_past']) { ?>
                <a href="?past_page=<?php echo $_SESSION['past_page']+1 ?>&future_page=<?php echo $_SESSION['future_page'] ?>"> &gt; </a>
                <?php } ?>
        </div>
    <?php }

    function addFuturePagination() { ?>
        <div id="pagination">
            <?php if ($_SESSION['future_page'] > 1) { ?>
                <a href="?past_page=<?php echo $_SESSION['past_page'] ?>&future_page=<?php echo $_SESSION['future_page']-1 ?>"> &lt; </a>
            <?php }
            echo $_SESSION['future_page']; ?>
            <?php if ($_SESSION['future_page'] < $_SESSION['max_future']) { ?>
                <a href="?past_page=<?php echo $_SESSION['past_page'] ?>&future_page=<?php echo $_SESSION['future_page']+1 ?>"> &gt; </a>
                <?php } ?>
        </div>
    <?php }
?>
        