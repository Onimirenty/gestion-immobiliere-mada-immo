<?php
require 'vendor/autoload.php';
use Spatie\ImageOptimizer\OptimizerChainFactory;

class ImageOptimizer {
    protected $optimizerChain;

    public function __construct() {
        $this->optimizerChain = OptimizerChainFactory::create();
    }

    public function optimize($pathToImage) {
        $this->optimizerChain->optimize($pathToImage);
    }
}
?>