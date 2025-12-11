<?php


if (!function_exists('flashSuccess')) {
    function flashSuccess(string $message, int $timeout = 3000, string $position = 'top-right'): void
    {
        flash()
            ->options([
                'position' => $position,
                'timeout' => $timeout,
            ])
            ->success($message);
    }
}

if (!function_exists('flashError')) {
    function flashError(string $message, int $timeout = 3000, string $position = 'top-right'): void
    {
        flash()
            ->options([
                'position' => $position,
                'timeout' => $timeout,
            ])
            ->error($message);
    }
}

if (!function_exists('flashInfo')) {
    function flashInfo(string $message, int $timeout = 3000, string $position = 'top-right'): void
    {
        flash()
            ->options([
                'position' => $position,
                'timeout' => $timeout,
            ])
            ->info($message);
    }
}

if (!function_exists('flashWarning')) {
    function flashWarning(string $message, int $timeout = 3000, string $position = 'top-right'): void
    {
        flash()
            ->options([
                'position' => $position,
                'timeout' => $timeout,
            ])
            ->warning($message);
    }
}
