<?php

namespace Maestro\Accounts\Support\Concerns;

use Maestro\Accounts\Services\Foundation\RelationHandler;

trait AccountRelationship
{
    /**
     * Retorna as regras de negócio para manipular
     * relacionamento entre entidades. 
     *
     * @return RelationHandler
     */
    public function relation() : RelationHandler
    {
        return app(RelationHandler::class);
    }
}