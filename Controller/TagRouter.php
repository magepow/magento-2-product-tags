<?php
namespace Magepow\ProductTags\Controller;
use Magento\Framework\DataObject;
class TagRouter implements \Magento\Framework\App\RouterInterface
{
   protected $actionFactory;
   protected $helperData;
   protected $_response;
   protected $dispatched;
   /**
     * Event manager
     * @var \Magento\Framework\Event\ManagerInterface
     */
    protected $eventManager;

   public function __construct(
       \Magento\Framework\App\ActionFactory $actionFactory,
       \Magento\Framework\App\ResponseInterface $response,
       \Magepow\ProductTags\Helper\Data $helperData,
       \Magento\Framework\Event\ManagerInterface $eventManager
   ) {
       $this->actionFactory = $actionFactory;
       $this->helperData = $helperData;
       $this->_response = $response;
       $this->eventManager = $eventManager;
   }

   public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $identifier = trim($request->getPathInfo(), '/');
        $array = explode('/', $identifier);
        $router = $this->helperData->getConfigModule('general/route');
        if (!$router) $router = 'producttags';
        if ($router) {
          if(in_array($router,$array)) {
            $request->setModuleName('producttags')
                ->setControllerName('tag')
                ->setActionName('view');
            if(isset($array[1])){

                $request->setParam('tag_code', $array[1]);
                return $this->actionFactory->create(
                   'Magento\Framework\App\Action\Forward',
                   ['request' => $request]
                );
            }
          }else
          {
              return;
          }
          
        }
    }
} 

 