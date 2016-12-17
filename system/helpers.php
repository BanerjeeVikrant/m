<?php
function time_elapsed_string($datetime, $full = false) {
    $datetime = "@$datetime";
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
if (isset($_GET['t'])) {
    echo time_elapsed_string($_GET['t']);
}

function reportType($num){
    if($num == '1'){
        return "Sexual Explicit";
    }
    else if($num == '2'){
        return "Related to Abusive Materials";
    }
    else if($num == '3'){
        return "Inappropriate";
    }
    else if($num == '4'){
        return "Harassment";
    }
    else if($num == '5'){
        return "Threatning";
    }
    else if($num == '6'){
        return "Rude";
    }
    else if($num == '7'){
        return "Bulling nature";
    }
    else if($num == '8'){
        return "Not interesting";
    }
    else if($num == '9'){
        return "Embarrassing";
    }
    else if($num == '10'){
        return "Hateful";
    }
}
?>