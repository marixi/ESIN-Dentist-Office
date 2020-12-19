    
    <!-- Section to introduce pagination -->
        <div id="pagination">
            <?php if ($_SESSION['page'] > 1) { ?>
                <a href="?page=<?php echo $_SESSION['page']-1 ?>"> &lt; </a>
            <?php }
            echo $_SESSION['page']; ?>
            <?php if ($_SESSION['page'] < $_SESSION['max_past']) { ?>
                <a href="?page=<?php echo $_SESSION['page']+1 ?>"> &gt; </a>
                <?php } ?>
        </div>