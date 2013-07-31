<?php

// This is a PLUGIN TEMPLATE.

// Copy this file to a new name like abc_myplugin.php.  Edit the code, then
// run this file at the command line to produce a plugin for distribution:
// $ php abc_myplugin.php > abc_myplugin-0.1.txt

// Plugin name is optional.  If unset, it will be extracted from the current
// file name. Uncomment and edit this line to override:
# $plugin['name'] = 'pax_grep';

// 0 = Plugin help is in Textile format, no raw HTML allowed (default).
// 1 = Plugin help is in raw HTML.  Not recommended.
# $plugin['allow_html_help'] = 1;

$plugin['version'] = '0.2.1';
$plugin['author'] = 'John Stephens';
$plugin['author_uri'] = 'http://designop.us/';
$plugin['description'] = 'Replace all occurrences of a regular expression with replacements.';

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

h1. pax_grep

; Summary
: Replace all occurrences of a regular expression with replacements.
; Version
: 0.2.1 (updated 26 Apr 2012)

h2. Table of contents

# "Overview":#help-section01
# "Installing and uninstalling":#help-section02
# "Usage and syntax":#help-section03
# "Attributes":#help-section04
## "from":#help-section05
## "to":#help-section06
## "delimiter":#help-section07
# "Examples":#help-section08
# "License":#help-section09
# "Author contact":#help-section10
# "Changelog":#help-section11

h2(#help-section01). Overview

This plugin allows you to _find occurrences of a "regular expression":http://en.wikipedia.org/wiki/Regular_expression pattern_ and _replace them with something else_. It's almost identical to it's awesome parent plugin "rah_replace by Jukka Svahn":http://rahforum.biz/plugins/rah_replace, but *pax_grep* uses PHP's "preg_replace()":http://fi.php.net/preg_replace function, packaged in a compact and easy-to-use Textpattern tag.

h2(#help-section02). Installing and uninstalling

In Textpattern, navigate to the "Plugins" tab under "Admin", and paste the code into the "Install plugin" pane. Install and enable the plugin.

To uninstall, simply delete the plugin from the "Plugins" tab.

h2(#help-section03). Usage and syntax

*pax_grep* takes a regular expression and searches content for matching patterns. Then it replaces matches with the string(s) you supply. This works just like "rah_replace":http://rahforum.biz/plugins/rah_replace, except it supports regular expression searches. If you don't need to search and replace based on a regular expression, *you should use rah_replace instead*.

*pax_grep* s a container tag with three attributes.

bc.. <txp:pax_grep ↩
    from="/search pattern/" ↩
    to="replacement text" ↩
    delimiter="|">
    Content
</txp:pax_grep>


h3(#help-section04). Attributes

h4(#help-section05). @from@ -- _Required_

Give this attribute the value of a pattern or patterns you wish to search for. A pattern should be *delimited with single quotes* or some other character not used in the pattern. Separate multiple patterns by commas (use the @delimiter@ attribute to specify and alternate separator).

; Default
: @from=""@
; Example
: @from="'^foo','bar$'"@

h4(#help-section06). @to@ -- _Required_

This attribute holds the replacement value(s) for each pattern in the @from@ attribute. No delimiters are needed, but *multiple values must be separated by commas (use the @delimiter@ attribute to specify and alternate separator)*. Each @from@ value will be replaced with the corresponding @to@ value.

; Default
: @to=""@
; Example
: @to="fox,bat"@

h4(#help-section07). @delimiter@ -- _Optional_

So you don't like using commas to separate your search patterns or replacement values? Sometimes, you need to use a comma in the search pattern, and you need a different separator to break search patterns and replacement values. Use this attribute to specify an alternate separator.

; Default
: @delimiter=","@
; Example
: @delimiter=" | "@

h2(#help-section08). Examples

h3. Example 1: Get words out of Textpattern's @request_uri@.

This example outputs the current request URI(Uniform Resource Identifier), and uses a regular expression to drop the leading slash and transform many delimiter characters into spaces. You might use code like this on a 404 error page to populate a search field with information from a mistyped URL.

bc.. <txp:pax_grep
    from="'^\/','\/','%20','\-','\+','\?=','\_'" ↩
    to=", , , , , , ">
    <txp:page_url type="request_uri"/>
</txp:pax_grep>

h3. Example 2: Strip Textile-generated @p@ elements from Textpattern's excerpt output

Sometimes you might want to show the excerpt of a Textpattern article without mucking around with a bunch of paragraph tags. Here's how.

bc.. <txp:pax_grep from="/<\/?p>/,/\t/" to="">
    <txp:excerpt/>
</txp:pax_grep>

h2(#help-section09). Licence

This plugin is licenced under "GPL, Version 2":http://textpattern.com/about/51/license.

h2(#help-section10). Author contact

John Stephens is known as "johnstephens" on the Textpattern support forum and on Twitter. You can reach me at "Design Opus":http://designop.us/ or find "@johnstephens":twitter on Twitter "here":twitter.

[twitter]http://twitter.com/johnstephens

h2(#help-section11). Changelog

; Version 0.2.1
: 2012-04-26: Expand and revise plugin help.
; Version 0.2
: 2010-10-01: Add an optional @delimiter@ attribute, so you can use commas in your search pattern. "Thanks, Jan":http://forum.textpattern.com/viewtopic.php?pid=235323#p235323.
; Version 0.1.1
: 2009-01-25: Change plugin name from *opus_grep* to *pax_grep* in compliance with de facto standard of three-letter prefix for plugins.
; Version 0.1
: 2009-01-23: Branch from "rah_replace":http://rahforum.biz/plugins/rah_replace by Jukka Svahn-- use @preg_replace()@ instead of @str_replace()@ to allow regex search patterns.

# --- END PLUGIN HELP ---
<?php
}

# --- BEGIN PLUGIN CODE ---

/**
 * This is pax_grep: A plugin for Textpattern
 * version 0.2.1
 * by John Stephens, adapted from rah_replace by Jukka Svahn
 * http://designop.us/
 */

function pax_grep($atts,$thing) {
    global $pretext;
    extract(lAtts(array(
        'from' => '',
        'to' => '',
        'delimiter' => ','
    ),$atts));
    $from = explode($delimiter,$from);
    $to = explode($delimiter,$to);
    $count = count($to);
    if($count == 1) $to = implode('',$to);
    if($count == 0) $to = '';
    return preg_replace($from,$to,parse($thing));
}

# --- END PLUGIN CODE ---

?>
