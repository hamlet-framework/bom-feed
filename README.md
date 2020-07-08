# Hamlet Framework / Australian Bureau of Meteorology Feed

[![Build Status](https://travis-ci.org/hamlet-framework/bom-feed.svg)](https://travis-ci.org/hamlet-framework/bom-feed)

This library:

- Provides an up-to-date list of all weather stations of Australian BoM,
- Entity classes with complete psalm annotations to map weather stations' JSON feed into,
- Check every day that the list of stations is complete, geo locations are correct, and the mapping is type safe.  

```php
<?php

$station = Stations::closestTo(100.0, 200.0, 1)[0];
$feed = $station->feed();
```

### Todo:

- Use PSR-18 instead of curl
