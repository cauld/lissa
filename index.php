<?PHP
require 'includes/lissa/class.lissa.php';

//Create a custom module metadata set
$customModules = array(
    "customJS" => array(
        "name" => 'customJS',
        "type" => 'js', // 'js' or 'css'
        "fullpath" => 'includes/js/example.js',
        "requires" => array("event", "dom", "json")
    ),
    "sampleData" => array(
        "name" => 'sampleData',
        "type" => 'js', // 'js' or 'css'
        "fullpath" => 'includes/js/sample_data.js',
        "requires" => array("customJS")
    ),
    "customCSS" => array(
        "name" => 'customCSS',
        "type" => 'css',
        "fullpath" => 'includes/css/example.css'
    )
);

//Get a new Lissa instance which includes our custom metadata along with the base YUI metadata
$loader = new Lissa("2.8.0r4", null, $customModules);
$loader->load("fonts", "sampleData", "customCSS");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>YUI PHP Loader + Minify: Keep the combo!</title>
	<?PHP echo $loader->css(); ?>
</head>
<body>
    <h1>Lissa</h1>
    <h2>YUI PHP Loader + Minify: Keep the combo!</h2>
    
    <p><a href="http://developer.yahoo.com/yui/phploader/">The YUI PHP Loader Utility</a> is designed, of course, to 
    help you put YUI components on the page.  While the YUI PHP Loader is great at loading YUI resources it is important 
    to point out that it can also be a great resource for loading custom non-YUI JavaScript and CSS resources on the page 
    as well.  These can be mixed in with YUI dependencies and/or be all custom modules.</p>
    
    <p>This example shows you how to create a set of custom (non-YUI) modules that have YUI component dependencies and 
    load them via YUI PHP Loader.</p>
    
    <p>For this example we will load some local JSON data and a custom CSS module via the 
    <a href="http://developer.yahoo.com/yui/phploader/">YUI PHP Loader Utility</a>.  The custom JavaScript module, <em>customJS</em>, 
    defines dependencies on the YUI DOM, Event, and JSON components so the YUI PHP loader will load these for us as well. When the document 
    is loaded we will process the JSON data with the JSON utility, create additional unordered list items with that data, and apply a CSS class 
    to the last item which will use custom styles defined in our custom CSS module.</p>
    
    <ul id="sample-list">
        <li class="first">This list starts with one static list item</li>
    </ul>
    
    <p><em>NOTE:</em> This example is very similar to one shipped with the YUI PHP Loader.  The major diference is the use of Lissa instead of using the 
    YAHOO_util_Loader class directly.  Doing so allows us to create combo urls which mix YUI resources with local ones.</p>

    <?PHP echo $loader->script(); ?>
</body>
</html>
