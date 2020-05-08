<?php
namespace junkman\components\jsonrpc;

use extas\components\jsonrpc\operations\OperationDispatcher;
use junkman\interfaces\IJunkman;
use junkman\interfaces\skills\ISkill;
use Psr\Http\Message\ResponseInterface;

/**
 * Class JunkmanAddSkill
 *
 * params:
 *  junkman_name
 *  skill_name
 *
 * @method junkmanRepository()
 * @method skillRepository()
 *
 * @package junkman\components\jsonrpc
 * @author jeyroik@gmail.com
 */
class JunkmanAddSkill extends OperationDispatcher
{
    /**
     * @return ResponseInterface
     */
    public function __invoke(): ResponseInterface
    {
        $jsonRpcRequest = $this->convertPsrToJsonRpcRequest();
        $params = $jsonRpcRequest->getParams();
        $junkmanName = $params['junkman_name'] ?? '';
        $skillName = $params['skill_name'] ?? '';

        /**
         * @var IJunkman $junkman
         * @var ISkill $skill
         */
        $junkman = $this->junkmanRepository()->one([IJunkman::FIELD__NAME => $junkmanName]);
        $skill = $this->skillRepository()->one([ISkill::FIELD__NAME => $skillName]);

        if ($junkman && $skill) {
            $this->doAction($junkman, $skill);
            return $this->successResponse($jsonRpcRequest->getId(), $junkman->__toArray());
        }

        return $this->errorResponse(
            $jsonRpcRequest->getId(),
            'Missed junkman or a skill',
            404,
            [
                'junkman_name' => $junkmanName,
                'junkman' => $junkman ? $junkman->__toArray() : 'missed',
                'skill_name' => $skillName,
                'skill' => $skill ? $skill->__toArray() : 'missed'
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
