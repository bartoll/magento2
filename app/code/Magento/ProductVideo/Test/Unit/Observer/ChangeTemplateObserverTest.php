<?php declare(strict_types=1);
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\ProductVideo\Test\Unit\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\ProductVideo\Block\Adminhtml\Product\Edit\NewVideo;
use Magento\ProductVideo\Observer\ChangeTemplateObserver;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ChangeTemplateObserverTest extends TestCase
{
    public function testChangeTemplate()
    {
        /** @var MockObject|Observer $observer */
        $observer = $this->createPartialMock(Observer::class, ['getBlock']);

        /**
         * @var MockObject
         * |\Magento\ProductVideo\Block\Adminhtml\Product\Edit\NewVideo $block
         */
        $block = $this->createMock(NewVideo::class);
        $block->expects($this->once())
            ->method('setTemplate')
            ->with('Magento_ProductVideo::helper/gallery.phtml')
            ->willReturnSelf();
        $observer->expects($this->once())->method('getBlock')->willReturn($block);

        /** @var MockObject|ChangeTemplateObserver $unit */
        $this->objectManager = new ObjectManager($this);
        $unit = $this->objectManager->getObject(ChangeTemplateObserver::class);
        $unit->execute($observer);
    }
}
