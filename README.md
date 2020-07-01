# Hamlet Framework / Australian Bureau of Meteorology Feed

```php
<?php

$station = Stations::closestTo(100.0, 200.0, 1)[0];

$observations = $station->feed();
```

## To do

- Add travis CI integration
- Add closest to calculations
