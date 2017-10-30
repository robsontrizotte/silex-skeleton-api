<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once 'app/bootstrap.php';

return ConsoleRunner::createHelperSet($entityManager);
