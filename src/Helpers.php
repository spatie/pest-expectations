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

    function whenOnGitHubActions(): void
    {
        if (getenv('GITHUB_ACTIONS') === 'true') {
            test()->markTestSkipped('This test is skipped on GitHub Actions');
        }
    }

    function whenEnvVar(string $key): void
    {
        if (env($key) === false) {
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
}
