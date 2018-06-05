<?php

namespace TxTony\SymfonyPubnub\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PubNub\PNConfiguration;
use PubNub\PubNub;
 


class PubnubController extends Controller
{

    protected  $pubnub;
    protected  $configs;
    
    public function __construct($configs){
        $pnconf = new PNConfiguration();
        $pnconf->setSubscribeKey($configs["subscribe_key"]);
        $pnconf->setPublishKey($configs["publish_key"]);
        $pnconf->setSecretKey($configs["secret_key"]);
        $pnconf->setCipherKey($configs["cipher_key"]);
        $pnconf->setSecure($configs["ssl"]);
        $this->configs = $configs;
        $pubnub = new PubNub($pnconf);
        $this->pubnub = $pubnub;
        return $pubnub;
    }
    public function getConfigs(){
        return $this->configs;
    }
    public function getPubnub(){
        return $this->pubnub;
    }
    /**
    * NOT FOR PRODUCTION
    * USED AS A TEST
    */
    public function send($channel,$payload){
        return $this->pubnub->publish()
            ->channel($channel)
            ->message($payload)
            ->usePost(true)
            ->sync();
    }

}