<?php
namespace junkman\components\jsonrpc;

use extas\components\jsonrpc\operations\OperationDispatcher;
use junkman\interfaces\extensions\IExtensionMoveToLocation;
use junkman\interfaces\IJunkman;
use junkman\interfaces\skills\ISkill;
use Psr\Http\Message\ResponseInterface;

/**
 * Class JunkmanMove
 *
 * params:
 *  junkman_name
 *  adjacent_name
 *
 * @method junkmanRepository()
 * @method skillRepository()
 *
 * @package junkman\components\jsonrpc
 * @author jeyroik@gmail.com
 */
class JunkmanMove extends OperationDispatcher
{
    /**
     * @return ResponseInterface
     */
    public function __invoke(): ResponseInterface
    {
        $jsonRpcRequest = $this->convertPsrToJsonRpcRequest();
        $params = $jsonRpcRequest->getParams();
        $junkmanName = $params['junkman_name'] ?? '';
        $adjacentName = $params['adjacent_name'] ?? '';

        /**
         * @var IJunkman|IExtensionMoveToLocation $junkman
         * @var ISkill $skill
         */
        $junkman = $this->junkmanRepository()->one([IJunkman::FIELD__NAME => $junkmanName]);

        if ($junkman) {
            $location = $junkman->getLocation();
            if ($location->hasAdjacentLocation($adjacentName)) {
                $junkman->moveToLocation($adjacentName);
            }

            $location = $junkman->getLocation();
            $adjacentLocations = $location->getAdjacentLocations();
            foreach ($adjacentLocations as $index => $adjacentLocation) {
                $loc = $adjacentLocation->getLocation();
                $adjacentLocations[$loc->getName()] = $loc->getTitle();
                unset($adjacentLocations[$index]);
            }

            return $this->successResponse($jsonRpcRequest->getId(), [
                'current_title' => $location->getTitle(),
                'current_about' => $location->getDescription(),
                'adjacent' => $adjacentLocations
            ]);
        }

        return $this->errorResponse(
            $jsonRpcRequest->getId(),
            'Missed junkman',
            404,
            [
                'junkman_name' => $junkmanName
            ]
        );
    }

    /**
     * @param IJunkman $junkman
     * @param ISkill $skill
     */
    protected function doAction(IJunkman &$junkman, ISkill $skill)
    {
        $junkman->addSkill($skill);
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.operation.junkman.add.skill';
    }
}
