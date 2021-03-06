<?php

namespace Embitel\Tech\Controller\Index;


class Block extends \Magento\Framework\App\Action\Action
{

    private $pageFactory;


    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    )
    {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
     return $this->pageFactory->create();
    }
}