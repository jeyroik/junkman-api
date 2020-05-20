<?php
namespace junkman\components\expands\junkman;

use extas\components\plugins\expands\PluginExpandAbstract;
use extas\interfaces\expands\IExpandingBox;
use junkman\interfaces\contents\IContentsItem;
use junkman\interfaces\IJunkman;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class JunkmanItems extends PluginExpandAbstract
{
    /**
     * @param IExpandingBox $parent
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    protected function dispatch(IExpandingBox &$parent, RequestInterface $request, ResponseInterface $response)
    {
        $data = $parent->getData();
        $junkmen = $data['junkman_list'] ?? [];

        foreach ($junkmen as &$junkman) {
            $junkman[IJunkman::FIELD__CONTENTS_ITEMS] = $this->contentsItemRepository()->all([
                IContentsItem::FIELD__PLAYER_NAME => $junkman[IJunkman::FIELD__NAME]
            ]);
        }
        $data['junkman_list'] = $junkmen;
        $parent->setData($data);
    }

    protected function getExpandName(): string
    {
        return 'items';
    }
}
