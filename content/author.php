<?php

if(!isset($_REQUEST['authorID']))
{
    header('Location: index.php');
}

$author_to_find = $_REQUEST['authorID'];

$find_sql = "SELECT * FROM `quotes`
JOIN author ON (`author`.`Author_ID` = `quotes`.`Author_ID`) WHERE `quotes`.`Author_ID` = $author_to_find
";
$find_query = mysqli_query($dbconnect, $find_sql);
$find_rs = mysqli_fetch_assoc($find_query);

// get author name to display
include("get_author.php");

?>
<br />
<div class="about">
    <h2>
    <?php echo $full_name ?> - About
    </h2>

    <p><b>Born:</b> <?php echo $find_rs['Born']; ?> </p>

</div> <!-- / about author div -->

<br />

<?php

// Loop through results and display them...
do {

    $quote = preg_replace('/[^A-Za-z0-9.,?\s\'\-]/', ' ', $find_rs['Quote']);

    

    ?>
<div class="results">
    <p>
        <?php echo $quote; ?> <br />
        
    </p>

    <!-- get subject tags to display -->
   <?php include("show_subjects.php"); ?>
    
</div>
<br />

<?php
} // end of display results 'do'

while($find_rs = mysqli_fetch_assoc($find_query));
?>