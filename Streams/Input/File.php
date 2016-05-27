<?php

namespace Martin1982\LiveBroadcastBundle\Streams\Input;
use Martin1982\LiveBroadcastBundle\Entity\LiveBroadcast;

/**
 * Class File
 * @package Martin1982\LiveBroadcastBundle\Streams\Input
 */
class File
{
    const INPUT_TYPE = 'file';

    /** @var  LiveBroadcast */
    protected $broadcast;

    /**
     * File constructor
     * @param LiveBroadcast $broadcast
     *
     * @throws \Exception
     */
    public function __construct(LiveBroadcast $broadcast)
    {
        $inputFilename = $broadcast->getVideoInputFile();

        if (!file_exists($inputFilename)) {
            throw new \Exception(sprintf('Could not find input file %s', $inputFilename));
        }

        $this->broadcast = $broadcast;
    }

    public function generateInputCmd()
    {
        $inputFilename = $this->broadcast->getVideoInputFile();
        return sprintf('-re -i %s -vcodec copy -acodec copy', $inputFilename);
    }
}