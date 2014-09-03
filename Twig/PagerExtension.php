<?php
namespace J3tel\PagerBundle\Twig;

use Symfony\Component\HttpFoundation\Request;
use J3tel\PagerBundle\Pager\Pager;

class PagerExtension extends \Twig_Extension
{
    private $templating;
    private $pagerParameters;
    
    public function __construct($templating, $pagerParameters)
    {
        $this->templating = $templating;
        $this->pagerParameters = $pagerParameters;
    }
    
    /**
    * {@inheritdoc}
    */
    public function getFunctions()
    {
        return array(
            'j3fPager' => new \Twig_Function_Method($this, 'renderPager', array('is_safe' => array('html'))),
        );
    }

    public function renderPager(Pager $pager, Request $request)
    {
        try {
            return $this->templating->render(
                $this->pagerParameters['template'],
                array(
                    '_pager' => $pager,
                    '_request' => $request
                )
            );
        } catch (\Exception $e) {

        }
    }

    public function getName()
    {
        return 'j3fPager';
    }
}
