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
    
    if (! isset( $_GET['getold'])) {
        $sql = "SELECT * FROM messages WHERE (((fromUser = $fromId AND toUser = $toId) OR (fromUser = $toId AND toUser = $fromId)) AND (id > $getNew)) ORDER BY id DESC LIMIT 15";
    } else {
        $getOld = $_GET['getold'];
        $sql = "SELECT * FROM messages WHERE (((fromUser = $fromId AND toUser = $toId) OR (fromUser = $toId AND toUser = $fromId)) AND (id < $getOld)) ORDER BY id DESC LIMIT 5";
    }

    $results = $conn->query($sql);
    $htmlMsg = "";
    for($i=0; $i<$results->num_rows; $i++) {
        $row = $results->fetch_assoc();
        $message = $row['message'];
        $first_id = $row['id'];
        if ($i == 0) {
            $id = $row['id'];
        }
        $newHtmlMsg = "<div class='each-message-wrapper'> ";
        if ($row['fromUser'] == $fromId) {
            $newHtmlMsg .= "
            <div class='your-message-box'>
                    <div class='your-message'>$message</div>
            </div>";
        } else {
            $newHtmlMsg .= "  

                <div class='their-message-box'>
                    <div class = 'toPic' style = 'background-image:url($toPic);'></div>
                        <div class='their-message'>$message</div>
                </div>
                ";
        }
        $newHtmlMsg .= "</div>";
        $htmlMsg = $newHtmlMsg . $htmlMsg;
    }
    if (isset( $_GET['getold']) || $getNew == 0) {
        if ($results->num_rows == 0) { $first_id = 0; }
        echo "<div style = 'display: none;' class = 'first_text'>$first_id</div>";
    }
    if ($results->num_rows > 0) {
        echo $htmlMsg;
        if (!isset( $_GET['getold'])) {
            echo "<div style = 'display: none;' class = 'last_text'>$id</div>";
        }
    }
?>