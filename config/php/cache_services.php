<?php
use NilPortugues\Cache\Adapter\InMemoryAdapter;
use NilPortugues\Cache\Adapter\Redis\NativeAdapter;
use NilPortugues\Cache\Adapter\Redis\PredisAdapter;
use NilPortugues\Cache\Cache;

$parameters = include realpath(dirname(__FILE__)).'/cache_parameters.php';

$inMemoryAdapter = new InMemoryAdapter();
$nativeRedisAdapter = new NativeAdapter($parameters['redis_servers'], $inMemoryAdapter);
$predisRedisAdapter = new PredisAdapter($parameters['redis_servers'], $inMemoryAdapter);

return [
    'nil_portugues.cache.adapter.in_memory_adapter' => $inMemoryAdapter,
    'nil_portugues.cache.adapter.redis.native_adapter' => $nativeRedisAdapter,
    'nil_portugues.cache.adapter.redis.predis_adapter' => $predisRedisAdapter,
    'nil_portugues.cache' => new Cache($nativeRedisAdapter, 'namespaced.cache'),
];
