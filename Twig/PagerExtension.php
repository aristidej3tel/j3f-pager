<?php
namespace J3tel\PagerBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use J3tel\PagerBundle\Pager\Pager;

class PagerExtension extends \Twig_Extension
{
    private $container;
    private $template;
    
    const DEFAULT_TEMPLATE = 'J3telPagerBundle:Default:pager.html.twig';
    
    public function __construct(ContainerInterface $container, $template = null)
    {
        $this->container = $container;
        if ($template === null) {
            $this->template = self::DEFAULT_TEMPLATE;
        } else {
            $this->template = $template;
        }
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
        return $this->container->get('templating')->render(
            $this->template,
            array(
                '_pager' => $pager,
                '_request' => $request
            )
        );
    }

    public function getName()
    {
        return 'j3fPager';
    }
}
