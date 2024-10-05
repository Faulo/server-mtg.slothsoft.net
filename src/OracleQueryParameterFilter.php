<?php
declare(strict_types = 1);
namespace Slothsoft\Server\MTG;

use Slothsoft\Core\IO\Sanitizer\ArraySanitizer;
use Slothsoft\Farah\Module\Asset\ParameterFilterStrategy\AbstractMapParameterFilter;

class OracleQueryParameterFilter extends AbstractMapParameterFilter {

    protected function createValueSanitizers(): array {
        return [
            'search-query' => new ArraySanitizer()
        ];
    }
}

