<?php
/**
 * Created by PhpStorm.
 * User: rparsi
 * Date: 16/04/2016
 * Time: 11:28 AM
 */

namespace AppBundle\Service;

use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Serializer;

/**
 * Class JMSSerializerFactory
 * @package AppBundle\Service
 */
class JMSSerializerFactory
{
    /** @var  boolean */
    private $isDebugMode;

    /** @var  string */
    private $cacheDir;

    /** @var  string */
    private $annotationsDir;

    /** @var  string */
    private $debugOverride;

    /**
     * JMSSerializerFactory constructor.
     * @param $isDebugMode
     * @param $cacheDir
     * @param $annotationsDir
     * @param $debugOverride
     */
    public function __construct($isDebugMode, $cacheDir, $annotationsDir, $debugOverride)
    {
        $this->isDebugMode = $isDebugMode;
        $this->cacheDir = $cacheDir;
        $this->annotationsDir = $annotationsDir;
        $this->debugOverride = $debugOverride;
    }

    /**
     * @return bool
     */
    private function calculateDebug()
    {
        if ($this->debugOverride == 'none') {
            return $this->isDebugMode;
        }

        return ($this->debugOverride == 'yes');
    }

    /**
     * @return Serializer
     */
    public function create()
    {
        $builder = SerializerBuilder::create();
        $builder
            ->setCacheDir($this->cacheDir)
            ->setDebug($this->calculateDebug());
        AnnotationRegistry::registerAutoloadNamespace('JMS\Serializer\Annotation', $this->annotationsDir);
        return $builder->build();
    }
}