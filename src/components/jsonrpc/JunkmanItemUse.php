<?php
namespace junkman\components\jsonrpc;

use extas\components\jsonrpc\operations\OperationDispatcher;
use junkman\interfaces\contents\IContentsItem;
use junkman\interfaces\IJunkman;
use junkman\interfaces\locations\ILocation;
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
 * @method locationRepository()
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
        $fromName = $params['from_name'] ?? '';
        $itemName = $params['item_name'] ?? '';

        /**
         * @var IContentsItem $item
         */
        $from = $this->getFrom($fromName);
        $item = $this->contentsItemRepository()->one([IContentsItem::FIELD__NAME => $itemName]);

        if ($from && $item) {
            try {
                $this->doAction($from, $item, $params);
                return $this->successResponse(
                    $jsonRpcRequest->getId(),
                    [
                        'story' => $this->getStory(),
                        'junkman' => $from->__toArray()
                    ]
                );
            } catch (\Exception $e) {
                return $this->errorResponse($jsonRpcRequest->getId(), $e->getMessage(), 400);
            }
        }

        return $this->errorResponse(
            $jsonRpcRequest->getId(),
            'Missed from or an item',
            404,
            [
                'from_name' => $fromName,
                'from' => $from ? $from->__toArray() : 'missed',
                'item_name' => $itemName,
                'item' => $item ? $item->__toArray() : 'missed'
            ]
        );
    }

    /**
     * @param string $fromName
     * @return IJunkman
     */
    protected function getFrom(string $fromName): IJunkman
    {
        $junkman = $this->junkmanRepository()->one([IJunkman::FIELD__NAME => $fromName]);

        if (!$junkman) {
            return $this->locationRepository()->one([ILocation::FIELD__NAME => $fromName]);
        }

        return $junkman;
    }

    /**
     * @param IJunkman $from
     * @param IContentsItem $item
     * @param array $params
     */
    protected function doAction(IJunkman &$from, IContentsItem $item, array $params)
    {
        $action = $params['action'] ?? '';

        if (!$action) {
            throw new \Exception('Missed action');
        }

        $to = $params['to_name'] ?? '';
        $applyToItem = $params['to_item'] ?? '';

        $to
            ? $this->applyToJunkman($from, $item, $to, $action)
            : $this->applyToItem($from, $item, $applyToItem, $action);

        $this->contentsItemRepository()->update($item);
        $this->junkmanRepository()->update($from);
    }

    /**
     * @param IJunkman $from
     * @param IContentsItem $item
     * @param string $to
     * @param string $action
     * @throws \Exception
     */
    protected function applyToJunkman(IJunkman &$from, IContentsItem &$item, string $to, string $action)
    {
        $to = $this->junkmanRepository()->one([IJunkman::FIELD__NAME => $to]);

        if ($to) {
            try {
                $to->$action($item, $from);
                $this->junkmanRepository()->update($to);
                ($to->getName() != $from->getName()) && $this->junkmanRepository()->update($from);
            } catch (\Exception $e) {
                throw new \Exception('Can not apply item: ' . $e->getMessage());
            }
        }
    }

    /**
     * @param IJunkman $from
     * @param IContentsItem $item
     * @param string $toItem
     * @param string $action
     * @throws \Exception
     */
    protected function applyToItem(IJunkman &$from, IContentsItem &$item, string $toItem, string $action)
    {
        $toItem = $this->contentsItemRepository()->one([IContentsItem::FIELD__NAME => $toItem]);

        if ($toItem) {
            try {
                $toItem->$action($item, $from);
                $this->contentsItemRepository()->update($toItem);
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
