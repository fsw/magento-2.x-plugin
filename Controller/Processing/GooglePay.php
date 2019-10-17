<?php

namespace BlueMedia\BluePayment\Controller\Processing;

use BlueMedia\BluePayment\Helper\Webapi;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

/**
 * Class Create
 *
 * @package BlueMedia\BluePayment\Controller\Processing
 */
class GooglePay extends Action
{
    /** @var Webapi */
    public $webapi;

    /** @var JsonFactory */
    public $resultJsonFactory;

    /**
     * Create constructor.
     *
     * @param Context              $context
     */
    public function __construct(
        Context $context,
        Webapi $webapi,
        JsonFactory $resultJsonFactory
    ) {
        parent::__construct($context);

        $this->webapi = $webapi;
        $this->resultJsonFactory = $resultJsonFactory;
    }

    /**
     * Pobranie merchantInfo
     */
    public function execute()
    {
        $info = $this->webapi->googlePayMerchantInfo();

        $resultJson = $this->resultJsonFactory->create();

        if ($info !== null) {
            $resultJson->setData([
                'acceptorId' => $info['acceptorId'],
                'merchantInfo' => [
                    'merchantId' => $info['merchantId'],
                    'merchantOrigin' => $info['merchantOrigin'],
                    'merchantName' => $info['merchantName'],
                    'authJwt' => $info['authJwt'],
                ]
            ]);

            return $resultJson;
        }

        $resultJson->setData([
            'error' => 'Currency is not supported.',
        ]);
        return $resultJson;
    }
}
