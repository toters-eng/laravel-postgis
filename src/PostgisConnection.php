<?php

namespace MStaack\LaravelPostgis;

use Illuminate\Database\PostgresConnection;
use MStaack\LaravelPostgis\Schema\Grammars\PostgisGrammar;

class PostgisConnection extends PostgresConnection
{
    /**
     * Get the default schema grammar instance.
     *
     * @return \Illuminate\Database\Grammar
     */
    protected function getDefaultSchemaGrammar()
    {
        if (version_compare(\Illuminate\Foundation\Application::VERSION, '12.0.0', '>=')) {
            return new PostgisGrammar($this);
        }

        return $this->withTablePrefix(new PostgisGrammar());
    }


    public function getSchemaBuilder()
    {
        if ($this->schemaGrammar === null) {
            $this->useDefaultSchemaGrammar();
        }

        return new Schema\Builder($this);
    }
}
