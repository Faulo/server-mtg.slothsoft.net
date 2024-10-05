<?php
declare(strict_types = 1);
namespace Slothsoft\Server\MTG;

use Slothsoft\Core\IO\Writable\Delegates\DOMWriterFromElementDelegate;
use Slothsoft\Farah\FarahUrl\FarahUrlArguments;
use Slothsoft\Farah\Module\Asset\AssetInterface;
use Slothsoft\Farah\Module\Asset\ExecutableBuilderStrategy\ExecutableBuilderStrategyInterface;
use Slothsoft\Farah\Module\Executable\ExecutableStrategies;
use Slothsoft\Farah\Module\Executable\ResultBuilderStrategy\DOMWriterResultBuilder;
use Slothsoft\Farah\Module\Executable\ResultBuilderStrategy\NullResultBuilder;
use Slothsoft\MTG\Oracle;
use DOMDocument;
use DOMElement;

class OracleQueryExecutable implements ExecutableBuilderStrategyInterface {

    public function buildExecutableStrategies(AssetInterface $context, FarahUrlArguments $args): ExecutableStrategies {
        $query = $args->get('search-query');

        if ($query === []) {
            $resultBuilder = new NullResultBuilder();
            return new ExecutableStrategies($resultBuilder);
        }

        $closure = function (DOMDocument $targetDoc) use ($query): DOMElement {
            $oracle = new Oracle('mtg', $targetDoc);
            return $oracle->createSearchElement($targetDoc, $query);
        };
        $writer = new DOMWriterFromElementDelegate($closure);
        $resultBuilder = new DOMWriterResultBuilder($writer, 'builds.xml');
        return new ExecutableStrategies($resultBuilder);
    }
}
