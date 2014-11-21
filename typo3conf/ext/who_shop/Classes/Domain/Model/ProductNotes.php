<?php
namespace WHO\WhoShop\Domain\Model;

/***************************************************************
 *
 * Copyright notice
 *
 * (c) 2014 Sebastian Hofer <sebastian.hofer@s-hofer.de>
 *
 * All rights reserved
 * 
 ***************************************************************/

/**
 * ProductNotes
 */
class ProductNotes extends \WHO\WhoShop\Domain\Model\Product {

	/**
	 * additional information
	 * @var string
	 */
	protected $additional_information = '';


    /**
     * Gets the additional information.
     *
     * @return string
     */
    public function getAdditionalInformation()
    {
        return $this->additional_information;
    }
    
    /**
     * Sets the additional information.
     *
     * @param string $additional_information the additional  information 
     *
     * @return self
     */
    protected function setAdditionalInformation($additional_information)
    {
        $this->additional_information = $additional_information;

        return $this;
    }
}