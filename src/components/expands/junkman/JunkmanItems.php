<?php
namespace junkman\components\expands\junkman;

use extas\components\plugins\expands\PluginExpandAbstract;
use extas\interfaces\expands\IExpandingBox;
use junkman\interfaces\contents\IContentsItem;
use junkman\interfaces\IJunkman;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class JunkmanItems
 * 
 * @package junkman\components\expands\junkman
 * @author jeyroik@gmail.com
 */
class JunkmanItems extends PluginExpandAbstract
{
    /**
     * @param IExpandingBox $parent
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    protected function dispatch(IExpandingBox &$parent, RequestInterface $request, ResponseInterface $response)
    {
        $junkmen = $this->getJunkmanList($parent);

        foreach ($junkmen as &$junkman) {
            $junkman[IJunkman::FIELD__CONTENTS_ITEMS] = [];
            $items = $this->contentsItemRepository()->all([
                IContentsItem::FIELD__PLAYER_NAME => $junkman[IJunkman::FIELD__NAME]
            ]);
            foreach ($items as $item) {
                $junkman[IJunkman::FIELD__CONTENTS_ITEMS][] = $item->__toArray();
            }
        }
        $parent->addToValue('junkman_list', $junkmen);
    }

    protected function getJunkmanList(IExpandingBox $parent)
    {
        $value = $parent->getValue([]);
        if (!isset($value['junkman_list'])) {
            $data = $parent->getData();
            $value['junkman_list'] = $data['junkman_list'];
        }

        return $value['junkman_list'];
    }

    protected function getExpandName(): string
    {
        return 'items';
    }
}
