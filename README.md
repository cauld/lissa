Copyright (c) 2009 Chad Auld ([opensourcepenguin.net](http://opensourcepenguin.net))
Licensed under the MIT license
 
# Lissa README #

Lissa is a generic CSS and JavaScript loading utility.  Lissa is an extension of the [YUI PHP Loader](http://developer.yahoo.com/yui/phploader/) aimed at solving one of the current loader limitations; combo loading.  YUI PHP Loader ships with a combo loader that is capable of reducing HTTP requests and increasing performance by outputting all the YUI JavaScript and/or CSS requirements as a single request per resource type.  Meaning even if you needed 8 YUI components which ultimately boil down to say 13 files you would still only make 2 HTTP requests; one for the CSS and another for the JavaScript.  That's great, but what about custom non-YUI resources.  YUI PHP Loader will load them, but it loads them as separate includes and thus they miss out on benefits of the combo service and the number of HTTP requests for the page increases.  Lissa works around this limitation by using the YUI PHP Loader to handle the loading and sort of YUI and/or custom resource dependencies and pairs that functional with [Minify](http://code.google.com/p/minify).

You can read about the benefits of Minify on their project page, but to sum it up.... we get automatic minification, compression, caching, proper setting of content headers, etc.  This means that you now have the potential to serve up all JavaScript and CSS requirements for a page with just 2 optimized requests.

## DEMO ##

[Live demo](http://opensourcepenguin.net/experiments/lissa/)

## SETUP ##

1. Place Lissa somewhere under DOCUMENT_ROOT
2. Alter includes/lissa/config.inc.php as needed
3. Set the proper $min_cachePath in includes/minify/min/config.php (and perhaps $min_documentRoot if things don't work as is)
4. Drop YUI releases into the includes/js/yui/lib as needed.  YUI 2.8.0r4 is supplied by default.

## HOW DOES IT WORK ##

OK enough already... How do you use it?  Simple.
    
    //Grab the class
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
    
    //Then just output the link and/or script nodes by calling one of three methods; scripts, css, tags
    $loader->tags();

## OUTPUT ##

With the setup show above we'll end up with the following to includes:
    <link rel="stylesheet" type="text/css" href="http://localhost/lissa/includes/minify/min/b=lissa&f=/includes/js/yui/lib/2.8.0r4/build/fonts/fonts-min.css,includes/css/example.css" />
    <script type="text/javascript" src="http://localhost/lissa/includes/minify/min/b=lissa&f=/includes/js/yui/lib/2.8.0r4/build/yahoo-dom-event/yahoo-dom-event.js,/includes/js/yui/lib/2.8.0r4/build/json/json-min.js,includes/js/example.js,includes/js/sample_data.js"></script>
    
If you are paying close attention you'll notice the handoff to Minify and the comma separated list of resources that will be minified, combined, cached, and served.

## EXAMPLE ##

For a simple example see index.php.

For a more complex integration done around the same idea check out the [Aliro Resource Loader](http://docs.aliro.org/AliroResourceLoader).  Lissa is a more generic spinoff of the aliroResourceLoader class.

## WHAT's NEXT? ##

Take Lissa and work it into your own project.  You'll most likely change things along the way to fit your environment/project, but hopefully this will serve as solid starting point.  Stop reading, start coding.