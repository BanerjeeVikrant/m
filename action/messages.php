<?php include "../system/connect.php"; ?>
<?php
    $fromUser = $_GET['from'];
    $toId = $_GET['toid'];
    $sql = "SELECT * FROM users WHERE username = '$fromUser'";
    $results = $conn->query($sql);
    $rows = $results->num_rows;
    $row = $results->fetch_assoc();
    $fromId = $row['id'];
    //echo "<h1>$fromId -> $toId</h1>";
    
    $getNew = 0;
    if (isset( $_GET['getnew'])) {	
    	$getNew = $_GET['getnew'];
    }
    
    $sql = "SELECT * FROM users WHERE id = '$toId'";
    $toresults = $conn->query($sql);
    $torows = $toresults->num_rows;
    $torow = $toresults->fetch_assoc();
    $toPic = $torow['profile_pic'];
    
    $sql = "SELECT * FROM messages WHERE (((fromUser = $fromId AND toUser = $toId) OR (fromUser = $toId AND toUser = $fromId)) AND (id > $getNew)) ORDER BY id ASC";

    $results = $conn->query($sql);
    for($i=0; $i<$results->num_rows; $i++) {
        $row = $results->fetch_assoc();
        $message = $row['message'];
        $id = $row['id'];
        echo "<div class='each-message-wrapper'> ";
        if ($row['fromUser'] == $fromId) {
            echo "
            <div class='your-message-box'>
                    <div class='your-message'>$message</div>
            </div>";
        } else {
            echo "  

                <div class='their-message-box'>
                    <div class = 'toPic' style = 'background-image:url($toPic);'></div>
                        <div class='their-message'>$message</div>
                </div>
                ";
        }
        echo "</div>";
    }
    if ($results->num_rows > 0) {
    	echo "<div style = 'display: none;' class = 'last_text'>$id</div>";
    }
?>