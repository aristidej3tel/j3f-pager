<?php
namespace J3tel\PagerBundle\Interfaces;

interface PagerInterface
{
    const OPTION_NAME_SIZE = 'size';
    const OPTION_NAME_FIRST_PAGE = 'first_page';
    const OPTION_NAME_ITEMS_PER_PAGE = 'items_per_page';
    const OPTION_NAME_BLOCK_ITEM = 'block_item';
    const OPTION_NAME_NEAR_ITEM = 'items_around_active_page';
    
    public function getPage();
    public function setPage($page);
    public function needPaging();
    public function hasNext();
    public function nextPage();
    public function hasPrevious();
    public function previousPage();
    public function getCountPage();
    public function getItemsPerPage();
    public function setNumberItems($number);
}
