<?php

namespace App\Tests\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\MinkExtension\Context\MinkContext;

class HttpQueryContext implements Context
{
    /**
     * @var string
     */
    private $projectDir;

    /** @var string */
    private $content;

    /** @var mixed */
    private $client;

    /**
     * @param string $projectDir
     */
    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir;
    }

    /** @BeforeScenario */
    public function gatherContexts(BeforeScenarioScope $scope)
    {
        $environment = $scope->getEnvironment();
        $this->client = $environment->getContext(MinkContext::class)->getSession()->getDriver()->getClient();
    }

    /**
     * @When I submit the query :name
     * @param $name
     * @throws \Exception
     */
    public function iSubmitTheQuery($name)
    {
        $query = $this->loadGraphqlQuery($name);

        $this->client->request(
            'POST',
            '/',
            [
                'query' => $query,
            ]
        );

        $this->content = $this->client->getResponse()->getContent();
    }

    /**
     * @Then the json response must be equals to :filename json response
     * @param $filename
     * @throws \Exception
     */
    public function theJsonResponseMustBeEqualsToJsonResponse($filename)
    {
        $response = json_decode($this->content, true);
        $expected = json_decode($this->loadJsonResponse($filename), true);

        if (serialize($response) !== serialize($expected)) {
            echo "\n\nExpected:\n";
            echo json_encode($expected, JSON_PRETTY_PRINT);
            echo "\n\nResponse:\n";
            echo json_encode($response, JSON_PRETTY_PRINT);
            throw new \Exception('Actual response does not match expected response.');
        }
    }

    /**
     * @param $name
     * @return string
     * @throws \Exception
     */
    private function loadGraphqlQuery($name): string
    {
        $filepath = sprintf("%s/tests/features/bootstrap/resources/graphql_query/%s.graphql", $this->projectDir, $name);

        if (file_exists($filepath) === false) {
            throw new \Exception(sprintf('Query %s does not exist.', $filepath));
        }

        return file_get_contents($filepath);
    }

    /**
     * @param $name
     * @return string
     * @throws \Exception
     */
    private function loadJsonResponse($name): string
    {
        $filepath = sprintf("%s/tests/features/bootstrap/resources/json_response/%s.json", $this->projectDir, $name);

        if (!file_exists($filepath)) {
            throw new \Exception(sprintf('Json %s does not exist.', $name));
        }

        return file_get_contents($filepath);
    }
}
