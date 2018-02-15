<?php

/*
 * Copyright 2016 Johannes M. Schmitt <schmittjoh@gmail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace JMS\Serializer;

use JMS\Serializer\Accessor\AccessorStrategyInterface;
use JMS\Serializer\Accessor\DefaultAccessorStrategy;

abstract class AbstractVisitor
{
    protected $namingStrategy;

    /**
     * @var AccessorStrategyInterface
     */
    protected $accessor;

    public function __construct($namingStrategy, AccessorStrategyInterface $accessorStrategy = null)
    {
        $this->namingStrategy = $namingStrategy;
        $this->accessor = $accessorStrategy ?: new DefaultAccessorStrategy();
    }

    /**
     * @deprecated Will be removed in 2.0
     * @return mixed
     */
    public function getNamingStrategy()
    {
        return $this->namingStrategy;
    }

    public function prepare($data)
    {
        return $data;
    }

    /**
     * @param array $typeArray
     */
    protected function getElementType($typeArray)
    {
        if (false === isset($typeArray['params'][0])) {
            return null;
        }

        if (isset($typeArray['params'][1]) && \is_array($typeArray['params'][1])) {
            return $typeArray['params'][1];
        } else {
            return $typeArray['params'][0];
        }
    }
}
