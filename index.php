<!doctype html>

<h1>preg_replace test</h1>

<?php



function mrq_twituser($thing) {
    global $pretext;
    $from = '/(^|\s)@([a-z0-9_]+)/i';
    $to = '$1<a href="http://www.twitter.com/$2">@$2</a>';
    return preg_replace($from,$to,$thing);
}

echo mrq_twituser('@mrqwest');

?>