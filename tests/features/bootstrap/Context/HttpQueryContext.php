<?php

namespace App\Tests\Features\Context;

use Assert\Assert;
use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\MinkExtension\Context\MinkContext;
use Symfony\Component\PropertyAccess\PropertyAccessor;

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

    /**
     * @BeforeScenario
     * @param BeforeScenarioScope $scope
     */
    public function gatherContexts(BeforeScenarioScope $scope)
    {
        $this->client = $scope
            ->getEnvironment()
            ->getContext(MinkContext::class)
            ->getSession()
            ->getDriver()
            ->getClient();
    }

    /**
     * @When I submit the query :name
     * @param string $name
     * @throws \Exception
     */
    public function iSubmitTheQuery(string $name)
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
    public function theJsonResponseMustBeEqualsToJsonResponse(string $filename)
    {
        $response = json_decode($this->content, true);
        $expected = json_decode($this->loadJsonResponse($filename), true);

        if (serialize($response) !== serialize($expected)) {
            echo "\n\nexpected:\n";
            echo json_encode($expected, JSON_PRETTY_PRINT);
            echo "\n\nresponse:\n";
            echo json_encode($response, JSON_PRETTY_PRINT);
            throw new \Exception('Actual response does not match expected response.');
        }
    }

    /**
     * @Then The json element at :jsonPath should be equal to :expectedValue
     *
     * @param string $jsonPath
     * @param string $expectedValue
     * @throws \Exception
     */
    public function theJsonElementAtShouldBeEqualTo(string $jsonPath, string $expectedValue)
    {
        $response = json_decode($this->content, true);

        $propertyAccessor = new PropertyAccessor(false, true);

        if ($propertyAccessor->isReadable($response, $jsonPath) == false) {
            throw new \Exception(sprintf('Element %s does not exist', $jsonPath));
        }

        $actualValue = $propertyAccessor->getValue($response, $jsonPath);

        Assert::that($expectedValue)->eq(
            $actualValue,
            sprintf(
                "Json element at %s is invalid\n\t- expected : %s\n\t- response : %s",
                $jsonPath,
                $expectedValue,
                $actualValue
            )
        );
    }

    /**
     * @param $name
     * @return string
     * @throws \Exception
     */
    private function loadGraphqlQuery(string $name): string
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
    private function loadJsonResponse(string $name): string
    {
        $filepath = sprintf("%s/tests/features/bootstrap/resources/json_response/%s.json", $this->projectDir, $name);

        if (!file_exists($filepath)) {
            throw new \Exception(sprintf('Json %s does not exist.', $name));
        }

        return file_get_contents($filepath);
    }
}
