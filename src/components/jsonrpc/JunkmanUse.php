<?php
namespace junkman\components\jsonrpc;

use extas\components\jsonrpc\operations\OperationDispatcher;
use extas\interfaces\jsonrpc\IRequest;
use junkman\interfaces\using\ICanUse;
use junkman\interfaces\using\IUsable;
use junkman\interfaces\using\IUser;
use Psr\Http\Message\ResponseInterface;

/**
 * Class JunkmanUse
 *
 * Input:
 * - who
 * - what
 * - action
 * - args
 *
 * @method junkmanUserRepository()
 * @method junkmanUsableRepository()
 * @method getStory()
 *
 * @package junkman\components\jsonrpc
 * @author jeyroik@gmail.com
 */
class JunkmanUse extends OperationDispatcher
{
    public const PARAM__WHO = 'who';
    public const PARAM__WHAT = 'what';
    public const PARAM__ACTION = 'action';
    public const PARAM__ARGS = 'args';

    /**
     * @return ResponseInterface
     */
    public function __invoke(): ResponseInterface
    {
        $request = $this->convertPsrToJsonRpcRequest();
        list($whoName, $whatName, $action, $args) = $this->parseRequestParams($request);

        try {
            list($who, $what) = $this->getSubjects($whoName, $whatName);
            list($whoSelf, $whatSelf) = $this->getSelves($who, $what);

            /**
             * @var ICanUse $whoSelf
             */

            if (!$whoSelf->canUse($whatSelf, $action)) {
                throw new \Exception($whoName . ' can not use ' . $whatName . ' for ' . $action);
            }

            $whoSelf->useThis($whatSelf, $action, $args);

            $who->getRepository()->update($whoSelf);
            $what->getRepository()->update($whatSelf);
        } catch (\Exception $e) {
            return $this->errorResponse($request->getId(), $e->getMessage(), 400);
        }

        return $this->successResponse($request->getId(), [
            'story' => $this->getStory()
        ]);
    }

    /**
     * @param IUser $who
     * @param IUsable $what
     * @return array
     */
    protected function getSelves(IUser $who, IUsable $what): array
    {
        return [$who->getICanUse(), $what->getICanBeUsed()];
    }

    /**
     * @param string $whoName
     * @param string $whatName
     * @return array
     * @throws \Exception
     */
    protected function getSubjects(string $whoName, string $whatName): array
    {
        return [$this->getWho($whoName), $this->getWhat($whatName)];
    }

    /**
     * @param IRequest $request
     * @return array
     */
    protected function parseRequestParams(IRequest $request): array
    {
        $params = $request->getParams();
        $whoName = $params[static::PARAM__WHO] ?? '';
        $whatName = $params[static::PARAM__WHAT] ?? '';
        $action = $params[static::PARAM__ACTION] ?? '';
        $args = $params[static::PARAM__ARGS] ?? '';

        return [$whoName, $whatName, $action, $args];
    }

    /**
     * @param string $name
     * @return IUsable
     * @throws \Exception
     */
    protected function getWhat(string $name): IUsable
    {
        $usable = $this->junkmanUsableRepository()->one([IUsable::FIELD__NAME => $name]);

        if (!$usable) {
            throw new \Exception('Missed what');
        }

        return $usable;
    }

    /**
     * @param string $name
     * @return IUser
     * @throws \Exception
     */
    protected function getWho(string $name): IUser
    {
        $user = $this->junkmanUserRepository()->one([IUser::FIELD__NAME => $name]);

        if (!$user) {
            throw new \Exception('Missed who');
        }

        return $user;
    }

    protected function getSubjectForExtension(): string
    {
        return 'junkman.operation.junkman.use';
    }
}
