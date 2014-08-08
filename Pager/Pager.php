<?php
namespace J3tel\PagerBundle\Pager;

use J3tel\PagerBundle\Interfaces\PagerInterface;

/**
 * class permettant de gere la pagination
 */
class Pager implements PagerInterface
{
    const OPTION_NAME_SIZE = 'size';
    const OPTION_NAME_FIRST_PAGE = 'first_page';
    const OPTION_NAME_ITEMS_PER_PAGE = 'items_per_page';
    const OPTION_NAME_BLOCK_ITEM = 'block_item';
    const OPTION_NAME_NEAR_ITEM = 'near_item';

    const DEFAULT_NEAR_ITEM = 2;
    const DEFAULT_ITEMS_PER_PAGE = 25;
    const DEFAULT_FIRST_PAGE = 1;
    //nombre d'element bans les block pour pagination "block"
    const DEFAULT_BLOCK_ITEM = 3;

    protected $currentPage;
    protected $numberItems;
    protected $route;
    protected $defaultOptions;
    protected $extraParameters;

    public function __construct($options = array())
    {
        $defaultOptions = array(
            self::OPTION_NAME_SIZE => '',
            self::OPTION_NAME_FIRST_PAGE => self::DEFAULT_FIRST_PAGE,
            self::OPTION_NAME_ITEMS_PER_PAGE => self::DEFAULT_ITEMS_PER_PAGE,
            self::OPTION_NAME_BLOCK_ITEM => self::DEFAULT_BLOCK_ITEM,
            self::OPTION_NAME_NEAR_ITEM => self::DEFAULT_NEAR_ITEM,
        );
        $this->defaultOptions = array_merge($defaultOptions, $options);
        $this->currentPage = $this->defaultOptions[self::OPTION_NAME_FIRST_PAGE];
        $this->numberItems = 0;
        $this->extraParameters = array();
    }
    public function getBlockItem()
    {
        return $this->defaultOptions[self::OPTION_NAME_BLOCK_ITEM];
    }
    public function getItemsPerPage()
    {
        return $this->defaultOptions[self::OPTION_NAME_ITEMS_PER_PAGE];
    }
    public function getDefaultOptions()
    {
        return $this->defaultOptions;
    }

    public function setDefaultOptions($defaultOptions)
    {
        $this->defaultOptions = array_merge($this->defaultOptions, $defaultOptions);

        return $this;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    public function getNumberItems()
    {
        return $this->numberItems;
    }

    public function setNumberItems($numberItems)
    {
        $this->numberItems = $numberItems;

        return $this;
    }

    public function needPaging()
    {
        if ($this->numberItems <= $this->getItemsPerPage()) {
            return false;
        }

        return true;
    }
    /**
     * Indique si il y a une page suivante
     * @return boolean
     */
    public function hasNext()
    {
        if ($this->currentPage === $this->getCountPage()) {
            return false;
        }

        return true;
    }
    /**
     * Indique si il y a une page precedente
     * @return boolean
     */
    public function hasPrevious()
    {
        if ($this->currentPage === 1) {
            return false;
        }

        return true;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;

        return $this;
    }

    public function getCountPage()
    {
        $val = intval(ceil($this->numberItems / $this->getItemsPerPage()));
        if ($val < $this->firstPage()) {
            $val = $this->firstPage();
        }

        return $val;
    }
    /**
    * Retourne le numero de la premiere page
    * utile pour le bouton 'first page'
    * @return type
    */
    public function firstPage()
    {
        return $this->defaultOptions[self::OPTION_NAME_FIRST_PAGE];
    }
    /**
    * Retourne le numero de la derniere page
    * utile pour le bouton 'last Page'
    * @return type
    */
    public function lastPage()
    {
        return $this->getCountPage();
    }

    public function previousPage()
    {
        $previous = $this->currentPage - 1;
        if ($previous < $this->firstPage()) {
            $previous = $this->firstPage();
        }

        return $previous;
    }

    public function nextPage()
    {
        $next = $this->currentPage + 1;
        if ($next > $this->getCountPage()) {
            $next = $this->getCountPage();
        }

        return $next;
    }
    /**
    * Fonctions permettant de generer une pagination avec des ... lorqu'il y a beaucoup de pages
    */
    public function needBlockPaging()
    {
        if ($this->getCountPage() > 3 * $this->getBlockItem()) {
            return true;
        }

        return false;
    }

    public function firstBlock()
    {
        return ($this->firstPage() + $this->getBlockItem()) - 1;
    }

    public function middleBlockStart()
    {
        //si je ne suis pas dedans
        if ($this->currentPage <= $this->firstBlock() or $this->currentPage >= $this->lastBlock()) {
            return intval(floor($this->getCountPage() / 2)) - intval(floor($this->getBlockItem() / 2));
        }
        //si je suis dedans
        return $this->currentPage - intval(floor($this->getBlockItem() / 2));
    }

    public function middleBlockEnd()
    {
        //si je ne suis pas dedans
        if ($this->currentPage <= $this->firstBlock() or $this->currentPage >= $this->lastBlock()) {
            return intval(floor($this->getCountPage() / 2)) + intval(floor($this->getBlockItem() / 2));
        }

        return $this->currentPage + intval(floor($this->getBlockItem() / 2));
    }

    public function lastBlock()
    {
        return ($this->getCountPage() - $this->getBlockItem()) + 1;
    }

    public function getPage()
    {
        if ($this->currentPage < $this->firstPage()) {
            $this->setCurrentPage($this->firstPage());
        }
        if ($this->currentPage > $this->getCountPage()) {
            $this->setCurrentPage($this->getCountPage());
        }

        return $this->currentPage;
    }
    public function setPage($page)
    {
        return $this->setCurrentPage($page);
    }

    public function getExtraParameters()
    {
        return $this->extraParameters;
    }

    public function setExtraParameters($extraParameters)
    {
        $this->extraParameters = $extraParameters;

        return $this;
    }
}
