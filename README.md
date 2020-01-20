PlainPages
==========

a simple templates library which can 
- extend and nest another PHP layout files,
- declare partial sections for titles and stylesheets, for instance. 

should work great for legacy PHP files or Apache's `auto_prepend_file`. 

### License

MIT License

### Installation

t.b.w. 

### Demo

```
$ git clone ...this-repository...
$ cd ...this-repository...
$ composer install
$ cd public
$ php -S 127.0.0.1:8000
```

and browse `127.0.0.1:8000`. 

Usage
-----

### A Simple Usage 

A file, `index.php`, may have such code: 

```php
<?php
use WScore\PlainPages\PlainPages;
$page = PlainPages::self();
?>
<html>
<body>
<h1>Plain Pages Here!</h1>
</body>
</html>
```

In this simple case, the `PlainPages` will emit 
the contents of the file without any effects. 

Layout File
-----------

Start `PlainPages` and extend a layout file. 
The the contents of the file is stored as `contents` as a default.

```php
<?php
use WScore\PlainPages\PlainPages;
$page = PlainPages::self();
$page->extend(__DIR__ . '/layout.php');
?>
<h1>Plain Pages Here!!</h1>
```

In layout file, `layout.php`, get the contents and emit. 

```php
<?php
use WScore\PlainPages\PlainPages;
$page = PlainPages::self();
?>
<?php $page->section('payload'); ?>
<html>
<body>
<?= $page->get('contents'); ?>
</body>
</html>
<?php $page->end(); ?>
```

You must declare a section name in the layout file, 
or no contents will be emitted.  

The name of the section in the layout file can be any name, 
such as 'payload' or 'contents'. 

### Nested Layout 

`PlainPages` can emit contents with nested layout files. 

```php
<?php
use WScore\PlainPages\PlainPages;
$page = PlainPages::self();
$page->extend(__DIR__ . '/nested.php');
?>
<h1>Plain Pages Here!!!</h1>
```

and nexted layout file, `nested.php`, may look like... 

```php
<?php
use WScore\PlainPages\PlainPages;
$page = PlainPages::self();
?>
<?php $page->section('contents'); ?>
<div id="nested">
<?= $page->get('contents'); ?>
</div>
<?php $page->end(); ?>
```

The nested layout file, `nested.php` must have 
the section name used in the layout file `layout.php`; 
i.e. `'contents'` in this example.