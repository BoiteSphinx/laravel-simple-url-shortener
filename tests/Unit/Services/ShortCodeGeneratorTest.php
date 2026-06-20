<?php

use App\Services\ShortCodeGenerator;

test('short code has expected length', function () {
    $generator = new ShortCodeGenerator();

    $code = $generator->generate();

    expect($code)->toBeString();

    expect(strlen($code))
        ->toBe(6);
});

test('generated codes are unique', function () {
    $generator = new ShortCodeGenerator();

    $first = $generator->generate();

    $second = $generator->generate();

    expect($first)
        ->not->toBe($second);
});
