<?php

$plugin['name'] = 'mrq_twituser';

// 0 = Plugin help is in Textile format, no raw HTML allowed (default).
// 1 = Plugin help is in raw HTML.  Not recommended.
# $plugin['allow_html_help'] = 0;

$plugin['version'] = '0.0.4';
$plugin['author'] = 'MrQwest';
$plugin['author_uri'] = 'http://mrqwest.co.uk/';
$plugin['description'] = 'Replaces all apparant twitter usernames with links back to twitter.';

// Plugin types:
// 0 = regular plugin; loaded on the public web side only
// 1 = admin plugin; loaded on both the public and admin side
// 2 = library; loaded only when include_plugin() or require_plugin() is called
$plugin['type'] = 0; 

if (!defined('txpinterface'))
	@include_once('../zem_tpl.php');

if (0) {
?>
# --- BEGIN PLUGIN HELP ---

h1. mrq_twituser

; Summary
: Replaces all apparant twitter usernames with links back to twitter.
; Version
: 0.0.4 (4th Aug 2014)

# --- END PLUGIN HELP ---


<?php
}

# --- BEGIN PLUGIN CODE ---

/**
 * This is mrq_twituser: A plugin for Textpattern
 * version 0.0.4
 * by MrQwest, adapted from pax_grep by John Stephens which is adapted from rah_replace by Jukka Svahn
 * http://mrqwest.co.uk/
 */

function mrq_twituser($thing) {
    global $pretext;
    $from = '/(^|\s)@([a-z0-9_]+)/i';
    $to = '$1<a href="http://www.twitter.com/$2">@$2</a>';
    return preg_replace($from,$to,$thing);
}

# --- END PLUGIN CODE ---

?>