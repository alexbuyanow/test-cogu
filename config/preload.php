<?php

declare(strict_types=1);

namespace Art;

if (file_exists($cacheFile = dirname(__DIR__) . '/var/cache/prod/App_KernelProdContainer.preload.php')) {
    require $cacheFile;
}
