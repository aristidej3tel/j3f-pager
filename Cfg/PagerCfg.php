<?php
namespace J3tel\PagerBundle\Cfg;

class PagerCfg
{
    const ORDER_ASC = 'ASC';
    const ORDER_DESC = 'DESC';
    const ORDER_FIELD_NAME = 'name';
    const ORDER_FIELD_ID = 'id';

    const PAGER_FIELD_NAME = 'filter';
    const PAGER_FIELD_ORDER = 'order';

    public static function getOrder()
    {
        return array(
            self::ORDER_ASC => self::ORDER_ASC,
            self::ORDER_DESC => self::ORDER_DESC,
        );
    }
    public static function getFieldName()
    {
        return array(
            self::ORDER_FIELD_ID => self::ORDER_FIELD_ID,
            self::ORDER_FIELD_NAME => self::ORDER_FIELD_NAME
        );
    }
}
