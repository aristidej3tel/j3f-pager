<?php
namespace J3tel\PagerBundle\Interfaces;

interface PagerInterface
{
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
