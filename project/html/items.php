<html>
<head>
<style>
ul.products li {
    width: 200px;
    display: inline-block;
    vertical-align: top;
    *display: inline;
    *zoom: 1;
}
</style>
</head>
<body>


<?php

if (!$link = mysql_connect('localhost', 'alkhate_db', 'PASSWORD')) {
    echo 'Could not connect to mysql';
    exit;
}
if (!mysql_select_db('alkhate_db', $link)) {
    echo 'Could not select database';
    exit;
}

$sql    = 'SELECT * FROM items';

$result = mysql_query($sql, $link);

if (!$result) {
    echo "DB Error, could not query the database\n";
    echo 'MySQL Error: ' . mfnameysql_error();
    exit;
}
echo '<ul class="products">';
while ($rs = mysql_fetch_assoc($result)) {

?>   <a href="#<?php echo $rs["item_id"]?>">
           <img src="data:image/jpeg;base64,<?php echo base64_encode( $rs["item_pic"]); ?> ">
            <h4> <?php echo $rs["item_desc"] ?></h4>
            
        </a>
<?php
}


echo '</ul>';
?>
</body>