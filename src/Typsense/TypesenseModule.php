<?php
declare(strict_types=1);

namespace Typesense;

use Laravel\Scout\EngineManager;
use Pandawa\Component\Module\AbstractModule;
use Typesense\Client as Typesense;
use Typesense\Engine\TypesenseEngine;

/**
 * @author  Adi Permana Putra <adiputrapermana@gmail.com>
 */
class TypesenseModule extends AbstractModule
{
    protected function build(): void
    {
        $this->app[EngineManager::class]->extend('typesense', static function () {
            return new TypesenseEngine(new Typesense(config('scout.typesense.client-settings')));
        });
    }
}