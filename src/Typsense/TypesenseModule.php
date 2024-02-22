<?php
declare(strict_types=1);

use Engine\TypesenseEngine;
use Laravel\Scout\EngineManager;
use Pandawa\Component\Module\AbstractModule;
use Typesense\Client as Typesense;

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