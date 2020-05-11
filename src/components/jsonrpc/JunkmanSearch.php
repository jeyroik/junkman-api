<?php
namespace junkman\components\jsonrpc;

use extas\components\jsonrpc\operations\OperationDispatcher;
use junkman\components\skills\SkillSearch;
use junkman\interfaces\extensions\IExtensionUseSkill;
use junkman\interfaces\IJunkman;
use junkman\interfaces\skills\ISkill;
use Psr\Http\Message\ResponseInterface;

/**
 * Class JunkmanSearch
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
class JunkmanSearch extends OperationDispatcher
{
    /**
     * @return ResponseInterface
     */
    public function __invoke(): ResponseInterface
    {
        $jsonRpcRequest = $this->convertPsrToJsonRpcRequest();
        $params = $jsonRpcRequest->getParams();
        $junkmanName = $params['junkman_name'] ?? '';

        /**
         * @var IJunkman|IExtensionUseSkill $junkman
         * @var ISkill $skill
         */
        $junkman = $this->junkmanRepository()->one([IJunkman::FIELD__NAME => $junkmanName]);

        if ($junkman) {
            try {
                $junkman->useSkill(SkillSearch::NAME, $junkman);
                return $this->successResponse($jsonRpcRequest->getId(), $junkman->__toArray());
            } catch (\Exception $e) {
                return $this->errorResponse(
                    $jsonRpcRequest->getId(),
                    $e->getMessage(),
                    400,
                    [
                        'junkman_name' => $junkmanName,
                        'trace' => $e->getTraceAsString()
                    ]
                );
            }
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
