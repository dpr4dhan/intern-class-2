<?php

function env(string $key)
{
    return $_ENV[$key] ?? NULL;
}