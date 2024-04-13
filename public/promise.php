<?php

use Slothsoft\Farah\PThreads\Promise;

require_once __DIR__ . '/../vendor/autoload.php';

// class PromisePool extends PromiseManager {
//     public function hasWork() {
//         return (bool) $this->collect();
//     }
// }

// class ThenableDelegation extends Thenable {
//     private $delegate;
//     public function __construct(callable $delegate) {
//         $this->delegate = $delegate;
//     }
//     public function onFulfilled	(Promisable $promised) {
//         return ($this->delegate)($promised);
//     }
// }

// class WorkPromise extends Promisable {
// }

// class StartWork extends Thenable {
//     public function onFulfilled	(Promisable $promised) {
//         echo 'hallo welt' . PHP_EOL;
//         $this->promise->then(new FinishWork($this->promise));
//     }
// }

// class FinishWork extends Thenable {
//     public function onFulfilled	(Promisable $promised) {
//         echo 'tschüß welt' . PHP_EOL;
//     }
// }

// $manager = new PromisePool();

// $promise = new Promise($manager, new WorkPromise());
// $promise->then(new StartWork($promise));

// while ($manager->hasWork()) {
//     usleep(1);
// }

// use GuzzleHttp\Promise\EachPromise;
// use GuzzleHttp\Promise\Promise;
// use GuzzleHttp\Promise\PromiseInterface;
// use GuzzleHttp\Promise\FulfilledPromise;

// require_once __DIR__ . '/../vendor/autoload.php';

// class ThreadedPromise extends Threaded {
//     public static function resolve($value = null) {
//         return new FulfilledPromise($value);
//     }
//     public static function all(iterable $promises) {
//         $pool = new Pool();
//         $threads = [];
//         foreach ($promises as $key => $promise) {
//             $thread = new self($promise);
//             $threads[$key] = $thread;
//             $pool->submit($thread);
//         }
//         while ($pool->collect()) {
//             usleep(1);
//         }
//         $pool->shutdown();
        
//         foreach ($threads as $thread) {
            
//         }
        
        
//         $results = [];
//         return each(
//             $promises,
//             function ($value, $idx) use (&$results) {
//                 $results[$idx] = $value;
//             },
//             function ($reason, $idx, Promise $aggregate) {
//                 $aggregate->reject($reason);
//             }
//             )->then(function () use (&$results) {
//                 ksort($results);
//                 return $results;
//             });
            
//         return all($promises);
//     }
// }

$promise = Promise::resolve()
    ->then(function($value) {
        echo "hallo $value" . PHP_EOL;
        
        $list = [];
        $list[] = 'kaladesh';
        $list[] = 'ravnica';
        return $list;
    })
    ->then(function($sets) {
        $promises = [];
        foreach ($sets as $set) {
            $promises[] = Promise::resolve($set)->then(function($set) { var_dump($set); sleep(1); return $set; });
            $promises[] = Promise::thenable(function($set) { var_dump($set); sleep(1); return $set; });
        }
        return Promise::all($promises)->then(function($values) { var_dump($values); return implode('|', $values); });
    })
    ->then(function($values) {
        var_dump($values);
    });
$promise->wait(true);

//var_dump($promise->wait()); // int(1000)
//var_dump($promise === $promiseB);
// The promise is the deferred value, so you can deliver a value to it.
//$promise->wait(true);