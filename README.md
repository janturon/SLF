# SLF
SLF - Simply Lightweight Framework (2 kB)

## Motivation
Complex frameworks are expensive: coders need to study it and get experience with it. Webs without frameworks are expensive: coders need to write similar parts again and again. Therefore effective frameworks should be minimalistic:

 - When the FW contains something, everybody should be using it a lot. If just somebody uses it just sometimes, it clutters the FW with complexity and raises the cost of all webs made in that FW.
 - When something is very fast and easy to do manually (like copy files), FW should not have any tool for that. Using tools for easy stuff undesirably raises the level of indirection, can hide (or create) errors and slows the developing process: the exact opposite what FW should do.
 - Everything in the FW should respect limitations and purpose of language it uses. Don't store configuration in database, don't try to emulate PHP classes in Javascript and don't try to emulate Javascript live collections in PHP. Don't try to use some kind of dirty hackery like Reflections to achieve some obscure cool feature. If something can't be coded simply and straightforwardly is some language, you are not cool if you manage to do so: it is wrong from the begining, pick more appropriate language.
 - Everything in the web should be easy to replace, including the FW. Complex FW is not easy to replace and every piece of code will be obsolete sooner or later. Then one needs to rewrite the web to modern (complex) FW again and again do this unnecesary refactoring. If you can't easily remove any library without affecting core functionality, your project is doomed.

## What do we need
### 1: Handle errors
Adjust the error handling function to your desire, the default is
```
function error($msg) {
  echo "<pre>$msg";
  exit;
}
```

### 2: Simple approach to deal with undefined variables.
This is not optimal: `if(isset($myarray) && array_key_exists($myarray, $mykey)) handle($myarray[$mykey])`
So we use this:
```
function getVar(&$arr, $val, $default=null, $yell=false) {
  if(!isset($arr)) {
    if($yell) error("getVar variable does not exists.");
    return $default;
  }
  if(!isset($arr, $val)) {
    if($yell) error("missing argument $val");
    return $default;
  }
  if($yell && $default) {
    $type = gettype($arr[$val]);
    if($type!=$default) error("argument expected $default type, got $type instead");
  }
  return $arr[$val];
}
```
So we can use:

- `if($myvar=getVar($myarray,$mykey)) handle($myvar)` to handle `$myarray[$mykey]` if it is not empty
- `$myvar = getVar($GLOBALS, "DATA", "array", true)` to store global `$DATA` in `$myvar` and rise an error if it is not an array
- `$myvar = getVar($args, 2, "NULL")` to store `$args[2]` into `$myvar` and set it to "NULL" if it is not defined.

And with helper functions
```
function SESS($val) { return getVar($_SESSION, $val); }
function POST($val) { return getVar($_POST, $val); }
```
We can use `if($data=POST("data")) handle($data)`

### 3: Templates
How much do we need artificial templates?
```
{foreach $result as $row}
  <span>{$row->title}</span>
{/foreach}
```
Is this code really so much more complicated?
```
<?foreach($result as $row):?>
  <span><?=$row->title?></span>
<?endforeach?>
```
We need better ideas using templating system:
```
function loadFile($file, $args=array()) {
  if(!is_file($file)) error("Missing file $file.");
  if(count($args)==0) extract($GLOBALS);
  ob_start();
    include $file;
    $result = ob_get_contents();
  ob_end_clean();
  return $result;
}
```
So we can take output from some partial php script generating html and instead sending it to client use it in variable for further processing.

### 4: Extensions
We need extensions to add custom functionality behind very basics:
```
function loadExtensions() {
  $dirs = array();
  $dd = opendir("extensions");
  while($dir=readdir($dd)) if($dir[0]!='.') $dirs[] = $dir;
  closedir($dd);
  sort($dirs);
  foreach($dirs as $dir) {
    $loader = "extensions/$dir/load.php";
    if(!is_file($loader)) error("Missing loader for extension $dir.");
    include $loader; // variables in local context unless GLOBALS is used
  }
}
```

### 5: Nice URLs
We need nice urls, so we redirect all php files to index.php on the HTTP server (surely we all can set this manually, we are programmers, right?):
```
$URL = parse_url($_SERVER["REQUEST_URI"]);
$PAGE = pathinfo($URL["path"], PATHINFO_FILENAME);
$PAGE = preg_replace("/^[\/\\\\]+/", "", $PAGE);
$PAGE = preg_replace("/\.{2,}/", "", $PAGE);
if(!$PAGE) $PAGE = "index";
if(!is_file("pages/$PAGE.php")) $PAGE = "404";
```
Now we can display the contents (in the loaded file it is possible to change $CONTENTS)
```
if($PAGE=="404") header("HTTP/1.0 404 Not Found");
$CONTENTS = loadFile("pages/$PAGE.php");
if($VIEWPORT) $CONTENTS = loadFile("templates/$VIEWPORT");
echo $CONTENTS;
```

And this is all. There is nothing more in the core framework. So just create `index.php`, `404.php` and other pages in the `/page` directory and you can build all the contents. If you want to separate design, data and logic (you don't have to for simple webs), you should create these directories:
- `client` where all the client stuff goes (CSS, JS, fonts, graphics)
- `data` for the model part of your architecture
- `extensions` where you download and customize extensions (explained below)
- `pages` for pages
- `templates` for building blocks to be created by `loadFile` function

## Extensions
1. To create an extension, pick a unique name for it. If it is standalone, prefix it with '1-', if it has extension dependencies, get the highest number of the dependencies and increase it by one. This ensures the right order in `loadExtension` function. The prefixed name is the name of the subdirectory you create in `/extension` directory.
2. In the extension directory, place the files you need and place them inside `client`, `data` or `templates` directory (according to its purpose). All the files has to be prefixed by the name (without the number prefix) or must be placed in subdirectory named by the extension. The extension is installed simply by manual copying this directory structure to the framework structure.
3. Create a `load.php` file in your extension directory. This file is not copied, but called by `loadExtension` function. Place the configuration and initialization code there, also comment the extension and leave some contact and licence info there. If you need global variables, define them by using $GLOBALS array (all other variables outside main `index.php` are local), prefix them with the extension name and use caps.
4. Create an example page in `page/example-name.php` where you demonstrate all the extension functionality. If the example need additional files in `client`, `data` or `templates` directory, prefix them with `example-`, so the coder can easily delete it from the framework directory once he learns how your extension works.
