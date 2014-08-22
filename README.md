j3f-pager
=========

$this->get('j3f.pager') to get Pager object

Pager Interface:
=========
    public function getPage();
    $page: Integer, current page
    public function setPage($page);
    public function needPaging();
    public function hasNext();
    public function nextPage();
    public function hasPrevious();
    public function previousPage();
    public function getCountPage();
    public function getItemsPerPage();
    $number: Integer, Number of results 
    public function setNumberItems($number);

Pager Default Config (YML)
=========

    j3tel_pager: 
        default:
            items_around_active_page: 2 #The number of pages that are displayed around the active page
            items_per_page: 25
            first_page: 1
            block_item: 3 #The number of first and last pages to be displayed 
            class: '' #css class name applied to pager html element
            template: 'J3telPagerBundle:Default:pager.html.twig'
 
 Render Pager in Twig
 =========
    _pager is a variable previously set in controller with pager Object (service)
    {% block pager %}
        {% if _pager is defined %}
                {{ j3fPager(_pager, app.request) }}
        {% endif %}
    {% endblock %}
