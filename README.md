# Usage

```php
<?php

Benchmark::run(function() {
    json_encode("hello world");
});
```

```
// Result:
//         10000000        17 ns/op        0.173s  2Mb
```