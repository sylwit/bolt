<?php
namespace Bolt\Tests\Composer\Action;

use Bolt\Tests\BoltUnitTest;
use Bolt\Composer\Action\BoltExtendJson;
use Bolt\Composer\PackageManager;


/**
 * Class to test src/Composer/Action/BoltExtendJson.
 *
 * @author Ross Riley <riley.ross@gmail.com>
 *
 */
class BoltExtendJsonTest extends BoltUnitTest
{
    
    public $options;
    
    
    public function setup()
    {
        $app = $this->getApp();   
        $this->options = 
            array(
                'basedir'       => $app['resources']->getPath('extensions'),
                'composerjson'  => $app['resources']->getPath('extensions') . '/composer.json',
            );
    }
    
    public function testConstruct()
    {
        $action = new BoltExtendJson($this->options);
        $this->assertArrayHasKey('basedir', \PHPUnit_Framework_Assert::readAttribute($action, 'options'));
        $this->assertArrayHasKey('composerjson', \PHPUnit_Framework_Assert::readAttribute($action, 'options'));

    }
    
    public function testWrite()
    {
        $app = $this->getApp();   
        @unlink($app['resources']->getPath('extensions') . '/composer.json');
        $manager = new PackageManager($app);
        $action = new BoltExtendJson($manager->getOptions());
        $write = $action->updateJson($app);
    }
    
    public function testExecute()
    {
        $app = $this->getApp();   
        $action = new BoltExtendJson($this->options);
        $write = $action->execute($this->options['composerjson'], array('extra'=>array('bolt-test'=>true)));
    }
    
    

    
    
    
}
