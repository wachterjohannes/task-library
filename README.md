# task-library

[![Build Status](https://travis-ci.org/wachterjohannes/task-library.svg?branch=master)](https://travis-ci.org/wachterjohannes/task-library)

## Install

### Gearman (Mac-OSX)

```
brew install gearman homebrew/php/php56-gearman
```

## Running Examples
 
### Gearman

__For Taskrunner:__
```
gearmand
php examples/Gearman/TaskRunner.php
```

__For Tasks:__
```
phpexamples/Gearman/Client.php
```

### In Memory

```
php examples/InMemory/Example.php
```

### TODO

* tests
* phpdocs
* documentation
* priority
