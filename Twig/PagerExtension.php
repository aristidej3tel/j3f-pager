<?php
namespace J3tel\PagerBundle\Twig;

use Symfony\Component\HttpFoundation\Request;
use J3tel\PagerBundle\Pager\Pager;

class PagerExtension extends \Twig_Extension
{
    private $pagerParameters;
    private $environment;

    public function __construct($pagerParameters)
    {
        $this->pagerParameters = $pagerParameters;
    }
    
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
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
            return $this->environment->render(
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
