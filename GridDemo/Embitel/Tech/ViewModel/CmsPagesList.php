<?php

namespace Embitel\Tech\ViewModel;

use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class CmsPagesList implements ArgumentInterface
{
    /**
     * @var PageRepositoryInterface;
     */

    private $pageRepository;

    /**
     * @var SearchCriteriaInterface;
     */
    private $searchCriteriaBuilder;
    
    /**
     * @var UrlInterface;
     */
    
     private $url;

    public function __construct(
        PageRepositoryInterface $pageRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        UrlInterface $url
    )
    {
        $this->pageRepository = $pageRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->url = $url;
    }

    /**
     * @return string 
    */

    public function getItemsJson()
    {
        $result = [];
        foreach($this->getItems() as $page)
        {
            $result[$page->getIdentifier()] = [
                'title' => $page->getTitle(),
                'url'   => $this->url->getUrl($page->getIdentifier())
            ];
        }

        return json_encode($result);
    }

    private function getItems()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $pageSearchResult = $this->pageRepository->getList($searchCriteria);
        return $pageSearchResult->getItems();
    }
}