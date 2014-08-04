<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>PhpFiddle Initial Code</title>

<script type="text/javascript">
	
</script>

<style type="text/css">
	
</style>

</head>

<body>
<?php

function mrq_twituser($thing) {
    global $pretext;
    $from = '/(^|\s)@([a-z0-9_]+)/i';
    $to = '$1<a href="http://www.twitter.com/$2">@$2</a>';
    return preg_replace($from,$to,$thing);
}

?>
	
<?php
$contents = "";
$contents .= "<div class='content'>";
$contents .= "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse a risus eget nunc ultricies convallis. Curabitur quis tortor molestie, vestibulum neque ut, sollicitudin leo. Fusce gravida tempus elit, sed aliquet orci consectetur id. Vestibulum non diam accumsan, dignissim sem ut, eleifend nunc. Mauris cursus, lacus sed pretium dignissim, metus erat aliquam arcu, a blandit lectus arcu ac risus. Ut sed accumsan nisi. Aenean volutpat augue in pretium placerat. Cras semper arcu non euismod porttitor. Vivamus malesuada, lectus quis dignissim aliquet, dolor arcu lacinia ipsum, id eleifend tortor augue sit amet enim. Nulla tincidunt ornare ipsum ac imperdiet. Sed eget augue sed erat pulvinar blandit in ut nisl.</p>";

$contents .= "<p>Morbi eget aliquam metus. Vestibulum euismod turpis eu lacus auctor, a consectetur sapien mollis. Aenean nec tortor imperdiet, malesuada lacus condimentum, lobortis dui. Duis vel @mrqwest vulputate mi. Phasellus mattis ante sit amet metus interdum, eget congue lacus tincidunt. Curabitur ut dapibus enim, non sagittis ipsum. Sed sollicitudin velit sed nibh rutrum rutrum.</p>";

$contents .="<p>Proin vel leo rutrum, pellentesque orci eu, ornare metus. Vestibulum quis mi ligula. In ornare, quam ut euismod scelerisque, augue metus vehicula velit, ut ultrices ligula tortor et quam. Suspendisse luctus quis felis venenatis dapibus. Ut at ullamcorper ipsum. Vestibulum pharetra pulvinar mi. Nulla pharetra eros nec @crcreatives neque ultrices aliquam. Duis sed lorem neque. Praesent suscipit elementum lacinia. Sed vel lectus nec orci scelerisque ornare non id velit. Maecenas sit amet suscipit dui. Aliquam malesuada elit a libero aliquam ullamcorper. Vivamus placerat sollicitudin mauris at luctus. Mauris a fringilla ante. Aenean tortor neque, varius ac turpis hendrerit, blandit facilisis ipsum.</p>";

$contents .= "<p>Phasellus sit amet malesuada felis. Nulla facilisi. Nullam dictum tellus quis elit blandit tincidunt. Donec non tincidunt ligula. Pellentesque ut ipsum non velit imperdiet venenatis vel id erat. Donec vitae nisl a dolor vehicula ullamcorper. Vestibulum tempor, massa vitae hendrerit tempus, ipsum nisl bibendum eros, eu tempus tortor lacus ac elit. Mauris ante lorem, posuere ut lacus imperdiet, consequat rhoncus risus. In at lectus arcu. Nam eu eros nec leo imperdiet egestas. Nulla facilisis diam vitae ipsum eleifend porttitor. Cras at felis ut orci egestas sollicitudin id fermentum quam.</p>";

$contents .= "<p>Duis diam augue, aliquam tincidunt euismod ac, venenatis sit amet justo. Nullam eget nulla quis nisi placerat placerat. Morbi et augue eget nunc blandit ultricies ut ac nulla. Vestibulum mollis leo in leo viverra, quis blandit purus blandit. In hac habitasse platea dictumst. Donec feugiat lorem varius, viverra nulla ultrices, volutpat magna. Donec adipiscing rutrum posuere. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam et lacus non ante ullamcorper tristique nec nec enim. Sed eu dapibus massa.</p>";
$contents .= "</div>"; ?>
	
	<?php echo mrq_twituser($contents); ?>

</body>
</html>

