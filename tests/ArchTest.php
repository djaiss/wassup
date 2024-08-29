<?php

declare(strict_types=1);

arch('annotations')
    ->expect('App')
    ->toHavePropertiesDocumented()
    ->toHaveMethodsDocumented();
