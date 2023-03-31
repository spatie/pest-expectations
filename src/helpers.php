<?php

function registerSpatiePestHelpers()
{
    function skipIfConfigNotSet(string $key): void
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

    function skipIfEnvNotSet(string $key): void
    {
        if (env($key) === false) {
            test()->markTestSkipped("{$key} is not set in the .env file");
        }
    }

    function skipIfEnvironment(string $environment): void
    {
        if (app()->environment($environment)) {
            test()->markTestSkipped("This test is skipped in the {$environment} environment");
        }
    }

    function onlyInEnvironment(string $environment): void
    {
        if (! app()->environment($environment)) {
            test()->markTestSkipped("This test is only run in the {$environment} environment");
        }
    }
}
