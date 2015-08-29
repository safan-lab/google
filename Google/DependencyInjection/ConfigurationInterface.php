<?php
/**
 * This file is part of the Safan package.
 *
 * (c) Harut Grigoryan <ceo@safanlab.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Google\DependencyInjection;

interface ConfigurationInterface
{
    /**
     * @return mixed
     */
    public function build();
}