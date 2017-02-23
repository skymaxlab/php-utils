<?php

namespace SkyMaxLab\Fractal;

use League\Fractal\Serializer\ArraySerializer;

/**
 * Class ResourceKeySerializer.  A better ArraySerializer.
 */
class ResourceKeySerializer extends ArraySerializer
{
    /**
     * Allow resource key to be null.
     *
     * @param string $resourceKey
     * @param array  $data
     *
     * @return array
     */
    public function collection($resourceKey, array $data)
    {
        if (is_null($resourceKey)) {
            return $data;
        }

        return [
            $resourceKey => $data
        ];
    }

    /**
     * Allow resource key to be null.
     *
     * @param string $resourceKey
     * @param array $data
     *
     * @return array
     */
    public function item($resourceKey, array $data)
    {
        if (is_null($resourceKey)) {
            return $data;
        }

        return [
            $resourceKey => $data
        ];
    }
}
