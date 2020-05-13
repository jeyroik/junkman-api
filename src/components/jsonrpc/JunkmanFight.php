<?php
namespace junkman\components\jsonrpc;

use extas\components\jsonrpc\operations\OperationDispatcher;
use junkman\interfaces\extensions\IExtensionHealth;
use junkman\interfaces\IJunkman;
use junkman\interfaces\skills\ISkill;
use Psr\Http\Message\ResponseInterface;

/**
 * Class JunkmanFight
 *
 * params:
 *  attacker_name
 *  defender_name
 *
 * @method junkmanRepository()
 * @method skillRepository()
 * @method getStory()
 * @method tellStory(array $episodes)
 *
 * @package junkman\components\jsonrpc
 * @author jeyroik@gmail.com
 */
class JunkmanFight extends OperationDispatcher
{
    /**
     * @return ResponseInterface
     */
    public function __invoke(): ResponseInterface
    {
        $jsonRpcRequest = $this->convertPsrToJsonRpcRequest();
        $params = $jsonRpcRequest->getParams();
        $attackerName = $params['attacker_name'] ?? '';
        $defenderName = $params['defender_name'] ?? '';

        /**
         * @var IJunkman|IExtensionHealth $attacker
         * @var IJunkman|IExtensionHealth $defender
         * @var ISkill $skill
         */
        $attacker = $this->junkmanRepository()->one([IJunkman::FIELD__NAME => $attackerName]);
        $defender = $this->junkmanRepository()->one([IJunkman::FIELD__NAME => $defenderName]);

        if (!$attacker || !$defender) {
            return $this->errorResponse(
                $jsonRpcRequest->getId(),
                'Missed attacker or defender',
                404,
                [
                    'attacker_name' => $attackerName,
                    'attacker' => $attacker ? $attacker->__toArray() : 'missed',
                    'defender_name' => $defenderName,
                    'defender' => $defender ? $defender->__toArray() : 'missed'
                ]
            );
        }

        while (!$attacker->isDead() or !$defender->isDead()) {
            $skills = $attacker->getSkills();
            foreach ($skills as $skill) {
                if ($skill->canDamageAnother()) {
                    $attacker->useSkill($skill->getName(), $defender);
                }
            }
        }

        $this->junkmanRepository()->update($attacker);
        $this->junkmanRepository()->update($defender);

        return $this->successResponse(
            $jsonRpcRequest->getId(),
            [
                'story' => 'Двое, кому нечего терять, схлестнулись в схватке, исход которой никого не волнует.',
                'attacker_name' => $attackerName,
                'attacker' => $attacker->isDead() ? 'Looses' : 'Wins',
                'defender_name' => $defenderName,
                'defender' => $defender->isDead() ? 'Looses' : 'Wins'
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
        $this->tellStory([
            'Нет никакой истории - вы просто добавили какой-то блуждающей душе ещё один навык.',
            'Теперь ей будет веселее гнить в этом забытом всеми богами месте.'
        ]);
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.operation.junkman.add.skill';
    }
}
