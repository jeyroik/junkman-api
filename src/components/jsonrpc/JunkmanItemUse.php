<?php
namespace junkman\components\jsonrpc;

use extas\components\jsonrpc\operations\OperationDispatcher;
use junkman\interfaces\contents\IContentsItem;
use junkman\interfaces\IJunkman;
use Psr\Http\Message\ResponseInterface;

/**
 * Class JunkmanItemUse
 *
 * params:
 *  junkman_name
 *  item_name
 *  apply_to_junkman
 *  apply_to_item
 *  action
 *
 * @method junkmanRepository()
 * @method contentsItemRepository()
 * @method getStory()
 *
 * @package junkman\components\jsonrpc
 * @author jeyroik@gmail.com
 */
class JunkmanItemUse extends OperationDispatcher
{
    /**
     * @return ResponseInterface
     */
    public function __invoke(): ResponseInterface
    {
        $jsonRpcRequest = $this->convertPsrToJsonRpcRequest();
        $params = $jsonRpcRequest->getParams();
        $junkmanName = $params['junkman_name'] ?? '';
        $itemName = $params['item_name'] ?? '';

        /**
         * @var IJunkman $junkman
         * @var IContentsItem $item
         */
        $junkman = $this->junkmanRepository()->one([IJunkman::FIELD__NAME => $junkmanName]);
        $item = $this->contentsItemRepository()->one([IContentsItem::FIELD__NAME => $itemName]);

        if ($junkman && $item) {
            try {
                $this->doAction($junkman, $item, $params);
                return $this->successResponse(
                    $jsonRpcRequest->getId(),
                    [
                        'story' => $this->getStory(),
                        'junkman' => $junkman->__toArray()
                    ]
                );
            } catch (\Exception $e) {
                return $this->errorResponse($jsonRpcRequest->getId(), $e->getMessage(), 400);
            }
        }

        return $this->errorResponse(
            $jsonRpcRequest->getId(),
            'Missed junkman or an item',
            404,
            [
                'junkman_name' => $junkmanName,
                'junkman' => $junkman ? $junkman->__toArray() : 'missed',
                'item_name' => $itemName,
                'item' => $item ? $item->__toArray() : 'missed'
            ]
        );
    }

    /**
     * @param IJunkman $junkman
     * @param IContentsItem $item
     * @param array $params
     */
    protected function doAction(IJunkman &$junkman, IContentsItem $item, array $params)
    {
        $action = $params['action'] ?? '';

        if (!$action) {
            throw new \Exception('Missed action');
        }

        $isApplyToJunkman = $params['apply_to_junkman'] ?? '';
        $applyToItem = $params['apply_to_item'] ?? '';

        $isApplyToJunkman
            ? $this->applyToJunkman($junkman, $item, $isApplyToJunkman, $action)
            : $this->applyToItem($junkman, $item, $applyToItem, $action);

        $this->contentsItemRepository()->update($item);
        $this->junkmanRepository()->update($junkman);
    }

    /**
     * @param IJunkman $junkman
     * @param IContentsItem $item
     * @param string $applyTo
     * @param string $action
     * @throws \Exception
     */
    protected function applyToJunkman(IJunkman &$junkman, IContentsItem &$item, string $applyTo, string $action)
    {
        $applyTo = $applyTo == 'self'
            ? $junkman
            : $this->junkmanRepository()->one([IJunkman::FIELD__NAME => $applyTo]);

        if ($applyTo) {
            try {
                $applyTo->$action($item, $junkman);
                $this->junkmanRepository()->update($applyTo);
            } catch (\Exception $e) {
                throw new \Exception('Can not apply item: ' . $e->getMessage());
            }
        }
    }

    /**
     * @param IJunkman $junkman
     * @param IContentsItem $item
     * @param string $applyTo
     * @param string $action
     * @throws \Exception
     */
    protected function applyToItem(IJunkman &$junkman, IContentsItem &$item, string $applyTo, string $action)
    {
        $applyTo = $this->contentsItemRepository()->one([IContentsItem::FIELD__NAME => $applyTo]);

        if ($applyTo) {
            try {
                $applyTo->$action($item, $junkman);
                $this->contentsItemRepository()->update($applyTo);
            } catch (\Exception $e) {
                throw new \Exception('Can not apply item');
            }
        }
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.operation.junkman.item.use';
    }
}
