<?php

function registerSpatiePestHelpers(): void
{
    function whenConfig(string $key): void
    {
        if (config($key) === null) {
            test()->markTestSkipped("{$key} is not set in the config file");
        }
    }

    function skipOnGitHubActions(): void
    {
        if (getenv('GITHUB_ACTIONS') === 'true') {
            test()->markTestSkipped('This test is skipped on GitHub Actions');
        }
    }

    function whenGitHubActions(): void
    {
        if (getenv('GITHUB_ACTIONS') !== 'true') {
            test()->markTestSkipped('This test is skipped on GitHub Actions');
        }
    }

    function whenEnvVar(string $key): void
    {
        if (empty(env($key))) {
            test()->markTestSkipped("{$key} is not set in the .env file");
        }
    }

    function whenMac(): void
    {
        if (PHP_OS_FAMILY !== 'Darwin') {
            test()->markTestSkipped('This test will only run on macOS');
        }
    }

    function whenWindows(): void
    {
        if (PHP_OS_FAMILY !== 'Windows') {
            test()->markTestSkipped('This test will only run on Windows');
        }
    }

    function whenLinux(): void
    {
        if (PHP_OS_FAMILY !== 'Linux') {
            test()->markTestSkipped('This test will only run on Linux');
        }
    }

    function whenPhpVersion($phpVersion): void
    {
        if (version_compare(PHP_VERSION, $phpVersion, '<')) {
            test()->markTestSkipped("This test will only run on PHP {$phpVersion} or higher");
        }
    }

    function whenIpv6Available(): bool
    {
        // Check if IPv6 is supported by the system
        if (!filter_var('::1', FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return false;
        }

        // Test if we can create an IPv6 socket
        $testSocket = @socket_create(AF_INET6, SOCK_STREAM, SOL_TCP);
        if ($testSocket === false) {
            return false;
        }

        socket_close($testSocket);

        // Check if system has IPv6 routes (on Unix-like systems)
        if (PHP_OS_FAMILY === 'Darwin' || PHP_OS_FAMILY === 'Linux') {
            // Check if there's a default IPv6 route
            $routes = @shell_exec('ip -6 route 2>/dev/null || route -n get -inet6 default 2>/dev/null');
            if (empty($routes) || strpos($routes, 'default') === false) {
                return false;
            }
        }

        return true;
    }
}
