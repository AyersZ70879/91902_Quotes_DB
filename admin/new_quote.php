<?php

// check user is logged in... 
if (isset($_SESSION['admin'])) {

    // get authors from database 
    $all_authors_sql = "SELECT * FROM `author` ORDER BY `Last` ASC ";
    $all_authors_query = mysqli_query($dbconnect, $all_authors_sql);
    $all_authors_rs = mysqli_fetch_assoc($all_authors_query);

    // initialise author form
    $first = "";
    $middle = "";
    $last = "";


} // end user logged in if

else {

    $login_error = 'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");

} // end user not logged in else

?>
<h1>Add a Quote</h1>
<p><i>
    Too add a quote, first select the author, then press the 'next' button. If the author is
    not in the list, please choose the 'New Author' option. To quickly find an author, click
    in the box below and start typing their <b>first</b> name. 
</i></p>

<form method="post" enctype="multipart/form-data" action="action=<?php 
echo htmlspecialchars($_SERVER["PHP_SELF"]."?page=../admin/new_quote");?>">

    <div>
        <b>Quote Author:</b> &nbsp;

        <select>
            <!-- Default option is new author -->
            <option value="unknown" selected>New Author</option>

            <?php
            do {

                // get authors full name (last, then first)
                $author_full = $all_authors_rs['First']."
                ".$all_authors_rs['Last']." ".$all_authors_rs['Middle'];

            ?>

            <option value="<?php echo $all_authors_rs['Author_ID']; ?>">
                <?php echo $author_full; ?>
            </option>

            <?php


            } // end of author options 'do'

            while($all_authors_rs=mysqli_fetch_assoc($all_authors_query))

            ?>

        </select>

            &nbsp;

        <input class="short" type="submit" name="quote_author" value="Next..." />

    </div>

</form>

&nbsp;
