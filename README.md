# phpunit-phpstorm-printer

Simple phpunit printer made to simplify my opening files with phpstorm from the CLI in a Windows git bash shell.

## What

Before:
```sh
$ phpunit

[...tests...]

There were 1 failure:

1) Install_Tests::test_install
Failed asserting that false is true.

D:\home\planetozh\ozh.in\tests\tests\install\install.php:14
#  ⮤ cannot easily use in CLI because of backslashes and line number
```

After:
```sh
$ phpunit

[...tests...]

There were 1 failure:

1) Install_Tests::test_install
Failed asserting that false is true.

storm --line 14 /d/home/planetozh/ozh.in/tests/tests/install/install.php
#  ⮤ simple to copy-paste to directly open from CLI
```

## Usage

* Drop the file somewhere
* In you `phpunit.xml` add the following :  
```xml
<phpunit (... your stuff...)
         printerClass="Ozh\PHPUnit\Printer\StormPrinter"
         printerFile="./path/to/test/includes/StormPrinter.php"
>
```


