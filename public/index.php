<?php

declare(strict_types=1);

namespace App;

require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';
return fn (array $context) => new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
