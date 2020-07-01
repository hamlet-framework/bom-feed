# Hamlet Framework / Australian Bureau of Meteorology Feed

```php
<?php

$station = Stations::closestTo(100.0, 200.0, 1)[0];

$observations = $station->observations();
```

## To do

- Parse air pressure readings
- Add travis CI integration
