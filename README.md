j3f-pager
=========

Symfony 2 Bundle - Pager by j3tel
 
 
Symfony2 paginator to paginate 



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
