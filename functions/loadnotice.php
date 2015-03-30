<?php
$load = intval($_GET['load']);
$loadperTime = 10;

$result = mysql_query("SELECT * FROM noticeboard ORDER BY TIME DESC LIMIT $load,$loadperTime");

while ($row=mysql_fetch_row($result)){
    $output=array(
        'id'        =>$row[0],
        'title'     =>$row[1],
        'content'   =>$row[2],
        'time'      =>$row[3],
        'imageid'   =>($row[4] ? "uploads/".$row[4] : null),
    );
    
    echo "notice.push(".json_encode($output).");";
}
?>